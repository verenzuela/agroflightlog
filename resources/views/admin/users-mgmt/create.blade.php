@component('layouts.admin.base')
    @slot('title') User new @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Users Management @endslot

    @slot('breadcrumbFaIcon') fa-user-plus @endslot
    @slot('breadcrumbParent') User @endslot
    @slot('breadcrumbParentlink')
    @slot('breadcrumbChild') Create @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="box-title">Add new user</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="pull-right">
                     <a class="btn btn-primary" href="{{ route('user-management.index') }}"> Back</a>
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
                {!! Form::open(array('route' => 'user-management.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Username:</strong>
                            {!! Form::text('username', null, array('placeholder' => 'username','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>First Name:</strong>
                            {!! Form::text('firstname', null, array('placeholder' => 'firstname','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Last Name:</strong>
                            {!! Form::text('lastname', null, array('placeholder' => 'lastname','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            {!! Form::password('password-confirm', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong>
                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        @permission(('user-create'))
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