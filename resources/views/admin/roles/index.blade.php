@component('layouts.admin.base')
    @slot('title') Proinver - Roles @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Roles Management @endslot

    @slot('breadcrumbFaIcon') fa-unlock-alt @endslot
    @slot('breadcrumbParent') Roles @endslot
    @slot('breadcrumbParentlink')
    @slot('breadcrumbChild') List @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-8">
                <h3 class="box-title">List of Roles</h3>
              </div>
              <div class="col-sm-4">
                <div class="pull-right">
					@permission(('role-create'))
						<a class="btn btn-primary" href="{{ route('roles.create') }}">Create New Role</a>
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
					<th>Name</th>
					<th>Description</th>
					<th width="280px">Action</th>
				</tr>
				@foreach ($roles as $key => $role)
				<tr>
					<td>{{ ++$i }}</td>
					<td>{{ $role->display_name }}</td>
					<td>{{ $role->description }}</td>
					<td>
						<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
						
						@permission(('role-edit'))
							<a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
						@endpermission

						@permission(('role-delete'))
							{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
				            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
				        	{!! Form::close() !!}
			        	@endpermission
					</td>
				</tr>
				@endforeach
			</table>
			{!! $roles->render() !!}
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  @endsection

@endcomponent