<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Bitácoras de Redes</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --background-color: #ecf0f1;
            --text-color: #34495e;
            --accent-color: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .add-btn {
            display: inline-block;
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .add-btn:hover {
            background-color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--secondary-color);
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-download {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-edit {
            background-color: #f39c12;
            color: white;
        }

        .btn-delete {
            background-color: var(--accent-color);
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            table, tr, td {
                display: block;
            }

            tr {
                margin-bottom: 20px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Listado de Bitácoras de Redes</h1>
            <a href="<?php echo site_url('redes/nueva_bitacora'); ?>" class="add-btn">Agregar Nueva Bitácora</a>
        </div>
    </header>

    <main class="container">
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
                    <td data-label="Fecha"><?php echo $bitacora['fecha']; ?></td>
                    <td data-label="Responsable"><?php echo $bitacora['responsable']; ?></td>
                    <td data-label="Políticas Evaluadas">
                        <?php 
                        if (!empty($bitacora['politicas'])) {
                            $politicas = json_decode($bitacora['politicas'], true);
                            echo implode(", ", $politicas);
                        } else {
                            echo 'No hay políticas evaluadas';
                        }
                        ?>
                    </td>
                    <td data-label="Estado de Cumplimiento"><?php echo $bitacora['estado_cumplimiento']; ?></td>
                    <td data-label="Comentarios"><?php echo $bitacora['comentarios']; ?></td>
                    <td data-label="Acciones">
                        <div class="action-btns">
                            <a href="<?php echo site_url('redes/descargar_pdf/' . $bitacora['id']); ?>" class="btn btn-download">Descargar PDF</a>
                            <a href="<?php echo site_url('redes/editar/' . $bitacora['id']); ?>" class="btn btn-edit">Editar</a>
                            <a href="<?php echo site_url('redes/eliminar/' . $bitacora['id']); ?>" class="btn btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar esta bitácora?');">Eliminar</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>