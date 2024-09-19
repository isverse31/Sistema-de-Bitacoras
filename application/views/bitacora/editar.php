<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bitácora CTPAT</title>
    <style>
        /* ... (mantén los estilos que ya tenías) ... */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://ketermex.com/img/logoketer.png" alt="Keter">
            <h1>Editar Bitácora CTPAT</h1>
        </div>

        <?php echo form_open('bitacora/actualizar/' . $bitacora['id']); ?>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $bitacora['fecha']; ?>" required>

            <label>
                <input type="checkbox" name="grabando_video" value="1" <?php echo $bitacora['grabando_video'] ? 'checked' : ''; ?>>
                ¿El sistema está grabando video?
            </label>

            <label for="dias_video">Días de video almacenados:</label>
            <input type="number" id="dias_video" name="dias_video" value="<?php echo $bitacora['dias_video']; ?>" required>

            <label>
                <input type="checkbox" name="almacena_dias" value="1" <?php echo $bitacora['almacena_dias'] ? 'checked' : ''; ?>>
                ¿El sistema almacena los días de video especificados?
            </label>

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
                <?php foreach ($camaras as $index => $camara): ?>
                <tr>
                    <td>Cámara <?php echo $index + 1; ?></td>
                    <td><input type="checkbox" name="camaras[<?php echo $index; ?>][sin_alimentacion]" value="1" <?php echo $camara['sin_alimentacion'] ? 'checked' : ''; ?>></td>
                    <td><input type="checkbox" name="camaras[<?php echo $index; ?>][imagen_borrosa]" value="1" <?php echo $camara['imagen_borrosa'] ? 'checked' : ''; ?>></td>
                    <td><input type="checkbox" name="camaras[<?php echo $index; ?>][obstruida]" value="1" <?php echo $camara['obstruida'] ? 'checked' : ''; ?>></td>
                    <td><input type="checkbox" name="camaras[<?php echo $index; ?>][frente_al_suelo]" value="1" <?php echo $camara['frente_al_suelo'] ? 'checked' : ''; ?>></td>
                    <td><input type="checkbox" name="camaras[<?php echo $index; ?>][mala_iluminacion]" value="1" <?php echo $camara['mala_iluminacion'] ? 'checked' : ''; ?>></td>
                    <td><input type="text" name="camaras[<?php echo $index; ?>][observaciones]" value="<?php echo isset($camara['observaciones']) ? $camara['observaciones'] : ''; ?>"></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <label for="comentario">Comentarios:</label>
            <textarea id="comentario" name="comentario" rows="4"><?php echo $bitacora['comentario']; ?></textarea>

            <button type="submit" class="btn">Guardar Cambios</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>