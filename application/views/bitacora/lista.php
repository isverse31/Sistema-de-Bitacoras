<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Bitácoras CTPAT</title>
    <style>
        :root {
            --primary-color: #004080;
            --secondary-color: #006699;
            --background-color: #f4f4f4;
            --text-color: #333;
            --success-color: #28a745;
            --error-color: #dc3545;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0px;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--primary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: var(--text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Bitácoras CTPAT</h1>
        <a href="<?php echo site_url('bitacora/'); ?>" class="btn">Crear Nueva Bitácora</a>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Grabando Video</th>
                    <th>Días de Video</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bitacoras as $bitacora): ?>
                <tr>
                    <td data-label="Fecha"><?php echo date('d/m/Y', strtotime($bitacora['fecha'])); ?></td>
                    <td data-label="Grabando Video"><?php echo $bitacora['grabando_video'] === 'Si' ? 'Sí' : 'No'; ?></td>
                    <td data-label="Días de Video"><?php echo $bitacora['dias_video']; ?></td>
                    <td data-label="Comentarios"><?php echo htmlspecialchars($bitacora['comentario']); ?></td>
                    <td data-label="Acciones" class="action-buttons">
                        <div class="dropdown">
                            <button onclick="toggleDropdown(<?php echo $bitacora['id']; ?>)" class="btn">Acciones</button>
                            <div id="dropdown-<?php echo $bitacora['id']; ?>" class="dropdown-content">
                                <a href="<?php echo site_url('bitacora/detalles/'.$bitacora['id']); ?>">Ver Detalles</a>
                                <a href="<?php echo site_url('bitacora/editar/'.$bitacora['id']); ?>">Editar</a>
                                <a href="<?php echo site_url('bitacora/eliminar/'.$bitacora['id']); ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar esta bitácora?');">Eliminar</a>
                            </div>
                        </div>
                        <a href="<?php echo site_url('bitacora/descargar_pdf/'.$bitacora['id']); ?>" class="btn">Descargar PDF</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleDropdown(id) {
            document.getElementById("dropdown-" + id).classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>