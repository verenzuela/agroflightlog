@component('layouts.app.base')
    @slot('title') New Flight @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') New Flight @endslot

    @slot('breadcrumbFaIcon') fa-plus-square-o @endslot
    @slot('breadcrumbParent') Flight @endslot
    @slot('breadcrumbParentlink')  @endslot
    @slot('breadcrumbChild') New @endslot

    @slot('styles')
        <link href="{{ asset("/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.min.css")}}" rel="stylesheet" type="text/css" />

        <link href="{{ asset("/bootstrap-duration-picker-master/dist/bootstrap-duration-picker.css")}}" rel="stylesheet" type="text/css" />
    @endslot

    @slot('scripts')
        <script src="{{ asset ("/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>

        <script src="{{ asset ("/bootstrap-duration-picker-master/dist/bootstrap-duration-picker-debug.js") }}" type="text/javascript"></script>
    @endslot

    @section('app-content')
    
    <!-- Main content -->
    <section class="content">
        <form role="form" method="POST" action="{{ route('flights.store') }}">
        {{ csrf_field() }}

            <div class="box">
                
                <div class="box-header">
                  <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">Complete the fields and press the save button, all fields with * are required.</h3>
                    </div>
                    <div class="col-sm-4">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>          
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row" style="margin-bottom: 10px; ">
                        <div class="col-md-3 mb-3">
                            <div class="form-group ">
                                <label for="pilot">Pilot</label>
                                <input type="text" class="form-control" id="pilot" name="pilot" placeholder="" value="{{ $user->firstname }} {{ $user->lastname}}" readonly="readonly" >
                            </div>   
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('drone_id') ? ' has-error' : '' }}">
                                <label for="drone_id-repeat">* Drone Ident.</label>
                                <input type="text" class="form-control" id="drone_id" name="drone_id" placeholder="" value="{{ old('drone_id')}}" >

                                <small class="text-danger">{{ $errors->first('drone_id') }}</small>
                            </div>              
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date">* Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" id="date" name="date" placeholder="" value="{{ old('date')}}" >
                                </div>
                                <small class="text-danger">{{ $errors->first('date') }}</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('flight_time') ? ' has-error' : '' }}">
                                <label for="flight_time">* Flight Time</label>
                                <!--input type="text" class="form-control" id="flight_time" name="flight_time" placeholder="" value="" --->
                                <input type="text" class="form-control" id="ftime" name="ftime" value="{{ old('flight_time')}}">
                                <input type="hidden" id="flight_time" name="flight_time" value="{{ old('flight_time')}}">

                                <small class="text-danger">{{ $errors->first('flight_time') }}</small>
                            </div>             
                        </div>
                    </div>
                    
                    <div class="row" style="margin-bottom: 10px; ">
                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="" value="{{ old('latitude')}}" >

                                <small class="text-danger">{{ $errors->first('latitude') }}</small>
                            </div>   
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="" value="{{ old('longitude')}}" >

                                <small class="text-danger">{{ $errors->first('longitude') }}</small>
                            </div>                       
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('fligth_type') ? ' has-error' : '' }}">
                                <label for="fligth_type">* Fligth Type</label>
                                <select id="fligth_type" name="fligth_type" class="form-control">
                                    <option value="">Select...</option>
                                    @foreach ($fligth_types as $key => $value)
                                        <option value="{{ $key }}" {{ old("fligth_type") == $key ? "selected" : "" }} >{{ $value }}</option>
                                    @endforeach
                                </select>
                                
                                <small class="text-danger">{{ $errors->first('fligth_type') }}</small>
                            </div>               
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group{{ $errors->has('fligth_condition') ? ' has-error' : '' }}">
                                <label for="fligth_condition">* Fligth Condition (D/N)</label>
                                <select id="fligth_condition" name="fligth_condition" class="form-control">
                                    <option value="">Select...</option>
                                    @foreach ($fligth_conditions as $key => $value)
                                        <option value="{{ $key }}" {{ old("fligth_condition") == $key ? "selected" : "" }} >{{ $value }}</option>
                                    @endforeach
                                </select>

                                <small class="text-danger">{{ $errors->first('fligth_condition') }}</small>
                            </div>                       
                        </div>

                    </div>

                    <div class="row" style="margin-bottom: 10px; ">
                        <div class="col-md-12 mb-3">
                            <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                                <label>Note</label>
                                <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Enter notes here...">{{ old('notes')}}</textarea>

                                <small class="text-danger">{{ $errors->first('notes') }}</small>
                            </div>   
                        </div>
                    </div>     

                </div>
                
            </div>

            <!-- Input addon -->
            <div class="box box-info">
                
                <div class="box-body">

                    <div class="col-md-6 mb-6" style="background-color: #c3cfe2;" >
                        <h4>Battery pack P001-001:</h4>
                        <div class="row" style="margin-bottom: 10px; ">
                            <div class="col-md-6 mb-3">
                                <label for="battery_volt_takeoff">Battery voltage at takeoff</label>
                                <div class="input-group{{ $errors->has('battery_volt_takeoff_001') ? ' has-error' : '' }}">
                                    <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                                    <input id="battery_volt_takeoff_001" name="battery_volt_takeoff_001" type="text" class="form-control" placeholder="Write voltage here" value="{{ old('battery_volt_takeoff_001')}}">

                                </div>
                                <small class="text-danger">{{ $errors->first('battery_volt_takeoff_001') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="battery_volt_landing_001">Battery voltage when landing</label>
                                <div class="input-group{{ $errors->has('battery_volt_landing_001') ? ' has-error' : '' }}">
                                    <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                                    <input id="battery_volt_landing_001" name="battery_volt_landing_001" type="text" class="form-control" placeholder="Write voltage here" value="{{ old('battery_volt_landing_001')}}">

                                </div>
                                <small class="text-danger">{{ $errors->first('battery_volt_landing_001') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-6" style="background-color: #d2f2f0;">
                        <h4>Battery pack P001-002:</h4>
                        <div class="row" style="margin-bottom: 10px; ">
                            <div class="col-md-6 mb-3">
                                <label for="battery_volt_takeoff_002">Battery voltage at takeoff</label>
                                <div class="input-group{{ $errors->has('battery_volt_takeoff_002') ? ' has-error' : '' }}">
                                    <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                                    <input id="battery_volt_takeoff_002" name="battery_volt_takeoff_002" type="text" class="form-control" placeholder="Write voltage here" value="{{ old('battery_volt_takeoff_002')}}">

                                </div>
                                <small class="text-danger">{{ $errors->first('battery_volt_takeoff_002') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="battery_volt_landing_002">Battery voltage when landing</label>
                                <div class="input-group{{ $errors->has('battery_volt_landing_002') ? ' has-error' : '' }}">
                                    <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                                    <input id="battery_volt_landing_002" name="battery_volt_landing_002" type="text" class="form-control" placeholder="Write voltage here" value="{{ old('battery_volt_landing_002')}}">

                                </div>
                                <small class="text-danger">{{ $errors->first('battery_volt_landing_002') }}</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>
    </section>
    @endsection
@endcomponent


<script type="text/javascript">

    $(document).ready(function(){

        $('#date').datepicker({
            format: "dd/mm/yyyy",
            daysOfWeekHighlighted: "0,6",
            autoclose: true
        });

        //$("#date").change(function() {
        //    $('#date_battery_data').val( $(this).val() );
        //});

        $('#ftime').durationPicker({
            showSeconds: true,
            showDays: false,
            onChanged: function (time) {
                $('#flight_time').val(time);
            }
        });

    })

</script>