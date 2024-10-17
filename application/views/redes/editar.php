<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Bitácora de Redes</title>
</head>
<body>
    <h1>Editar Bitácora de Redes</h1>
    
    <?php echo form_open('redes/guardar'); ?>
    
    <!-- ID (oculto) -->
    <input type="hidden" name="id" value="<?php echo isset($bitacora['id']) ? $bitacora['id'] : ''; ?>">

    <!-- Fecha -->
    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" value="<?php echo isset($bitacora['fecha']) ? $bitacora['fecha'] : ''; ?>" required><br>

    <!-- Responsable -->
    <label for="responsable">Responsable:</label>
    <input type="text" name="responsable" id="responsable" value="<?php echo isset($bitacora['responsable']) ? $bitacora['responsable'] : ''; ?>" required><br>

    <!-- Políticas evaluadas -->
    <label>Políticas evaluadas:</label><br>
    <?php
    $politicas = json_decode(isset($bitacora['politicas_evaluadas']) ? $bitacora['politicas_evaluadas'] : '[]');
    $politicas_list = ['Monitoreo de red', 'Actualización del firewall', 'Revisar bitácoras del firewall'];
    foreach ($politicas_list as $politica) {
        $checked = in_array($politica, (array)$politicas) ? 'checked' : '';
        echo '<input type="checkbox" name="politicas[]" value="' . $politica . '" id="' . strtolower(str_replace(' ', '_', $politica)) . '" ' . $checked . '>';
        echo '<label for="' . strtolower(str_replace(' ', '_', $politica)) . '">' . $politica . '</label><br>';
    }
    ?>

    <!-- Estado de cumplimiento -->
    <label for="estado_cumplimiento">Estado de Cumplimiento:</label>
    <select name="estado_cumplimiento" id="estado_cumplimiento" required>
        <option value="Completado" <?php echo (isset($bitacora['estado_cumplimiento']) && $bitacora['estado_cumplimiento'] == 'Completado') ? 'selected' : ''; ?>>Completado</option>
        <option value="En progreso" <?php echo (isset($bitacora['estado_cumplimiento']) && $bitacora['estado_cumplimiento'] == 'En progreso') ? 'selected' : ''; ?>>En progreso</option>
        <option value="No Cumplido" <?php echo (isset($bitacora['estado_cumplimiento']) && $bitacora['estado_cumplimiento'] == 'No Cumplido') ? 'selected' : ''; ?>>No Cumplido</option>
    </select><br>

    <!-- Comentarios -->
    <label for="comentarios">Comentarios:</label><br>
    <textarea name="comentarios" id="comentarios" rows="4" cols="50"><?php echo isset($bitacora['comentarios']) ? $bitacora['comentarios'] : ''; ?></textarea><br>

    <button type="submit">Actualizar</button>
    
    <?php echo form_close(); ?>
</body>
</html>
