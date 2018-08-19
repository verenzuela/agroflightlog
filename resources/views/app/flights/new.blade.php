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
    <style>
        
    </style>
    @endslot

    @slot('scripts')

    @section('app-content')
    
    <!-- Main content -->
    <section class="content">
        
        <div class="box">

            <div class="box-body">

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-6 mb-3">
                        <div class="form-group ">
                            <label for="pilot">Pilot</label>
                            <input type="text" class="form-control" id="pilot" name="pilot" placeholder="" value="" >
                        </div>   
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group ">
                            <label for="flight_time">Flight Time</label>
                            <input type="text" class="form-control" id="flight_time" name="flight_time" placeholder="" value="" >
                        </div>                       
                    </div>
                </div>
                    
                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-4 mb-3">
                        <div class="form-group ">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="" value="" >
                        </div>   
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group ">
                            <label for="drone_id-repeat">Drone ID</label>
                            <input type="text" class="form-control" id="drone_id" name="drone_id" placeholder="" value="" >
                        </div>                       
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group ">
                            <label for="fligth_type">Fligth Type</label>
                            <input type="text" class="form-control" id="fligth_type" name="fligth_type" placeholder="" value="" >
                        </div>                       
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-4 mb-3">
                        <div class="form-group ">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="" value="" >
                        </div>   
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group ">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="" value="" >
                        </div>                       
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group ">
                            <label for="fligth_conditions">Fligth Condition (D/N)</label>
                            <input type="text" class="form-control" id="fligth_conditions" name="fligth_conditions" placeholder="" value="" >
                        </div>                       
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-12 mb-3">
                        <div class="form-group ">
                            <label>Note</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter notes here..."></textarea>
                        </div>   
                    </div>
                </div>

                
                  

            </div>
            
        </div>

        <!-- Input addon -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Battery Control Information</h3>
            </div>
            <div class="box-body">

                

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-6 mb-3">
                        <label for="date_battery_data">Date</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input id="date_battery_data" name="date_battery_data" type="text" class="form-control" placeholder="Write Date here">
                        </div>
                    </div>
                    
                </div>

                <hr>

                <h4>Battery pack P001-001:</h4>
                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-6 mb-3">
                        <label for="battery_volt_takeoff">Battery voltage at takeoff</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                            <input id="battery_volt_takeoff" name="battery_volt_takeoff" type="text" class="form-control" placeholder="Write voltage here">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="battery_volt_landing">Battery voltage when landing</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                            <input id="battery_volt_landing" name="battery_volt_landing" type="text" class="form-control" placeholder="Write voltage here">
                        </div>                   
                    </div>
                </div>

                <hr>

                <h4>Battery pack P001-002:</h4>
                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-6 mb-3">
                        <label for="battery_volt_takeoff">Battery voltage at takeoff</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                            <input id="battery_volt_takeoff" name="battery_volt_takeoff" type="text" class="form-control" placeholder="Write voltage here">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="battery_volt_landing">Battery voltage when landing</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-battery-quarter" aria-hidden="true"></i></span>
                            <input id="battery_volt_landing" name="battery_volt_landing" type="text" class="form-control" placeholder="Write voltage here">
                        </div>                   
                    </div>
                </div>

                
            </div>
        </div>

    </section>
    @endsection
@endcomponent