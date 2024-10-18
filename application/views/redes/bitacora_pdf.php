<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        h1 {
            color: #004080;
            text-align: center;
            font-size: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: #fff;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Bitácora de Redes</h1>

    <p><strong>Fecha:</strong> <?php echo $bitacora['fecha']; ?></p>
    <p><strong>Responsable:</strong> <?php echo $bitacora['responsable']; ?></p>

    <p class="section-title">Políticas Evaluadas:</p>
    <ul>
        <?php foreach (json_decode($bitacora['politicas'], true) as $politica): ?>
            <li><?php echo $politica; ?></li>
        <?php endforeach; ?>
    </ul>

    <p><strong>Estado de Cumplimiento:</strong> <?php echo $bitacora['estado_cumplimiento']; ?></p>

    <p class="section-title">Comentarios:</p>
    <p><?php echo $bitacora['comentarios']; ?></p><br>

    <p><strong>Revisado por:</strong></p>
    <p>Nombre: ________________________________________</p>
    <p>Cargo: _________________________________________</p>
    <p>Firma: _________________________________________</p>
</body>
</html>
