@component('layouts.admin.base')
    @slot('title') Proinver - Roles @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Roles Management @endslot

    @slot('breadcrumbFaIcon') fa-unlock-alt @endslot
    @slot('breadcrumbParent') Roles @endslot
    @slot('breadcrumbParentlink') {{ route('roles.index') }} @endslot
    @slot('breadcrumbChild') Create @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="box-title">Add new rol</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="pull-right">
                     <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
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
                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Display Name:</strong>
                            {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Available permissions:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->display_name }}</label>
                                <br/>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        @permission(('role-create'))
                            <button type="submit" class="btn btn-primary">Submit</button>
                        @endpermission
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box-header -->
    </section>
    @endsection
@endcomponent