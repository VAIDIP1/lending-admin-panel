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
            <h1>Edit System Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('messages.home_label') }}</a></li>
              <li class="breadcrumb-item"><a href="#">Users & Role Management</a></li>
              <li class="breadcrumb-item active">Edit System Setting</li>
            </ol>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($message = Session::get('success'))
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
          </div>
      </div>
    </div>
    @endif

    @if ($errors->any())
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
              <div class="card-header">
                <a class="btn btn-success btn-sm float-right" href="{{ route('systemsettings.index') }}"> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <form method="POST" action="/admin/systemsettings/{{ $systemsetting->id }}" enctype="multipart/form-data" class="js-validation-material">
                    @csrf
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Name <span class="required_sign">*</span></strong>
                                <input type="text" name="name" value="{{ $systemsetting->name }}" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Email <span class="required_sign">*</span></strong>
                                <input type="text" name="email" value="{{ $systemsetting->email }}" placeholder="Email" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Mobile <span class="required_sign">*</span></strong>
                                <input type="text" name="mobile" value="{{ $systemsetting->mobile }}" placeholder="Mobile" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Phone <span class="required_sign">*</span></strong>
                                <input type="text" name="phone" value="{{ $systemsetting->phone }}" placeholder="Phone" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Address 1 <span class="required_sign">*</span></strong>
                                <input type="text" name="address1" value="{{ $systemsetting->address1 }}" placeholder="Address 1" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Address 2 <span class="required_sign">*</span></strong>
                                <input type="text" name="address2" value="{{ $systemsetting->address2 }}" placeholder="Address 2" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Facebook URL <span class="required_sign">*</span></strong>
                                <input type="text" name="facebook_url" value="{{ $systemsetting->facebook_url }}" placeholder="Facebook URL" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Twitter URL <span class="required_sign">*</span></strong>
                                <input type="text" name="twitter_url" value="{{ $systemsetting->twitter_url }}" placeholder="Twitter URL" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>LinkedIn URL <span class="required_sign">*</span></strong>
                                <input type="text" name="linkedin_url" value="{{ $systemsetting->linkedin_url }}" placeholder="LinkedIn URL" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Instagram URL <span class="required_sign">*</span></strong>
                                <input type="text" name="instagram_url" value="{{ $systemsetting->instagram_url }}" placeholder="Instagram URL" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Default Template <span class=""></span></strong>
                                <input type="text" name="default_template" value="{{ $systemsetting->default_template }}" placeholder="Default Template" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Logo <span class="required_sign">*</span></strong>
                                <input type="file" name="logo_file" class="form-control">
                               
                                @if($systemsetting->logo && File::exists(public_path('uploads/'.$systemsetting->logo)))
                                    <img id="original" src="{{ url('uploads/'.$systemsetting->logo) }}" height="100" width="100" alt="Logo" title="Logo">
                                    <input type="hidden" name="old_logo_file" value="{{ $systemsetting->logo }}" class="form-control">
                                @else
                                    <img src="/uploads/no-image.svg" height="100" width="100" alt="No Preview" title="Default-Image"/>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Favicon <span class="required_sign">*</span></strong>
                                <input type="file" name="favicon_file" class="form-control">
                              
                                 @if($systemsetting->favicon && File::exists(public_path('uploads/'.$systemsetting->favicon)))
                                    <img id="original" src="{{ url('uploads/'.$systemsetting->favicon) }}" height="50" width="50" alt="Logo" title="Logo">
                                    <input type="hidden" name="old_favicon_file" value="{{ $systemsetting->favicon }}" class="form-control">
                                 @else
                                    <img src="/uploads/no-image.svg" height="100" width="100" alt="No Preview" title="Default-Image"/>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{!! __('messages.submit_label') !!}</button>
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
    $('.js-validation-material').validate({
        rules:{
            'name': {required:true},
            'email': {required:true, email: true},
            'phone': {required:false},
            'mobile': {required:true},
            'address1': {required:false},
            'address2': {required:false},
            'facebook_url': {required:true, url: true},
            'twitter_url': {required:true, url: true},
            'linkedin_url': {required:true, url: true},
            'instagram_url': {required:true,  url: true},
            'utc_dst_offset': {required:true},
            'notes': {required:true},
        },
        messages:{
            'name': {required:'Name is required'},
            'email': {required:'Email is required'},
            'phone': {required:'Phone is required'},
            'mobile': {required:'Mobile is required'},
            'address1': {required:'Address 1 is required'},
            'address2': {required:'Address 2 is required'},
            'facebook_url': {required:'Facebook URL is required'},
            'twitter_url': {required:'Twitter URL is required'},
            'linkedin_url': {required:'LinkedIn URL is required'},
            'instagram_url': {required:'Instagram URL is required'},
            'utc_dst_offset': {required:'UTC DST Offset is required'},
            'notes': {required:'Notes is required'},
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endsection
