<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bitácora de Redes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="date"],
        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .checkbox-group {
            margin-bottom: 15px;
        }
        .checkbox-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .checkbox-item input[type="checkbox"] {
            margin-right: 10px;
        }
        .checkbox-item label {
            font-weight: normal;
        }
        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }

        
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Bitácora de Redes</h1>
        
        <form method="post" action="<?php echo site_url('redes/guardar'); ?>">
            <!-- ID (oculto) -->
            <input type="hidden" name="id" value="<?php echo isset($bitacora['id']) ? $bitacora['id'] : ''; ?>">

            <!-- Fecha -->
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo isset($bitacora['fecha']) ? $bitacora['fecha'] : ''; ?>" required>

            <!-- Responsable -->
            <label for="responsable">Responsable:</label>
            <input type="text" name="responsable" id="responsable" value="<?php echo isset($bitacora['responsable']) ? $bitacora['responsable'] : ''; ?>" required>

            <!-- Políticas evaluadas -->
            <label>Políticas evaluadas:</label>
            <div class="checkbox-group">
                <?php
                // Asegurarse de que $bitacora['politicas_evaluadas'] sea un array
                $politicas = [];
                if (isset($bitacora['politicas'])) {
                    if (is_string($bitacora['politicas'])) {
                        $politicas = json_decode($bitacora['politicas'], true);
                    } elseif (is_array($bitacora['politicas'])) {
                        $politicas = $bitacora['politicas'];
                    }
                }

                // Lista de todas las políticas
                $politicas_list = [
                    'Monitoreo de red', 
                    'Actualización del firewall', 
                    'Revisar bitácoras del firewall',
                    'Mantener actualizada la base de datos de vulnerabilidades en sistemas',
                    'Monitoreo de puertos y Analizar el tráfico de red',
                    'Monitoreo del uso de sistemas internos y accesos a sitios web externos'
                ];

                foreach ($politicas_list as $politica) {
                    $checked = in_array($politica, $politicas) ? 'checked' : '';
                    $id = 'politica_' . md5($politica);
                    echo '<div class="checkbox-item">';
                    echo '<input type="checkbox" name="politicas[]" value="' . htmlspecialchars($politica, ENT_QUOTES, 'UTF-8') . '" id="' . $id . '" ' . $checked . '>';
                    echo '<label for="' . $id . '">' . htmlspecialchars($politica, ENT_QUOTES, 'UTF-8') . '</label>';
                    echo '</div>';
                }
                ?>
            </div>

            <!-- Estado de cumplimiento -->
            <label for="estado_cumplimiento">Estado de Cumplimiento:</label>
            <select name="estado_cumplimiento" id="estado_cumplimiento" required>
                <option value="Completado" <?php echo (isset($bitacora['estado_cumplimiento']) && $bitacora['estado_cumplimiento'] == 'Completado') ? 'selected' : ''; ?>>Completado</option>
                <option value="En progreso" <?php echo (isset($bitacora['estado_cumplimiento']) && $bitacora['estado_cumplimiento'] == 'En progreso') ? 'selected' : ''; ?>>En progreso</option>
                <option value="No Cumplido" <?php echo (isset($bitacora['estado_cumplimiento']) && $bitacora['estado_cumplimiento'] == 'No Cumplido') ? 'selected' : ''; ?>>No Cumplido</option>
            </select>

            <!-- Comentarios -->
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" rows="4"><?php echo isset($bitacora['comentarios']) ? $bitacora['comentarios'] : ''; ?></textarea>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>