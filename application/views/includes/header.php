<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title)? $title : 'Default title'?></title>
        <!-- <link href="<?php echo base_url();?>images/icono_megacable.ico" type="image/x-icon" rel="shortcut icon" /> -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    </head>
<body>
    <div id="web">
        <div id="header">
        </div><!-- Fin div ID header-->
        <nav><!-- Barra de navegación -->
            <ul>
                <li><a href="<?php echo base_url();?>home">Inicio</a></li>
                <li><a href="<?php echo base_url();?>nodos">Nodos</a></li>
            </ul>
        </nav>