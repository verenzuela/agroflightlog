@component('layouts.app.base')
    @slot('title') My Flights @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') My Flights @endslot

    @slot('breadcrumbFaIcon') fa-list @endslot
    @slot('breadcrumbParent') Flights @endslot
    @slot('breadcrumbParentlink')  @endslot
    @slot('breadcrumbChild') List @endslot

    @slot('styles')
    <style>
        
    </style>
    @endslot

    @slot('scripts')

    @section('app-content')
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                <div class="box-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('errors'))
                        <div class="alert alert-error">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Drone Ident</th>
                                <th class="hidden-xs">Type</th>
                                <th>Condition</th>
                                <th class="hidden-xs">Flight date</th>
                                <th>Flight time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($flights) > 0 )
                                @foreach ($flights as $flight)
                                <tr>
                                    <td class="sorting_1">{{ $flight->drone_id }}</td>
                                    <td class="hidden-xs">{{ $flight->type }}</td>
                                    <td>{{ $flight->condition }}</td>
                                    <td class="hidden-xs">{{ date('d/m/Y', strtotime(str_replace('/', '-', $flight->date))) }}</td>
                                    <td>{{ $flight->time }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('flights.destroy', ['id' => $flight->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            
                                            @permission(('flights-list'))
                                                <a href="{{ route('flights.show', ['id' => $flight->id]) }}" class="btn btn-sm btn-warning  btn-margin">
                                                    Show
                                                </a>
                                            @endpermission

                                            @permission(('flights-edit'))
                                                <a href="{{ route('flights.edit', ['id' => $flight->id]) }}" class="btn btn-sm btn-info  btn-margin">
                                                    Update
                                                </a>
                                            @endpermission

                                            @permission(('flights-delete'))
                                                <button type="submit" class="btn btn-sm btn-danger  btn-margin">
                                                    Delete
                                                </button>
                                            @endpermission
                                        </form>                                    
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"> You do not have registered flights yet </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @endsection
@endcomponent