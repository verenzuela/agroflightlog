<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use App\Flight;
use App\Batterylog;


class FlightsController extends Controller
{

	private static $fligth_conditions = [ 'Day' => 'Day', 'Night' => 'Night' ];
	
	private static $fligth_types = [ 'Trainer' => 'Trainer', 'Trainer/Prueba' => 'Trainer/Prueba', 'Comercial' => 'Comercial' ];

	private static $rules = [	
		'drone_id' 					=> 'required|max:30',
        'date' 						=> 'required',
        'flight_time' 				=> 'gt:0',
        'fligth_type' 				=> 'required',
        'fligth_condition' 			=> 'required',
        'notes' 					=> 'max:300',
        'latitude' 					=> 'nullable|numeric',
        'longitude' 				=> 'nullable|numeric',
        'battery_volt_takeoff_001' 	=> 'nullable|numeric',
        'battery_volt_landing_001' 	=> 'nullable|numeric',
        'battery_volt_takeoff_002' 	=> 'nullable|numeric',
        'battery_volt_landing_002' 	=> 'nullable|numeric'
    ];

	private static $customMessages = [
		'drone_id.required' 				=> 'The Drone Ident field is required.',
		'flight_time.gt' 					=> 'The Flight Time field is required.',
		'battery_volt_takeoff_001.numeric' 	=> 'The battery volt at takeoff must be a number.',
		'battery_volt_landing_001.numeric' 	=> 'The battery volt when landing must be a number.',
		'battery_volt_takeoff_002.numeric' 	=> 'The battery volt at takeoff must be a number.',
		'battery_volt_landing_002.numeric' 	=> 'The battery volt when landing must be a number.',
	];

    public static function index()
    {
    	$flights = Flight::where('id_user', Auth::user()->id)
               ->orderBy('date', 'desc')
               ->get();

		return view('app.flights.list', [ 'flights' => $flights ] );
    }


    public static function create()
    {
    	$user = User::find(Auth::user()->id);
		return view( 'app.flights.new', [	'user'				=> $user, 
											'fligth_conditions'	=> static::$fligth_conditions, 
											'fligth_types'		=> static::$fligth_types 
										]);
    }


    public function store(Request $request)
    {
        try {
            if( Auth::user()->can('flights-create') ){

            	$this->validate($request, static::$rules, static::$customMessages);

            	$flight = new Flight;

            	$flight->drone_id 	= $request['drone_id'];
            	$flight->id_user 	= Auth::user()->id;
            	$flight->date 		= date('Y-m-d', strtotime(str_replace('/', '-', $request['date'])));
            	$flight->time 		= $request['flight_time'];
            	$flight->type 		= $request['fligth_type'];
            	$flight->condition 	= $request['fligth_condition'];
            	$flight->latitude 	= $request['latitude'];
            	$flight->longitude 	= $request['longitude'];
            	$flight->notes 		= $request['notes'];

            	if( $flight->save() ){
            		
            		$battery_001 = new Batterylog;
            		$battery_002 = new Batterylog;

            		$battery_001->id_flight 	= $flight->id;
            		$battery_001->date 			= date('Y-m-d', strtotime(str_replace('/', '-', $request['date'])));
            		$battery_001->pack 			= '001';
            		$battery_001->volt_takeoff 	= $request['battery_volt_takeoff_001'];
            		$battery_001->volt_landing 	= $request['battery_volt_landing_001'];
            		$battery_001->save();

            		$battery_002->id_flight 	= $flight->id;
            		$battery_002->date 			= date('Y-m-d', strtotime(str_replace('/', '-', $request['date'])));
            		$battery_002->pack 			= '002';
            		$battery_002->volt_takeoff 	= $request['battery_volt_takeoff_002'];
            		$battery_002->volt_landing 	= $request['battery_volt_landing_002'];
            		$battery_002->save();

            	}

                return redirect()->intended('flights')->with('success','Flight save successfully');              

            }else{
                //return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
                return response()->view('errors.403', ['code' => 403, 'message' => "You don't have permission to execute this function"], 403);
            }

        } catch (Exception $e) {
            //return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
            return response()->view('errors.500', ['code' => 500, 'message' => $e], 500);
        }
    }


