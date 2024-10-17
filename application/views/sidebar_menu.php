<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 class="text-center">Menú</h2>
    <a href="<?php echo site_url('bitacora/'); ?>">Nueva Bitácora</a>
    <a href="<?php echo site_url('bitacora/lista'); ?>">Ver Bitácoras</a>
    <a href="<?php echo site_url('camaras/'); ?>">Cámaras</a>
    <a href="<?= base_url('index.php/redes/nueva_bitacora') ?>">Nueva Bitácora de Redes</a>
    <a href="<?= base_url('index.php/redes/lista') ?>">Ver lista de bitácoras de redes</a>

</div>

<div class="content">
    <?php $this->load->view($contenido); ?>
</div>

</body>
</html>
