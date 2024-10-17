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
            display: block;
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

        input[type="checkbox"] {
            margin-right: 10px;
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

        .politicas label {
            font-weight: normal;
            color: #333;
        }

        .politicas input {
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Registro de Bitácora de Redes</h1>

        <?php echo form_open('redes/guardar'); ?>

        <!-- Fecha -->
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <div class="date-container">
                <input type="date" id="fecha" name="fecha" required>
            </div>
        </div>

        <!-- Responsable -->
        <div class="form-group">
            <label for="responsable">Responsable:</label>
            <div class="responsable">
                <input type="text" name="responsable" id="responsable" placeholder="Nombre del responsable" required>
            </div>
        </div>

        <!-- Políticas evaluadas -->
        <div class="form-group">
            <label><b>Políticas evaluadas:</b></label>
            <div class="politicas">
            <label for="monitoreo">Monitoreo de red</label><br>
                <input type="checkbox" name="politicas[]" value="Monitoreo de red" id="monitoreo">
            <label for="firewall">Actualización del firewall</label><br>
                <input type="checkbox" name="politicas[]" value="Actualización del firewall" id="firewall">
            <label for="bitacoras_firewall">Revisar bitácoras del firewall</label>
                <input type="checkbox" name="politicas[]" value="Revisar bitácoras del firewall" id="bitacoras_firewall">
                
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

        <!-- Comentarios -->
        <div class="form-group">
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" rows="4" placeholder="Añade comentarios adicionales..."></textarea>
        </div>

        <button type="submit">Guardar</button>

        <?php echo form_close(); ?>
    </div>

</body>

</html>
