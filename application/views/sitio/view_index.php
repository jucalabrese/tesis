<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SEP - Sistema de Evaluación de Producto</title>

        <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo_2.jpg')?>">
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url('assets/bootstrap/css/shop-homepage.css')?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">   
        <link href="<?php echo base_url('assets/bootstrap/css/half-slider.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/estilos.css')?>" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&subset=latin,latin-ext" rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Arimo:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Catamaran&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>

        <script src="<?php echo base_url('assets/js/jquery.js')?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/funciones.js')?>" type="text/javascript"></script>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistema de Evaluación de Producto">
        <meta name="author" content="Julieta Calabrese y Rocio Muñoz"> 
    </head>
    <body>
        <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>" />
        <!-- Barra de navegación -->
        <?php $this->load->view('sitio/view_navbar'); ?>

        <!-- Cuerpo -->
        <div class="container-fluid" style="min-height: 90%"> 
            <?php echo $cuerpo; ?>
        </div>

        <!-- Footer -->
        <?php $this->load->view('sitio/view_footer'); ?>    
    </body>
</html>
