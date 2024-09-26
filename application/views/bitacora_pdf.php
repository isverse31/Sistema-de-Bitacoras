<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles de Bitácora CTPAT</title>
    <style>
    body {
        font-family: 'dejavusans', sans-serif;
        font-size: 11px;
    }

    .camera-table {
        text-align: center;
    }

    .header-table {
        width: 100%;
        text-align: center;
        border-collapse: center;
        margin-bottom: 20px;
    }

    .header-table td {
        border: 1px solid #000;
        padding: 10px;
    }

    .header-table .logo-cell {
        vertical-align: middle;
        /* Cambiado a middle */
        padding-top: 0;
        /* Ajustado para quitar el espacio superior */
    }

    .header-table img {
        width: 30px;
        height: 30px;
        max-height: 30px;
    }

    .header-left {
        text-align: center;
        font-size: 12px;
        font-weight: center;
        vertical-align: middle;
    }

    .header-center {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
    }

    .header-right {
        text-align: right;
        font-size: 12px;
    }

    .header-right p {
        margin: 0;
    }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td rowspan="2" style="width: 35%;" class="logo-cell">
                <img src="<?php echo FCPATH . 'assets/images/logoketer.png'; ?>" alt="Mi Imagen">
            </td>
            <td class="header-center" style="width: 25%;">
                Physical
            </td>
            <td class="header-right" style="width: 20%">
                <p>Number:
                    PRO-CTPAT-<?php
                        $fechaOriginal = $bitacora[0]['fecha'];
                        $timestamp = strtotime($fechaOriginal);
                        echo date('y-m', $timestamp); 
                    ?>
                </p>
            </td>
            <td class="header-right" style="width: 20%;">
                <p>Date: <?php 
                    $fechaOriginal = $bitacora[0]['fecha'];
                    $timestamp = strtotime($fechaOriginal);
                    echo date('m-d-y', $timestamp); 
                ?></p>
            </td>
        </tr>
    </table>

    <p><strong>Fecha:</strong> <?php 
        $fechaOriginal = $bitacora[0]['fecha'];
        $timestamp = strtotime($fechaOriginal);
        echo date('m-d-y', $timestamp); 
    ?></p>

    <p><strong>¿El sistema está grabando video?:</strong> <?php echo $bitacora[0]['grabando_video']; ?></p>
    <p><strong>¿Almacena al menos <?php echo $bitacora[0]['dias_video']; ?> días de video?:</strong>
        <?php echo $bitacora[0]['almacena_dias']; ?>
    </p>

    <?php if (!empty($bitacora)): ?>
    <?php foreach ($bitacora as $index => $detalle): ?>
    <br>
    <div class="camera-title">
        Cámara <?php echo $index + 1; ?>:
        <?php echo isset($detalle['observaciones']) && !empty($detalle['observaciones']) ? $detalle['observaciones'] : 'Sin detalles'; ?>
    </div><br>

    <table class="camera-table">
        <thead>
            <tr>
                <th>Sin alimentación</th>
                <th>Imagen borrosa</th>
                <th>Obstruida</th>
                <th>Frente al suelo</th>
                <th>Mala iluminación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo isset($detalle['sin_alimentacion']) && $detalle['sin_alimentacion'] ? '✓' : ''; ?></td>
                <td><?php echo isset($detalle['imagen_borrosa']) && $detalle['imagen_borrosa'] ? '✓' : ''; ?></td>
                <td><?php echo isset($detalle['obstruida']) && $detalle['obstruida'] ? '✓' : ''; ?></td>
                <td><?php echo isset($detalle['frente_al_suelo']) && $detalle['frente_al_suelo'] ? '✓' : ''; ?></td>
                <td><?php echo isset($detalle['mala_iluminacion']) && $detalle['mala_iluminacion'] ? '✓' : ''; ?></td>
            </tr>
        </tbody>
    </table>
    <?php endforeach; ?>
    <?php else: ?>
    <p>No se encontraron detalles de la bitácora.</p>
    <?php endif; ?>

    <p><strong>Comentarios:</strong>
        <?php echo isset($bitacora[0]['comentario']) ? $bitacora[0]['comentario'] : 'No hay comentarios'; ?></p><br>

    <p><strong>Completado por:</strong></p>
    <p>Nombre: ________________________</p>
    <p>Cargo: _________________________</p>
    <p>Firma: _________________________</p>

</body>

</html>