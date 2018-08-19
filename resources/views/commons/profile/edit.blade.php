@component( $layout  )
    @slot('title') Profile edit @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Profile edit @endslot

    @slot('breadcrumbFaIcon') fa-user @endslot
    @slot('breadcrumbParent') Profile @endslot
    @slot('breadcrumbParentlink')  @endslot
    @slot('breadcrumbChild') Edit @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="box-title">Edit profile</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="pull-right">
                     <a class="btn btn-primary" href="{{ route('profile.view') }}"> Back</a>
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
                {!! Form::model($user, ['method' => 'POST','route' => ['profile.update', $user->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>First name:</strong>
                            {!! Form::text('firstname', null, array('placeholder' => 'First name','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Last name:</strong>
                            {!! Form::text('lastname', null, array('placeholder' => 'Last name','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            {!! Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control', 'readonly' => 'readonly')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        @permission(('user-edit'))
                            <button type="submit" class="btn btn-primary">Save</button>
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