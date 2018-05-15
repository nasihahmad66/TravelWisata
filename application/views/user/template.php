<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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

<body>

    <div class="jumbotron text-center" style="margin-bottom:0; background-image:url('<?= base_url() ?>assets/image/Indonesia_2.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <h1 style="color: white">START YOUR TRIP</h1>
        <p style="color: white">Travel makes one modest, you see what a tiny place you occupy in the world.</p>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">My_Travel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">Ball Bearings</a>
                <a class="nav-item nav-link" href="#">TNT Boxes</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top:30px">
        <!-- CONTENT START -->
        <?php 
            $this->load->view($main_view);
         ?>
        <!-- CONTENT END -->
    </div>

    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Footer</p>
    </div>
    <script type="text/javascript">
        ko.applyBindings(model);
    </script>
</body>
</html>