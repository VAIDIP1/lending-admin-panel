<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="../assets/favicon/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Vaidip Patel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" />

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/now-ui-dashboard.css?v=1.0.1') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/demo/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/auth/css/style.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="{{ asset('datatables-bs4/css/datatables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('datatables-responsive/css/responsive.bootstrap4.css') }}" rel="stylesheet" />

    <link href="{{ asset('datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />

    <!-- Core JS Files (jQuery FIRST) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js (required for Bootstrap dropdowns/tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
    
    <!-- Other Plugins -->
    <script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script src="{{ asset('assets/admin/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/bootstrap-notify.js') }}"></script>

    <!-- Now UI Dashboard -->
    <script src="{{ asset('assets/admin/js/now-ui-dashboard.js?v=1.0.1') }}"></script>
    <script src="{{ asset('assets/admin/demo/demo.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('datatables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('datatables-bs4/js/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatables-responsive/js/datatables.responsive.min.js') }}"></script>
    <script src="{{ asset('datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('datatables-buttons/js/buttons.colvis.min.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/auth/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('assets/auth/js/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Your Custom JS -->
    <script src="{{ asset('assets/js/common-functions.js') }}"></script>
</head>


<body class="">
    <div class="wrapper ">
        
<div class="sidebar">
            <div class="logo text-center">
                <img src="assets/admin/img/shree.svg" alt="logo" class="logo" height="100" width="100">
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="../examples/dashboard.html">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('systemsettings.index') }}">
                            <i class="now-ui-icons education_atom"></i>
                            <p>System Settings</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="fa-duotone fa-solid fa-users-gear"></i>
                            <p>User Role Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="../notifications.html">
                            <i class="now-ui-icons ui-1_bell-53"></i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li>
                        <a href="../examples/user.html">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="../examples/tables.html">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Table List</p>
                        </a>
                    </li>
                    <li>
                        <a href="../examples/typography.html">
                            <i class="now-ui-icons text_caps-small"></i>
                            <p>Typography</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="../examples/upgrade.html">
                            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>