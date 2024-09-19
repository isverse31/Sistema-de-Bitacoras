<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Bitácoras CTPAT</title>
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

        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #004080;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        a:hover {
            background-color: #006699;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
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
            position: relative; /* Para el posicionamiento del dropdown */
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
            position: absolute; /* Para posicionar el dropdown */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            z-index: 10; /* Asegura que aparezca encima de otros elementos */
        }

        .actions a {
            display: block; /* Para que los enlaces ocupen toda la fila */
            padding: 8px 12px;
            background-color: #006699;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }

        .actions a:hover {
            background-color: #004080;
        }
    </style>
</head>

<body>
    <h1>Lista de Bitácoras CTPAT</h1>
    <a href="<?php echo site_url('bitacora/'); ?>">Crear Nueva Bitácora</a>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Grabando Video</th>
            <th>Días de Video</th>
            <th>Comentarios</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($bitacoras as $bitacora): ?>
        <tr>
            <td><?php echo date('d/m/Y', strtotime($bitacora['fecha'])); ?></td>
            <td><?php echo $bitacora['grabando_video']; ?></td>
            <td><?php echo $bitacora['dias_video']; ?></td>
            <td><?php echo htmlspecialchars($bitacora['comentario']); ?></td>
            <td class="action-buttons">
                <button onclick="toggleActions(<?php echo $bitacora['id']; ?>)">Acciones</button>
                <div id="actions-<?php echo $bitacora['id']; ?>" class="actions">
                    <a href="<?php echo site_url('bitacora/detalles/'.$bitacora['id']); ?>">Ver Detalles</a>
                    <a href="<?php echo site_url('bitacora/editar/'.$bitacora['id']); ?>">Editar</a>
                    <a href="<?php echo site_url('bitacora/eliminar/'.$bitacora['id']); ?>"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta bitácora?');">Eliminar</a>
                </div>
                <a href="<?php echo site_url('bitacora/descargar_pdf/'.$bitacora['id']); ?>">Descargar PDF</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function toggleActions(id) {
            const actionsDiv = document.getElementById(`actions-${id}`);
            const isExpanded = actionsDiv.style.display === 'block';

            // Cerrar otros divs de acciones
            document.querySelectorAll('.actions').forEach(action => {
                action.style.display = 'none';
            });

            actionsDiv.style.display = isExpanded ? 'none' : 'block';
        }

        // Cerrar acciones al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.action-buttons')) {
                document.querySelectorAll('.actions').forEach(action => {
                    action.style.display = 'none';
                });
            }
        });
    </script>
</body>

</html>
