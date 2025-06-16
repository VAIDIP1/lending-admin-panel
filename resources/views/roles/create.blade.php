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
            <h1>Add Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Users & Role Management</a></li>
              <li class="breadcrumb-item active">Add Role</li>
            </ol>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
            <!-- /.col -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-success btn-sm float-right" href="{{ route('roles.index') }}"> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" class="js-validation-material">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong>Name <span class="required_sign">*</span></strong>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Color Code <span class="required_sign">*</span></strong>
                            <input type="text" name="color_code" placeholder="Color Code" class="form-control color-picker">
                            <small>add color code without # tag</small>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission </strong>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                            @foreach($permission as $value)
                              <label for="checkbox">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }} {{ $value->name }}</label>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </div>
                </form>
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
$(function() {
   //form validation start
   customFormValidation({
        'name': {required:true,maxlength: 255 },
    },{
        'name': {required:'Please enter a name'},
    });
    //form validation end
});
</script>
@endsection
