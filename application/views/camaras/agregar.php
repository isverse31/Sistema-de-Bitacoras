    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Agregar Cámara</title>
    </head>
    <body>
        <h2>Agregar Nueva Cámara</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('camaras/guardar'); ?>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" required><br>

            <label for="marca">Marca:</label>
            <input type="text" name="marca" required><br>

            <label for="resolucion">Resolución:</label>
            <input type="text" name="resolucion" required><br>

            <label for="departamento">Departamento:</label>
            <input type="text" name="departamento" required><br>

            <label for="observacion">Observación:</label>
            <textarea name="observacion"></textarea><br>

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" accept="image/*">

            <input type="submit" value="Agregar Cámara">
        </form>
    </body>
    </html>