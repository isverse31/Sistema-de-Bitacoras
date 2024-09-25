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

        .btn-save {
            background-color: #28a745;
        }

        .btn-save:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="radio"] {
            margin-right: 5px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://ketermex.com/img/logoketer.png" alt="Keter">
            <div class="header-right">
                <p><strong>Physical</strong></p>
                <p>Number: PRO-CT PAT-<?php echo $bitacora['fecha']; ?></p>
                <p>Page: 1 of 2</p>
                <p>Date: <?php echo $bitacora['fecha']; ?></p>
            </div>
        </div>

        <!-- Formulario de edición de bitácora -->
        <form action="<?php echo site_url('bitacora/actualizar/' . $bitacora['id']); ?>" method="post">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo $bitacora['fecha']; ?>" required>
            </div>

            <div class="form-group">
                <label>¿El sistema está grabando video?</label>
                <label><input type="radio" name="grabando_video" value="Si" <?php echo $bitacora['grabando_video'] === 'Si' ? 'checked' : ''; ?>> Sí</label>
                <label><input type="radio" name="grabando_video" value="No" <?php echo $bitacora['grabando_video'] === 'No' ? 'checked' : ''; ?>> No</label>
            </div>

            <div class="form-group">
                <label>¿El sistema almacena al menos <input type="number" name="dias_video" value="<?php echo $bitacora['dias_video']; ?>"> días de video?</label>
                <label><input type="radio" name="almacena_dias" value="Si" <?php echo $bitacora['almacena_dias'] === 'Si' ? 'checked' : ''; ?>> Sí</label>
                <label><input type="radio" name="almacena_dias" value="No" <?php echo $bitacora['almacena_dias'] === 'No' ? 'checked' : ''; ?>> No</label>
            </div>

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
    <?php foreach ($bitacora_detalles as $detalle) : ?>
    <tr>
        <td>Cámara <?php echo $detalle['camara_id']; ?></td>
        <td><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][sin_alimentacion]" <?php echo $detalle['sin_alimentacion'] ? 'checked' : ''; ?>></td>
        <td><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][imagen_borrosa]" <?php echo $detalle['imagen_borrosa'] ? 'checked' : ''; ?>></td>
        <td><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][obstruida]" <?php echo $detalle['obstruida'] ? 'checked' : ''; ?>></td>
        <td><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][frente_al_suelo]" <?php echo $detalle['frente_al_suelo'] ? 'checked' : ''; ?>></td>
        <td><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][mala_iluminacion]" <?php echo $detalle['mala_iluminacion'] ? 'checked' : ''; ?>></td>
        <td><input type="text" name="detalles[<?php echo $detalle['id']; ?>][observaciones]" value="<?php echo $detalle['observaciones']; ?>"></td>
    </tr>
<?php endforeach; ?>

</table>


            <div class="form-group">
                <label for="comentario">Comentarios</label>
                <textarea name="comentario" id="comentario" rows="4"><?php echo $bitacora['comentario']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-save">Guardar Cambios</button>
        </form>
    </div>

    <script>
    window.onload = function() {
        history.replaceState(null, null, window.location.href);
    };
</script>
</body>

</html>
