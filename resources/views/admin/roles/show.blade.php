@component('layouts.admin.base')
    @slot('title') Proinver - Roles @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Roles Management @endslot

    @slot('breadcrumbFaIcon') fa-unlock-alt @endslot
    @slot('breadcrumbParent') Roles @endslot
    @slot('breadcrumbParentlink') {{ route('roles.index') }} @endslot
    @slot('breadcrumbChild') Show @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="box-title">Show role</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="pull-right">
                     <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                    </div>          
                  </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
			            <div class="form-group">
			                <strong>Name:</strong>
			                {{ $role->display_name }}
			            </div>
			        </div>
			        <div class="col-xs-12 col-sm-12 col-md-12">
			            <div class="form-group">
			                <strong>Description:</strong>
			                {{ $role->description }}
			            </div>
			        </div>
			        <div class="col-xs-12 col-sm-12 col-md-12">
			            <div class="form-group">
			                <strong>Assigned permissions:</strong>
			                @if(!empty($rolePermissions))
								@foreach($rolePermissions as $v)
									<label class="label label-success">{{ $v->display_name }}</label>
								@endforeach
							@endif
			            </div>
			        </div>
				</div>
            </div>
        </div>
        <!-- /.box-header -->
    </section>
    @endsection
@endcomponent