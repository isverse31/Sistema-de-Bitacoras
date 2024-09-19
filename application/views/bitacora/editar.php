<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bitácora CTPAT</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #004080;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004080;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #006699;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Bitácora CTPAT</h1>
        <?php echo form_open('bitacora/editar/'.$bitacora[0]['id']); ?>
        
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo $bitacora[0]['fecha']; ?>" required>

        <label for="grabando_video">¿Está grabando video?</label>
        <select name="grabando_video" id="grabando_video" required>
            <option value="1" <?php echo $bitacora[0]['grabando_video'] ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo !$bitacora[0]['grabando_video'] ? 'selected' : ''; ?>>No</option>
        </select>

        <label for="dias_video">Días de video almacenados:</label>
        <input type="number" name="dias_video" id="dias_video" value="<?php echo $bitacora[0]['dias_video']; ?>" required>

        <label for="almacena_dias">¿Almacena días de video?</label>
        <select name="almacena_dias" id="almacena_dias" required>
            <option value="1" <?php echo $bitacora[0]['almacena_dias'] ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo !$bitacora[0]['almacena_dias'] ? 'selected' : ''; ?>>No</option>
        </select>

        

        <h2>Detalles de las Cámaras</h2>
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
            <?php foreach ($bitacora as $index => $detalle): ?>
            <tr>
                <td>Cámara <?php echo $index + 1; ?></td>
                <td><input type="checkbox" name="estado[<?php echo $detalle['camara_id']; ?>][]" value="sin_alimentacion" <?php echo $detalle['sin_alimentacion'] ? 'checked' : ''; ?>></td>
                <td><input type="checkbox" name="estado[<?php echo $detalle['camara_id']; ?>][]" value="imagen_borrosa" <?php echo $detalle['imagen_borrosa'] ? 'checked' : ''; ?>></td>
                <td><input type="checkbox" name="estado[<?php echo $detalle['camara_id']; ?>][]" value="obstruida" <?php echo $detalle['obstruida'] ? 'checked' : ''; ?>></td>
                <td><input type="checkbox" name="estado[<?php echo $detalle['camara_id']; ?>][]" value="frente_al_suelo" <?php echo $detalle['frente_al_suelo'] ? 'checked' : ''; ?>></td>
                <td><input type="checkbox" name="estado[<?php echo $detalle['camara_id']; ?>][]" value="mala_iluminacion" <?php echo $detalle['mala_iluminacion'] ? 'checked' : ''; ?>></td>
                <td><input type="text" name="observaciones[<?php echo $detalle['camara_id']; ?>]" value="<?php echo htmlspecialchars($detalle['observaciones']); ?>"></td>
            </tr>
            <?php endforeach; ?><br>
        </table>


        <label for="comentario">Comentarios:</label>
        <textarea name="comentario" id="comentario" rows="4"><?php echo htmlspecialchars($bitacora[0]['comentario']); ?></textarea>
        <button type="submit" class="btn">Guardar Cambios</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>