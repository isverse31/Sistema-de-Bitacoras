<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácora CTPAT - KETER</title>
    <style>
        :root {
            --primary-color: #004080;
            --secondary-color: #006699;
            --background-color: #f4f4f4;
            --text-color: #333;
            --border-color: #ddd;
            --hover-color: #e6f3ff;
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
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1, h2 {
            text-align: center;
            color: var(--primary-color);
        }

        h1 {
            margin-bottom: 10px;
        }

        h2 {
            color: var(--secondary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group .fecha{
            width: 20%;
        }

        .form-group .dias{
            width: 7%;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: var(--primary-color);
        }


        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="radio"] {
            margin-right: 10px;
            cursor: pointer;
        }

        .radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .radio-group label {
            margin-right: 20px;
            font-weight: normal;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid var(--border-color);
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: var(--hover-color);
        }

        .checkbox-cell {
            text-align: center;
        }

        textarea {
            height: 60px;
            resize: vertical;
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
                border: 1px solid var(--border-color);
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: left;
            }

            td:before {
                position: absolute;
                top: 12px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                font-weight: bold;
                color: var(--primary-color);
            }

            .checkbox-cell {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>KETER</h1>
        <h2>Bitácora CTPAT</h2>

        <?php echo form_open('bitacora/guardar', ['id' => 'bitacoraForm']); ?>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required class="fecha">
            </div>

            <div class="form-group">
                <label>¿El sistema está grabando video?</label>
                <div class="radio-group">
                    <label><input type="radio" name="grabando_video" value="Si" required> Sí</label>
                    <label><input type="radio" name="grabando_video" value="No"> No</label>
                </div>
            </div>

            <div class="form-group">
            <label for="dias_video">¿El sistema almacena al menos cuántos días de video?</label>
            <input type="number" id="dias_video" name="dias_video" min="0" required class="dias">
        </div>

            <div class="form-group">
                <label>¿Almacena los días indicados?</label>
                <div class="radio-group">
                    <label><input type="radio" name="almacena_dias" value="Si" required> Sí</label>
                    <label><input type="radio" name="almacena_dias" value="No"> No</label>
                </div>
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
                        <td data-label="Cámara"><?php echo $camara['nombre']; ?></td>
                        <td data-label="Sin alimentación" class="checkbox-cell">
                            <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][sin_alimentacion]" value="1">
                        </td>
                        <td data-label="Imagen borrosa" class="checkbox-cell">
                            <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][imagen_borrosa]" value="1">
                        </td>
                        <td data-label="Obstruida" class="checkbox-cell">
                            <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][obstruida]" value="1">
                        </td>
                        <td data-label="Frente al suelo" class="checkbox-cell">
                            <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][frente_al_suelo]" value="1">
                        </td>
                        <td data-label="Mala iluminación" class="checkbox-cell">
                            <input type="checkbox" name="estado[<?php echo $camara['id']; ?>][mala_iluminacion]" value="1">
                        </td>
                        <td data-label="Observaciones">
                            <textarea name="observaciones[<?php echo $camara['id']; ?>]" placeholder="Observaciones..."></textarea>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="form-group">
                <label for="comentario">Comentarios generales:</label>
                <textarea name="comentario" id="comentario" placeholder="Escribe los comentarios de la bitácora..."></textarea>
            </div>

            <button type="submit">Guardar bitácora</button>
        <?php echo form_close(); ?>
    </div>

    <script>
    document.getElementById('bitacoraForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = checkbox.name;
                hiddenInput.value = '0';
                checkbox.parentNode.insertBefore(hiddenInput, checkbox);
            }
        });
        this.submit();
    });
    </script>

<script>
        function setCurrentDateAndDays() {
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();

            let formattedDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById('fecha').value = formattedDate;

            // Calcular el número de días en el mes actual
            let daysInMonth = new Date(yyyy, today.getMonth() + 1, 0).getDate();
            
            // pone los días del mes
            document.getElementById('dias_video').value = daysInMonth;

            console.log("Días en el mes actual: " + daysInMonth);
        }
        window.onload = setCurrentDateAndDays;
    </script>
</body>
</html>