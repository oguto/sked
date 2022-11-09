<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title> Sked | Sistema web</title>
    <meta name="description" content="Vidde">
    <meta name="author" content="nelos.com.br">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url(); ?>includes/img/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <?php echo $css; ?>
    <link href="<?php echo base_url(); ?>includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>includes/css/sb-admin-2.css" rel="stylesheet">


</head>
<body id="page-top">
    <div id="wrapper">
        <?php echo $modal ;?>
        <?php echo $menu ;?>
        <div id="content-wrapper" class="d-flex flex-column">
            <?php echo $header ;?>
            <div id="content" class="corpo">
                <div class="container-fluid home conteudo">

                    <?php echo $content ;?>
                </div>
                <?php echo $footer ;?>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>includes/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>includes/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>includes/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>includes/vendor/chart.js/Chart.min.js"></script>
    <?php echo $script; ?>


</body>

</html>
