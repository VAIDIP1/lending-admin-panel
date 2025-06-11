@extends('admin.dashboard')

@section('content')
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row m-0">
          <div class="col-sm-6">
            <h1>System Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right justify-content-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">System Settings</li>
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
                <i class="icon fas fa-check"></i>{{ $message }}
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
                <div class="card-header" style="visibility:hidden;">
                  <a class="btn btn-primary btn-sm float-right" href="#"><em class="fa fa-plus"></em> {{ __('messages.add_label') }}</a>
                </div>
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTables-systemsettings-example" class="table table-bordered table-striped">
                  <caption style="caption-side: top; text-align: left; font-weight: bold; padding: 5px 0; display: none;"></caption>
                  <thead>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Name</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Name</th>
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
    let ajax_url = "{{ url('allsystemsettings') }}";
    let columns_array = [
                { "data": "options", "bSortable": false, "bSearchable": false, "ordering": false, "width": "10%" },
                { "data": "name" },
                
            ];
   dataTableDisplay('dataTables-systemsettings-example', 'System Settings', ajax_url, columns_array);
 });
</script>
@endsection
