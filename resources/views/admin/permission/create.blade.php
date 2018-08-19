@component('layouts.admin.base')
    @slot('title') Proinver Permission @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Permission @endslot

    @slot('breadcrumbFaIcon') fa-shield @endslot
    @slot('breadcrumbParent') Access Mangement @endslot
    @slot('breadcrumbParentlink')
    @slot('breadcrumbChild') Permission Create @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="box-title">Create Permission</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="pull-right">
                     <a class="btn btn-primary" href="{{ route('permission.index') }}"> Back</a>
                    </div>          
                  </div>
                </div>
            </div>
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
                {!! Form::open(array('route' => 'permission.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Permission','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('display_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box-header -->
    </section>
    @endsection
@endcomponent