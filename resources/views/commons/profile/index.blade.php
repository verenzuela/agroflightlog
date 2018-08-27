@component( $layout  )
    @slot('title') Profile @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Profile @endslot

    @slot('breadcrumbFaIcon') fa-user @endslot
    @slot('breadcrumbParent') User @endslot
    @slot('breadcrumbParentlink')  @endslot
    @slot('breadcrumbChild') Profile @endslot

    @slot('styles')

    @slot('scripts')

        <script type="text/javascript">
            
            $(document).ready(function () {

                $("#changePassword").validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 5
                        },
                        new_password: {
                            required: true,
                            minlength: 6
                        },
                        repeat_new_password: {
                            required: true,
                            minlength: 6,
                            equalTo: "#new_password"
                        },
                    },
                    messages: {
                        password: {
                            required: "Please provide a password"
                        },
                        new_password: {
                            required: "Please provide a new password",
                            minlength: "Your password must be at least 6 characters long",
                        },
                        repeat_new_password: {
                            required: "Please repeat a new password",
                            minlength: "Your password must be at least 6 characters long",
                            equalTo: "Please enter the same new password"
                        },
                        
                    }
                });

            });

        </script>

    @endslot

    @section('app-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="box-title">Show profile</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="pull-right">
                     <!--a class="btn btn-primary" href="{{ route('profile.view') }}"> Back</a-->
                    </div>          
                  </div>
                </div>
            </div>
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

                

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>First name:</strong>
                            {{ $user->firstname }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Last name:</strong>
                            {{ $user->lastname }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    
                </div>

                <div class="row" style="margin-bottom: 10px; ">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        
                        <button type="submit" data-toggle="modal" data-target="#modal-password" class="btn btn-primary">Change password</button>

                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit profile</a>

                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-header -->

        <div class="modal fade" id="modal-password">
            <div class="modal-dialog">
                {!! Form::model($user, ['id'=>'changePassword', 'name'=>'changePassword', 'method' => 'POST','route' => ['profile.update.password', $user->id]]) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Change password</h4>
                    </div>

                    <div class="modal-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Current password:</strong>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Current Password" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>New password:</strong>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Repeat new password:</strong>
                                <input type="password" class="form-control" name="repeat_new_password" id="repeat_new_password" placeholder="Repeat new Password" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        @permission(('user-edit'))
                            <button type="submit" class="btn btn-primary">Apply change</button>
                        @endpermission
                    </div>
                </div>
                {!! Form::close() !!}
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


    </section>
    @endsection
@endcomponent