@component('layouts.admin.base')
    @slot('title') Proinver Permission @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Permission @endslot

    @slot('breadcrumbFaIcon') fa-shield @endslot
    @slot('breadcrumbParent') Access Mangement @endslot
    @slot('breadcrumbParentlink')
    @slot('breadcrumbChild') Permission @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-header">
				<div class="row">
					<div class="col-sm-8">
						<h3 class="box-title">Permission Management</h3>
					</div>
					<div class="col-sm-4">
						<div class="pull-right">
				        	@permission(('permission-create'))
				            <a class="btn btn-primary" href="{{ route('permission.create') }}"> Create New Permission</a>
				            @endpermission
				        </div>
					</div>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">

				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>
				@endif
				<table class="table table-bordered">
					<tr>
						<th>No</th>
						<th>Permission</th>
						<th>Description</th>
						<th width="280px">Action</th>
					</tr>
					@foreach ($permissions as $key => $permission)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ $permission->display_name }}</td>
						<td>{{ $permission->description }}</td>
						<td>
							<!--a class="btn btn-info" href="{{ route('permission.show',$permission->id) }}">Show</a-->
							@permission(('permission-edit'))
								<a class="btn btn-primary" href="{{ route('permission.edit',$permission->id) }}">Edit</a>
							@endpermission

							@permission(('permission-delete'))
								{!! Form::open(['method' => 'DELETE','route' => ['permission.destroy', $permission->id],'style'=>'display:inline']) !!}
					            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					        	{!! Form::close() !!}
				        	@endpermission
						</td>
					</tr>
					@endforeach
				</table>
				{!! $permissions->render() !!}

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<!-- /.content -->
  @endsection

@endcomponent