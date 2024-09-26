<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bitácora CTPAT</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
        color: #333;
    }

    h1,
    h2 {
        text-align: center;
        color: #004080;
        margin-bottom: 20px;
    }

    h2 {
        color: #006699;
        border-bottom: 2px solid #006699;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #004080;
        color: #fff;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #004080;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        box-sizing: border-box;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #006699;
    }

    textarea {
        height: 50px;
        resize: vertical;
    }

    .date-container {
        position: relative;
        display: inline-block;
        width: 200px;
    }

    .date-container input[type="date"] {
        width: 100%;
        padding-right: 40px;
    }

    .date-container img {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        pointer-events: none;
    }
    </style>
</head>

<body>
    <h1>KETER</h1>
    <h2>Bitácora CTPAT</h2>

    <?php echo form_open('bitacora/guardar', ['id' => 'bitacoraForm']); ?>
    <div class="form-group">
        <label for="fecha">Fecha:</label>
        <div class="date-container">
            <input type="date" id="fecha" name="fecha" required>
        </div>
    </div>

    <div class="form-group">
        <label>¿El sistema está grabando video?</label>
        <label><input type="radio" name="grabando_video" value="Si" required> Sí</label>
        <label><input type="radio" name="grabando_video" value="No"> No</label>
    </div>

    <div class="form-group">
        <label>¿El sistema almacena al menos
            <input type="number" name="dias_video" style="width: 80px;" min="0"> días de video?</label>
        <label><input type="radio" name="almacena_dias" value="Si" required> Sí</label>
        <label><input type="radio" name="almacena_dias" value="No"> No</label>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cámara</th>
                <th>Sin alimentación</th>
                <th>Imagen borrosa</th>
                <th>Obstruida</th>
                <th>Frente al suelo</th>
                <th>Mala iluminación</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($camaras as $camara): ?>
            <tr>
                <td><?php echo $camara['nombre'] ; ?></td>
                <td>
                    <input type="hidden" name="estado[<?php echo $camara['id']; ?>][sin_alimentacion]" value="0">
                    <!-- valor por defecto -->
                    <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][sin_alimentacion]" value="1">
                </td>
                <td>
                    <input type="hidden" name="estado[<?php echo $camara['id']; ?>][imagen_borrosa]" value="0">
                    <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][imagen_borrosa]" value="1">
                </td>
                <td>
                    <input type="hidden" name="estado[<?php echo $camara['id']; ?>][obstruida]" value="0">
                    <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][obstruida]" value="1">
                </td>
                <td>
                    <input type="hidden" name="estado[<?php echo $camara['id']; ?>][frente_al_suelo]" value="0">
                    <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][frente_al_suelo]" value="1">
                </td>
                <td>
                    <input type="hidden" name="estado[<?php echo $camara['id']; ?>][mala_iluminacion]" value="0">
                    <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][mala_iluminacion]" value="1">
                </td>
                <td><textarea name="observaciones[<?php echo $camara['id']; ?>]"
                        placeholder="Observaciones..."></textarea></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="form-group">
        <label for="comentario">Comentarios generales:</label>
        <textarea name="comentario" id="comentario" placeholder="Escribe los comentarios de la bitácora..."></textarea>
    </div>

    <input type="submit" value="Guardar bitácora">
    <?php echo form_close(); ?>

    <script>
    document.getElementById('bitacoraForm').addEventListener('submit', function() {
        // Este script se asegura de que los checkboxes no seleccionados también se envíen
        let checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                checkbox.checked = true;
                checkbox.value = 0; // Forzar a enviar el valor 0 si no está marcado
            }
        });
    });
    </script>
</body>

</html>