<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Bitácoras de Redes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #004080;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            position: relative;
        }

        .action-buttons button {
            background-color: #006699;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #004080;
        }

        .actions {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            z-index: 10;
        }

        .actions a {
            display: block;
            padding: 8px 12px;
            background-color: #006699;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            margin: 5px 0;
        }

        .actions a:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Listado de Bitácoras de Redes</h1>
        <a href="<?php echo site_url('redes/nueva_bitacora'); ?>" class="action-btn">Agregar Nueva Bitácora</a>
    </div>

    <table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Responsable</th>
            <th>Políticas Evaluadas</th>
            <th>Estado de Cumplimiento</th>
            <th>Comentarios</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bitacoras as $bitacora): ?>
            <tr>
                <td><?php echo $bitacora['fecha']; ?></td>
                <td><?php echo $bitacora['responsable']; ?></td>
                <td>
                    <?php 
                    if (!empty($bitacora['politicas'])) {
                        $politicas = json_decode($bitacora['politicas'], true);
                        echo implode(", ", $politicas);
                    } else {
                        echo 'No hay políticas evaluadas';
                    }
                    ?>
                </td>
                <td><?php echo $bitacora['estado_cumplimiento']; ?></td>
                <td><?php echo $bitacora['comentarios']; ?></td>
                <td>
                    <a href="<?php echo site_url('redes/editar/' . $bitacora['id']); ?>">Editar</a>
                    <a href="<?php echo site_url('redes/eliminar/' . $bitacora['id']); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
