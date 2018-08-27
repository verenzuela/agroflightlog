@component('layouts.app.base')
    @slot('title') Show Flight @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Show Flight @endslot

    @slot('breadcrumbFaIcon') fa-plus-square-o @endslot
    @slot('breadcrumbParent') Flight @endslot
    @slot('breadcrumbParentlink')  @endslot
    @slot('breadcrumbChild') show @endslot

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
        
        <div class="box">
            
            <div class="box-body">

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Pilot</dt>
                            <dd>{{ $user->firstname }} {{ $user->lastname}}</dd>
                        </dl>                            
                    </div>

                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Drone Ident.</dt>
                            <dd>{{ $flight->drone_id }}</dd>
                        </dl> 
                    </div>
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Date</dt>
                            <dd>{{ $date }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Flight Time</dt>
                            <dd>{{ $flight->time }}</dd>
                        </dl>          
                    </div>
                </div>
                
                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Latitude</dt>
                            <dd>{{ $flight->latitude }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Longitude</dt>
                            <dd>{{ $flight->longitude }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Fligth Type</dt>
                            <dd>{{ $flight->type }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-3 mb-3">
                        <dl>
                            <dt>Fligth Condition (D/N)</dt>
                            <dd>{{ $flight->condition }}</dd>
                        </dl>
                    </div>

                </div>

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-md-12 mb-3">
                        <dl>
                            <dt>Note</dt>
                            <dd>{{ $flight->notes }}</dd>
                        </dl>
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
                            <dl>
                                <dt>Battery voltage at takeoff</dt>
                                <dd>{{ $battery_001[0]->volt_takeoff }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6 mb-3">
                            <dl>
                                <dt>Battery voltage when landing</dt>
                                <dd>{{ $battery_001[0]->volt_landing }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-6" style="background-color: #d2f2f0;">
                    <h4>Battery pack P001-002:</h4>
                    <div class="row" style="margin-bottom: 10px; ">
                        <div class="col-md-6 mb-3">
                            <dl>
                                <dt>Battery voltage at takeoff</dt>
                                <dd>{{ $battery_002[0]->volt_takeoff }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6 mb-3">
                            <dl>
                                <dt>Battery voltage when landing</dt>
                                <dd>{{ $battery_002[0]->volt_landing }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    @endsection
@endcomponent