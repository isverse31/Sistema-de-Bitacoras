<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Bitácora CTPAT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #004080;
            padding-bottom: 10px;
        }

        .header img {
            width: 100px;
        }

        .header-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004080;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #006699;
        }

        .btn-edit {
            background-color: #FFA500;
        }

        .btn-edit:hover {
            background-color: #FF8C00;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://ketermex.com/img/logoketer.png" alt="Keter">
            <div class="header-right">
                <p><strong>Physical</strong></p>
                <?php if (!empty($bitacora)) : ?>
                    <p>Number: PRO-CT PAT-<?php echo $bitacora['fecha']; ?></p>
                    <p>Page: 1 of 2</p>
                    <p>Date: <?php echo $bitacora['fecha']; ?></p>
                <?php else : ?>
                    <p>No se encontraron detalles para la bitácora.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($bitacora)) { ?>
            <p>Fecha: <?php echo $bitacora['fecha']; ?></p>
            <p>¿El sistema está grabando video?
                <input type="checkbox" <?php echo $bitacora['grabando_video'] === 'Si' ? 'checked' : ''; ?> disabled> Sí
                <input type="checkbox" <?php echo $bitacora['grabando_video'] === 'No' ? 'checked' : ''; ?> disabled> No
            </p>
            <p>¿El sistema almacena al menos <?php echo $bitacora['dias_video']; ?> días de video?
                <input type="checkbox" <?php echo $bitacora['almacena_dias'] === 'Si' ? 'checked' : ''; ?> disabled> Sí
                <input type="checkbox" <?php echo $bitacora['almacena_dias'] === 'No' ? 'checked' : ''; ?> disabled> No
            </p>

            <table>
                <tr>
                    <th>Cámara</th>
                    <th>Sin alimentación</th>
                    <th>Imagen borrosa</th>
                    <th>Obstruida</th>
                    <th>Frente al suelo</th>
                    <th>Mala iluminación</th>
                    <th>Observaciones</th>
                </tr>
                <?php if (!empty($bitacora['detalles']) && is_array($bitacora['detalles'])) : ?>
                    <?php foreach ($bitacora['detalles'] as $index => $detalle) : ?>
                        <tr>
                            <td>Cámara <?php echo $index + 1; ?></td>
                            <td><input type="checkbox" <?php echo $detalle['sin_alimentacion'] ? 'checked' : ''; ?> disabled></td>
                            <td><input type="checkbox" <?php echo $detalle['imagen_borrosa'] ? 'checked' : ''; ?> disabled></td>
                            <td><input type="checkbox" <?php echo $detalle['obstruida'] ? 'checked' : ''; ?> disabled></td>
                            <td><input type="checkbox" <?php echo $detalle['frente_al_suelo'] ? 'checked' : ''; ?> disabled></td>
                            <td><input type="checkbox" <?php echo $detalle['mala_iluminacion'] ? 'checked' : ''; ?> disabled></td>
                            <td><?php echo !empty($detalle['observaciones']) ? $detalle['observaciones'] : 'Sin detalles'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">No hay detalles para mostrar.</td>
                    </tr>
                <?php endif; ?>
            </table>

            <p><strong>Comentarios:</strong> <?php echo $bitacora['comentario']; ?></p>

            <a href="<?php echo site_url('bitacora/descargar_pdf/' . $bitacora['id']); ?>" class="btn">Descargar PDF</a>
            <!-- Botón de Editar que redirige al formulario de edición -->
            <a href="<?php echo site_url('bitacora/editar/' . $bitacora['id']); ?>" class="btn btn-edit">Editar</a>
        <?php } else { ?>
            <p>No se encontraron detalles de la bitácora.</p>
        <?php } ?>
    </div>
</body>

</html>
