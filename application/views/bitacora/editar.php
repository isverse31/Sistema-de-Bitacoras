<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bitácora CTPAT</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 1.25em;
            height: 1.25em;
            border: 2px solid #4A5568;
            border-radius: 0.25em;
            outline: none;
            transition: all 0.2s ease-in-out;
        }
        .custom-checkbox:checked {
            background-color: #4299E1;
            border-color: #4299E1;
        }
        .custom-checkbox:checked::before {
            content: '\2713';
            display: block;
            text-align: center;
            color: white;
            font-size: 0.8em;
            line-height: 1.25em;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="flex justify-between items-center p-6 bg-blue-600 text-white">
                <img src="https://ketermex.com/img/logoketer.png" alt="Keter" class="w-24">
                <div class="text-right">
                    <p class="font-bold">Physical</p>
                    <p>Number: PRO-CT PAT-<?php echo $bitacora['fecha']; ?></p>
                    <p>Page: 1 of 2</p>
                    <p>Date: <?php echo $bitacora['fecha']; ?></p>
                </div>
            </div>
            
            <form action="<?php echo site_url('bitacora/actualizar/' . $bitacora['id']); ?>" method="post" class="p-6">
                <div class="mb-4">
                    <label for="fecha" class="block text-gray-700 font-bold mb-2">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="<?php echo $bitacora['fecha']; ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <p class="block text-gray-700 font-bold mb-2">¿El sistema está grabando video?</p>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="grabando_video" value="Si" <?php echo $bitacora['grabando_video'] === 'Si' ? 'checked' : ''; ?> class="form-radio text-blue-600">
                            <span class="ml-2">Sí</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="grabando_video" value="No" <?php echo $bitacora['grabando_video'] === 'No' ? 'checked' : ''; ?> class="form-radio text-blue-600">
                            <span class="ml-2">No</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="block text-gray-700 font-bold mb-2">¿El sistema almacena al menos 
                        <input type="number" name="dias_video" value="<?php echo $bitacora['dias_video']; ?>" class="w-16 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 inline"> 
                        días de video?
                    </p>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="almacena_dias" value="Si" <?php echo $bitacora['almacena_dias'] === 'Si' ? 'checked' : ''; ?> class="form-radio text-blue-600">
                            <span class="ml-2">Sí</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="almacena_dias" value="No" <?php echo $bitacora['almacena_dias'] === 'No' ? 'checked' : ''; ?> class="form-radio text-blue-600">
                            <span class="ml-2">No</span>
                        </label>
                    </div>
                </div>

                <div class="overflow-x-auto mb-6">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-4 text-left">Cámara</th>
                                <th class="py-3 px-4 text-center">Sin alimentación</th>
                                <th class="py-3 px-4 text-center">Imagen borrosa</th>
                                <th class="py-3 px-4 text-center">Obstruida</th>
                                <th class="py-3 px-4 text-center">Frente al suelo</th>
                                <th class="py-3 px-4 text-center">Mala iluminación</th>
                                <th class="py-3 px-4 text-left">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <?php foreach ($bitacora_detalles as $detalle) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-4">Cámara <?php echo $detalle['camara_id']; ?></td>
                                <td class="py-3 px-4 text-center"><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][sin_alimentacion]" <?php echo $detalle['sin_alimentacion'] ? 'checked' : ''; ?> class="custom-checkbox"></td>
                                <td class="py-3 px-4 text-center"><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][imagen_borrosa]" <?php echo $detalle['imagen_borrosa'] ? 'checked' : ''; ?> class="custom-checkbox"></td>
                                <td class="py-3 px-4 text-center"><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][obstruida]" <?php echo $detalle['obstruida'] ? 'checked' : ''; ?> class="custom-checkbox"></td>
                                <td class="py-3 px-4 text-center"><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][frente_al_suelo]" <?php echo $detalle['frente_al_suelo'] ? 'checked' : ''; ?> class="custom-checkbox"></td>
                                <td class="py-3 px-4 text-center"><input type="checkbox" name="detalles[<?php echo $detalle['id']; ?>][mala_iluminacion]" <?php echo $detalle['mala_iluminacion'] ? 'checked' : ''; ?> class="custom-checkbox"></td>
                                <td class="py-3 px-4"><input type="text" name="detalles[<?php echo $detalle['id']; ?>][observaciones]" value="<?php echo $detalle['observaciones']; ?>" class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mb-6">
                    <label for="comentario" class="block text-gray-700 font-bold mb-2">Comentarios</label>
                    <textarea name="comentario" id="comentario" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo $bitacora['comentario']; ?></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75 transition">
                        Guardar Cambios
                    </button>
                    <a href="<?php echo site_url('bitacora/detalles/'.$bitacora['id']); ?>" class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    window.onload = function() {
        history.replaceState(null, null, window.location.href);
    };
    </script>
</body>

</html>