    public function edit($id)
    {	

    	try {
            if( Auth::user()->can('flights-edit') ){

		        $flight = Flight::find($id);

		        if ($flight == null || count($flight) == 0) {
		            return redirect()->intended('/flights')->with('errors','Flight not found');
		        }

		        $user = User::find($flight->id_user);
		        $batLog = Batterylog::where('id_flight', $flight->id);

		        $battery_001 = Batterylog::where('id_flight', $flight->id)->where('pack', '001')->get();
		        $battery_002 = Batterylog::where('id_flight', $flight->id)->where('pack', '002')->get();

		        $date = date('d/m/Y', strtotime(str_replace('-', '/', $flight->date)));

		        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $flight->time);
				sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
				$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

				return view('app/flights/edit', [	'flight'			=> $flight, 
		        									'batLog'			=> $batLog, 
		        									'user'				=> $user, 
		        									'time_seconds'		=> $time_seconds, 
		        									'fligth_conditions'	=> static::$fligth_conditions, 
		        									'fligth_types'		=> static::$fligth_types, 
		        									'date'				=> $date,
		        									'battery_001'		=> $battery_001,
		        									'battery_002'		=> $battery_002
		        								] );

	        }else{
                return response()->view('errors.403', ['code' => 403, 'message' => "You don't have permission to execute this function"], 403);
            }

        } catch (Exception $e) {
           	return response()->view('errors.500', ['code' => 500, 'message' => $e], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            if( Auth::user()->can('flights-edit') ){

                $this->validate($request, static::$rules, static::$customMessages);

            	$flight = Flight::find($id);
                
            	$hours = floor($request['flight_time'] / 3600);
				$mins = floor($request['flight_time'] / 60 % 60);
				$secs = floor($request['flight_time'] % 60);
				$timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

            	$flight->drone_id 	= $request['drone_id'];
            	$flight->date 		= date('Y-m-d', strtotime(str_replace('/', '-', $request['date'])));
            	$flight->time 		= $timeFormat;
            	$flight->type 		= $request['fligth_type'];
            	$flight->condition 	= $request['fligth_condition'];
            	$flight->latitude 	= $request['latitude'];
            	$flight->longitude 	= $request['longitude'];
            	$flight->notes 		= $request['notes'];

                if( $flight->save() ){
            		
            		$battery_001 = Batterylog::where('id_flight', $flight->id)->where('pack', '001')->get();
            		$battery_001[0]->volt_takeoff 	= $request['battery_volt_takeoff_001'];
            		$battery_001[0]->volt_landing 	= $request['battery_volt_landing_001'];
            		$battery_001[0]->save();

            		$battery_002 = Batterylog::where('id_flight', $flight->id)->where('pack', '002')->get();
            		$battery_002[0]->volt_takeoff 	= $request['battery_volt_takeoff_002'];
            		$battery_002[0]->volt_landing 	= $request['battery_volt_landing_002'];
            		$battery_002[0]->save();

            	}

                return redirect()->route('flights.index')->with('success','Flight updated successfully');

            }else{
                return response()->view('errors.403', ['code' => 403, 'message' => "You don't have permission to execute this function"], 403);
            }

        } catch (Exception $e) {
            return response()->view('errors.500', ['code' => 500, 'message' => $e], 500);
        }
        
    }


    public function destroy($id)
    {
        try {

            if( Auth::user()->can('flights-delete') ){

                Flight::where('id', $id)->delete();
                return redirect()->intended('/flights')->with('success','Flight delete successfully');

            }else{
                 return response()->view('errors.403', ['code' => 403, 'message' => "You don't have permission to execute this function"], 403);
            }

        } catch (Exception $e) {
            return response()->view('errors.500', ['code' => 500, 'message' => $e], 500);
        }

    }


    public function show($id)
    {
    	try {
            if( Auth::user()->can('flights-list') ){

		        $flight = Flight::find($id);

		        if ($flight == null || count($flight) == 0) {
		            return redirect()->intended('/flights')->with('errors','Flight not found');
		        }

		        $user = User::find($flight->id_user);
		        $batLog = Batterylog::where('id_flight', $flight->id);

		        $battery_001 = Batterylog::where('id_flight', $flight->id)->where('pack', '001')->get();
		        $battery_002 = Batterylog::where('id_flight', $flight->id)->where('pack', '002')->get();

		        $date = date('d/m/Y', strtotime(str_replace('-', '/', $flight->date)));

		        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $flight->time);
				sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
				$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

				return view('app/flights/show', [	'flight'			=> $flight, 
		        									'batLog'			=> $batLog, 
		        									'user'				=> $user, 
		        									'time_seconds'		=> $time_seconds, 
		        									'fligth_conditions'	=> static::$fligth_conditions, 
		        									'fligth_types'		=> static::$fligth_types, 
		        									'date'				=> $date,
		        									'battery_001'		=> $battery_001,
		        									'battery_002'		=> $battery_002
		        								] );

	        }else{
                return response()->view('errors.403', ['code' => 403, 'message' => "You don't have permission to execute this function"], 403);
            }

        } catch (Exception $e) {
           	return response()->view('errors.500', ['code' => 500, 'message' => $e], 500);
        }
    }

}
