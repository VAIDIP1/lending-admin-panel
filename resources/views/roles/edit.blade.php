@extends('layouts.app')

@section('content')
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('messages.home_label') }}</a></li>
              <li class="breadcrumb-item"><a href="#">Users & Role Management</a></li>
              <li class="breadcrumb-item active">Edit Permission</li>
            </ol>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
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
              {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id], 'class' => 'js-validation-material']) !!}
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong>Name <span class="required_sign">*</span></strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Color Code <span class="required_sign">*</span></strong>
                            {!! Form::text('color_code', $role->color_code, array('placeholder' => 'Color Code','class' => 'form-control')) !!}
                            <small>add color code without # tag</small>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group">
                          <strong>Is Required Notification <span class="required_sign">*</span></strong>
                          {!! Form::select('is_require_notification', config('global.status_dropdownlist'), $role->is_require_notification, array('class' => 'form-control select2')) !!}
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Is Required Invite User <span class="required_sign">*</span></strong>
                            {!! Form::select('is_require_invite_user', config('global.status_dropdownlist'), $role->is_require_invite_user, array('class' => 'form-control select2')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ __('messages.permission_label') }}</strong><br>
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                @foreach($permission as $value)
                                <div>
                                  <label for="checkbox">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                      {{ $value->name }}</label>
                                </div>
                                @endforeach
                              </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-sm">{!! __('messages.submit_label') !!}</button>
                    </div>
                </div>
                {!! Form::close() !!}
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
