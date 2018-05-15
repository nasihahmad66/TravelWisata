<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Travel Wisata</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- SWAL -->
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">

    <!-- BOOSTRAP TOGGLE -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-toggle/bootstrap-toggle.min.css">
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- KENDO -->
    <link href="<?= base_url() ?>assets/plugins/kendo/styles/kendo.common.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/kendo/styles/kendo.rtl.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/kendo/styles/kendo.default.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/kendo/styles/kendo.default.mobile.min.css" rel="stylesheet">
    <!-- <script src="<?= base_url() ?>assets/plugins/kendo/js/jquery.min.js"></script> -->
    <script src="<?= base_url() ?>assets/plugins/kendo/js/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/kendo/js/kendo.all.min.js"></script>

    <!-- KNOCK OUT -->
    <script src="<?= base_url() ?>assets/plugins/knockout/knockout.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/knockout/knockout.mapping-latest.debug.js"></script>
    <script src="<?= base_url() ?>assets/plugins/knockout/knockout.mapping-latest.js"></script>
    <script src="<?= base_url() ?>assets/plugins/knockout/knockout-kendo.min.js"></script>


    <!-- Common -->
    <script src="<?= base_url() ?>assets/dist/js/common.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/lodash.js"></script>

    <script type="text/javascript">
        var base_url = "<?= base_url() ?>"
        var model = {
            Processing: ko.observable(false),
            // IdTravel : ko.observable(ci_travel),
            // Role : ko.observable(ci_level)
        }
    </script>


</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li>
                    <a href="<?= base_url() ?>index.php/login/DoLogout">Logout</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="" class="d-block">ADMIN</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>index.php/dashboard" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>index.php/wisata" class="nav-link">
                                <i class="nav-icon fa fa-tree"></i>
                                <p>Wisata
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?= base_url() ?>index.php/paketharga" class="nav-link">
                                <i class="nav-icon fa fa fa-th"></i>
                                <p>Paket Harga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>index.php/transaksi" class="nav-link">
                                <i class="nav-icon fa fa-money"></i>
                                <p>Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?= $title ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- CONTENT START -->
                    <?php
                        $this->load->view($main_view); 
                    ?>
                        <!-- CONTENT END -->
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0-alpha
            </div>
            <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <script type="text/javascript">
        ko.applyBindings(model);
    </script>
</body>

</html>