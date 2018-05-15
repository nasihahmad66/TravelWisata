<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Travel Wisata</title>
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
            Processing: ko.observable(false)
        }
    </script>

    <script src="<?= base_url() ?>assets/main/login.js"></script>
</head>
<body style="margin-bottom:0; background-image:url('<?= base_url() ?>assets/image/Indonesia_2.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;height: 100%">
    <div class="container-fluid"
        <div class="row">
            <?php 
                $this->load->view($loader);
             ?>
            <div class="col-md-6 mx-auto" data-bind="visible: !model.Processing()">
                <div class="card card-body" style = "opacity: 0.9;" data-bind="with: login">
                    <h3 class="text-center mb-4">Daftar</h3>
                    <fieldset data-bind="with: recordRegister">
                        <div class="form-group has-error">
                            <input class="form-control input-lg" data-bind="value: USERNAME_CUSTOMER" placeholder="Username" name="username" type="text">
                        </div>
                        <div class="form-group has-success">
                            <input class="form-control input-lg" data-bind="value: PASSWORD_CUSTOMER" placeholder="Password" name="password" value="" type="password">
                        </div>
                        <div class="form-group">
                            <input class="form-control input-lg" data-bind="value: NAMA_CUSTOMER" placeholder="Nama" name="nama" value="" type="text">
                        </div>
                        <div class="form-group has-success">
                            <input class="form-control input-lg" data-bind="value: NOMOR_TELPON_CUSTOMER" placeholder="Nomor telepon" name="telepon" value="" type="number">
                        </div>
                        <div class="form-group has-success">
                            <textarea class="form-control input-lg" data-bind="value: ALAMAT_CUSTOMER" placeholder="Alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <span>Sudah punya akun?<a href="#loginModal" data-toggle="modal">||<b>Login</b></a></span><br>   
                        </div>
                        <!-- <input class="btn btn-lg btn-primary btn-block" value="Submit" type="submit"> -->
                        <button class="btn btn-lg btn-primary btn-block" onclick="login.doRegister()">Submit</button>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content" data-bind="with: login">
                <div class="modal-body" data-bind="with: recordLogin">
                        <center><H3>LOGIN</H3></center>
                        <div class="form-group has-error">
                            <input class="form-control input-lg" data-bind="value: USERNAME_CUSTOMER" placeholder="Username"  name="username" type="text">
                        </div>
                        <div class="form-group has-success">
                            <input class="form-control input-lg" data-bind="value: PASSWORD_CUSTOMER" placeholder="Password" name="password" value="" type="password">
                        </div>
                        <center>
                            <button class="btn btn-success col-md-3" onclick="login.doLogin()">Masuk</button>
                        </center>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        ko.applyBindings(model);
    </script>
</body>
</html>