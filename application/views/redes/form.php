<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Bitácora de Redes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #004080;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        .custom-checkbox {
            transform: scale(1.5);
            margin-right: 10px;
            cursor: pointer;
            vertical-align: middle;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #006699;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .date-container {
            position: relative;
            display: inline-block;
            width: 30%;
        }

        .responsable{
            display: inline-block;
            width: 40%;
        }
        .cumplimiento {
            display: inline-block;
            width: 20%;
        }

        .politicas {
            display: flex;
            flex-direction: column;
        }

        .politica-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .politica-item label {
            margin-left: 10px;
            font-weight: normal;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Registro de Bitácora de Redes</h1>

        <?php echo form_open('redes/guardar'); ?>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <div class="date-container">
                <input type="date" id="fecha" name="fecha" required>
            </div>
        </div>

        <div class="form-group">
            <label for="responsable">Responsable:</label>
            <div class="responsable">
                <input type="text" name="responsable" id="responsable" placeholder="Nombre del responsable" required>
            </div>
        </div>

        <div class="form-group">
            <label><b>Políticas evaluadas:</b></label>
            <div class="politicas">
                <div class="politica-item">
                    <input type="checkbox" class="custom-checkbox" name="politicas[]" value="Monitoreo de red" id="monitoreo">
                    <label for="monitoreo">Monitoreo de red</label>
                </div>
                <div class="politica-item">
                    <input type="checkbox" class="custom-checkbox" name="politicas[]" value="Actualización del firewall" id="firewall">
                    <label for="firewall">Actualización del firewall</label>
                </div>
                <div class="politica-item">
                    <input type="checkbox" class="custom-checkbox" name="politicas[]" value="Revisar bitácoras del firewall" id="bitacoras_firewall">
                    <label for="bitacoras_firewall">Revisar bitácoras del firewall</label>
                </div>
                <div class="politica-item">
                    <input type="checkbox" class="custom-checkbox" name="politicas[]" value="Mantener actualizada la base de datos de vulnerabilidades en sistemas" id="vulnerabilidades">
                    <label for="vulnerabilidades">Mantener actualizada la base de datos de vulnerabilidades en sistemas</label>
                </div>
                <div class="politica-item">
                    <input type="checkbox" class="custom-checkbox" name="politicas[]" value="Monitoreo de puertos y Analizar el tráfico de red" id="monitoreo_puertos">
                    <label for="monitoreo_puertos">Monitoreo de puertos y Analizar el tráfico de red</label>
                </div>
                <div class="politica-item">
                    <input type="checkbox" class="custom-checkbox" name="politicas[]" value="Monitoreo del uso de sistemas internos y accesos a sitios web externos" id="monitoreo_sistemas">
                    <label for="monitoreo_sistemas">Monitoreo del uso de sistemas internos y accesos a sitios web externos</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="estado_cumplimiento">Estado de Cumplimiento:</label>
            <div class="cumplimiento">
                <select name="estado_cumplimiento" id="estado_cumplimiento" required>
                    <option value="Completado">Completado</option>
                    <option value="En progreso">En progreso</option>
                    <option value="No Cumplido">No Cumplido</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" rows="4" placeholder="Añade comentarios adicionales..."></textarea>
        </div>

        <button type="submit">Guardar</button>

        <?php echo form_close(); ?>
    </div>

    <script>
        // Función para establecer la fecha actual en el campo de fecha
        function setCurrentDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //Enero es 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('fecha').value = today;
        }

        // Llamar a la función cuando se carga la página
        window.onload = setCurrentDate;
    </script>

</body>

</html>