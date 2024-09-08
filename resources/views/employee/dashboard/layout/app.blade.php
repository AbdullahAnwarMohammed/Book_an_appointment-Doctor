<!DOCTYPE html>
<!--
Template Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/modern_admin
Renew Support: https://1.envato.market/modern_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<!-- Mirrored from demos.pixinvent.com/modern-html-admin-template/html/rtl/hospital-menu-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Aug 2024 04:06:01 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>لوحة تحكم الدكتور</title>
    <link rel="apple-touch-icon" href="/backend/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon"
        href="https://demos.pixinvent.com/modern-html-admin-template/app-assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/vendors/css/vendors-rtl.min.css">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css-rtl/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css-rtl/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css-rtl/colors.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css-rtl/components.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css-rtl/custom-rtl.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="/backend/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/app-assets/css/pages/hospital.min.css">
    <!-- END: Page CSS-->


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/backend/assets/css/style-rtl.css">
    <!-- END: Custom CSS-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');
        input.form-control,select.form-control{
            padding:2s5px !important;
        }
        #table_wrapper {
            direction: ltr;
        }
        
        .dt-layout-table {
            direction: rtl;
        }

        body,
        a,
        li,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Tajawal", sans-serif;

        }
    </style>
    @stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">

    @include('employee.layout.template.menu')

    <!-- BEGIN: Main Menu-->

    @include('employee.layout.template.nav')


    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- Hospital Info cards -->
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->




    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a
                    class="text-bold-800 grey darken-2" href="https://1.envato.market/modern_admin"
                    target="_blank">PIXINVENT</a></span></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="/backend/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/backend/app-assets/vendors/js/charts/chart.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/backend/app-assets/js/core/app-menu.min.js"></script>
    <script src="/backend/app-assets/js/core/app.min.js"></script>
    <script src="/backend/app-assets/js/scripts/customizer.min.js"></script>
    <script src="/backend/app-assets/js/scripts/footer.min.js"></script>
    <!-- END: Theme JS-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

    <!-- BEGIN: Page JS-->
    <script src="/backend/app-assets/js/scripts/pages/appointment.min.js"></script>

    <script>
        var table = new DataTable('#table', {
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.3/i18n/ar.json',
            },
        });
    </script>
    @stack('js')
</body>

</html>
