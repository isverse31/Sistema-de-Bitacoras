<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cámara</title>
</head>
<body>
    <h2>Editar Cámara</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('camaras/editar/'.$camara['id']); ?>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $camara['nombre']; ?>" required placeholder="Sin nombre"><br>

        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" value="<?php echo $camara['modelo']; ?>" required><br>

        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="<?php echo $camara['marca']; ?>" required><br>

        <label for="resolucion">Resolución:</label>
        <input type="text" name="resolucion" value="<?php echo $camara['resolucion']; ?>" required><br>

        <label for="departamento">Departamento:</label>
        <input type="text" name="departamento" value="<?php echo $camara['departamento']; ?>" required><br>

        <label for="observacion">Observación:</label>
        <textarea name="observacion"><?php echo $camara['observacion']; ?></textarea><br>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen"><br>
        <?php if($camara['imagen']): ?>
            <img src="<?php echo base_url('uploads/'.$camara['imagen']); ?>" width="100"><br>
        <?php endif; ?>

        <input type="submit" value="Actualizar Cámara">
    <?php echo form_close(); ?>
</body>
</html>