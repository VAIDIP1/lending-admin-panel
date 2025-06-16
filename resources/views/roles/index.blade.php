@extends('admin.dashboard')

@section('content')
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Role Management</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($message = Session::get('success'))
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <em class="icon fas fa-check"></em> {{ $message }}
              </div>
          </div>
      </div>
    </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
          <div class="col-12">
            <div class="card">
              {{-- @can('role-create') --}}
                <div class="card-header">
                  <a class="btn btn-primary btn-sm float-right" href="{{ route('roles.create') }}"><em class="fa fa-plus"></em> Add</a>
                </div>
              {{-- @endcan --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTables-roles-example" class="table table-bordered table-striped">
                  <caption style="caption-side: top; text-align: left; font-weight: bold; padding: 5px 0; display: none;"></caption>
                  <thead>
                  <tr>
                    <th width="150px" scope="col">Action</th>
                    <th width="80px" scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th width="150px" scope="col">Action</th>
                    <th width="80px" scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
<script>
$(document).ready(function() {
    let ajax_url = "{{ url('allroles') }}";
    let columns_array = [
                { "data": "options" },
                { "data": "id" },
                { "data": "name" },
                { "data": "status" },
            ];
   dataTableDisplay('dataTables-roles-example', 'Roles', ajax_url, columns_array);
 });
</script>
@endsection
