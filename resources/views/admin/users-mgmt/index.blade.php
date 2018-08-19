@component('layouts.admin.base')
    @slot('title') Users @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') Users Management @endslot

    @slot('breadcrumbFaIcon') fa-users @endslot
    @slot('breadcrumbParent') Users @endslot
    @slot('breadcrumbParentlink')
    @slot('breadcrumbChild') List @endslot

    @slot('styles')
    @slot('scripts')

    @section('app-content')
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-8">
                <h3 class="box-title">List of users</h3>
              </div>
              <div class="col-sm-4">
                <div class="pull-right">
                  @permission(('user-create'))
                    <a class="btn btn-primary" href="{{ route('user-management.create') }}">Add new user</a>
                  @endpermission
                </div>
              </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('user-management.search') }}">
         {{ csrf_field() }}
         @component('commons.search', ['title' => 'Search'])
          @component('commons.two-cols-search-row', ['items' => ['User Name', 'First Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['username'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
          @endcomponent
          </br>
          @component('commons.two-cols-search-row', ['items' => ['Last Name', 'Department'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['lastname'] : '', isset($searchingVals) ? $searchingVals['department'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">User Name</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">First Name</th>
                <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Role</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td class="hidden-xs">{{ $user->firstname }}</td>
                  <td class="hidden-xs">{{ $user->lastname }}</td>
                  <td>
                    @if(!empty($user->roles))
                      @foreach($user->roles as $v)
                        <label class="label label-success">{{ $v->display_name }}</label>
                      @endforeach
                    @endif
                  </td>
                  <td>
                    
                    <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        
                        <input type="hidden" name="_method" value="DELETE">
                        
                        @permission(('user-edit'))
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-warning  btn-margin">
                          Update
                          </a>
                        @endpermission

                        @permission(('user-delete'))
                          @if ($user->username != Auth::user()->username)
                           <button type="submit" class="btn btn-sm btn-danger  btn-margin">
                            Delete
                          </button>
                          @endif
                        @endpermission
                    </form>
                    
                  </td>
              </tr>
            @endforeach
            </tbody>
            
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  @endsection

@endcomponent