<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cámaras</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: #fff;
            text-transform: uppercase;
        }

        img {
            width: 100px;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .actions a.delete {
            color: #d9534f;
        }
        /* From Uiverse.io by vinodjangid07 */ 
.Btn {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 80px;
  height: 30px;
  border: none;
  padding: 0px 10px;
  background-color: rgb(51, 187, 255);
  color: black;
  font-weight: 500;
  cursor: pointer;
  border-radius: 10px;
  box-shadow: 5px 5px 0px rgb(140, 32, 212);
  transition-duration: .3s;
}

.svg {
  width: 13px;
  position: absolute;
  right: 0;
  margin-right: 20px;
  fill: black;
  transition-duration: .3s;
}

.Btn:hover {
  color: transparent;
}

.Btn:hover svg {
  right: 43%;
  margin: 0;
  padding: 0;
  border: none;
  transition-duration: .3s;
}

.Btn:active {
  transform: translate(3px , 3px);
  transition-duration: .3s;
  box-shadow: 2px 2px 0px rgb(140, 32, 212);
}


/* From Uiverse.io by vinodjangid07 (Eliminar)*/ 
.button {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgb(255, 88, 51);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
  cursor: pointer;
  transition-duration: .3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: .3s;
}

.svgIcon path {
  fill: white;
}

.button:hover {
  width: 80px;
  border-radius: 50px;
  transition-duration: .3s;
  background-color: rgb(255, 69, 69);
  align-items: center;
}

.button:hover .svgIcon {
  width: 25px;
  transition-duration: .3s;
  transform: translateY(60%);
}

.button::before {
  position: absolute;
  top: -20px;
  content: "Eliminar";
  color: white;
  transition-duration: .3s;
  font-size: 2px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  transform: translateY(30px);
  transition-duration: .3s;
}

/* Botón de agregar cámara */

/* From Uiverse.io by andrew-demchenk0 */ 
.buttonC {
    background-color: #004080;
}

.lable {
  line-height: 22px;
  font-size: 17px;
  color: white;
  font-family: sans-serif;
  letter-spacing: 1px;
}

.buttonC:hover {
    background-color: rgb(51, 187, 255);
}

.buttonC:hover .svg-icon {
  animation: flickering 2s linear infinite;

  
}

@keyframes flickering {
  0% {
    opacity: 1;
  }

  50% {
    opacity: 1;
  }

  52% {
    opacity: 1;
  }

  54% {
    opacity: 0;
  }

  56% {
    opacity: 1;
  }

  90% {
    opacity: 1;
  }

  92% {
    opacity: 0;
  }

  94% {
    opacity: 1;
  }

  96% {
    opacity: 0;
  }

  98% {
    opacity: 1;
  }

  99% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}
    </style>
</head>
<body>
    <h2>Lista de Cámaras</h2>
    <button class="buttonC" href="javascript:void(0);" id="btnAbrirModalAgregar">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none" class="svg-icon"><g stroke-width="2" stroke-linecap="round" stroke="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="m4 9c0-1.10457.89543-2 2-2h2l.44721-.89443c.33879-.67757 1.03131-1.10557 1.78889-1.10557h3.5278c.7576 0 1.4501.428 1.7889 1.10557l.4472.89443h2c1.1046 0 2 .89543 2 2v8c0 1.1046-.8954 2-2 2h-12c-1.10457 0-2-.8954-2-2z"></path><path d="m15 13c0 1.6569-1.3431 3-3 3s-3-1.3431-3-3 1.3431-3 3-3 3 1.3431 3 3z"></path></g></svg>
    <span class="lable">Agregar Cámara</span>
    </button>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Resolución</th>
                <th>Departamento</th>
                <th>Observación</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($camaras as $camara): ?>
            <tr>
                <td><?php echo $camara['nombre']; ?></td>
                <td><?php echo $camara['modelo']; ?></td>
                <td><?php echo $camara['marca']; ?></td>
                <td><?php echo $camara['resolucion']; ?></td>
                <td><?php echo $camara['departamento']; ?></td>
                <td><?php echo $camara['observacion']; ?></td>
                <td>
                    <?php if (!empty($camara['imagen'])): ?>
                        <img src="<?php echo base_url('uploads/' . $camara['imagen']); ?>" alt="Imagen de la cámara">
                    <?php endif; ?>
                </td>
                <td class="actions">
                    <button class="Btn" href="javascript:void(0);" id="btnAbrirModalEditar_<?php echo $camara['id']; ?>" onclick="abrirModalEditar(<?php echo $camara['id']; ?>)">Editar
                        <svg class="svg" viewBox="0 0 512 512">
                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg>
                    </button>   <br> 
                    <button class="button" href="<?php echo site_url('camaras/eliminar/'.$camara['id']); ?>" class="delete" onclick="return confirm('¿Estás seguro de que quieres eliminar esta cámara?');">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                    </button>
                    <!-- <a href="javascript:void(0);" id="btnAbrirModalEditar_<?php echo $camara['id']; ?>" onclick="abrirModalEditar(<?php echo $camara['id']; ?>)">Editar</a>
                    <a href="<?php echo site_url('camaras/eliminar/'.$camara['id']); ?>" class="delete" onclick="return confirm('¿Estás seguro de que quieres eliminar esta cámara?');">Eliminar</a>-->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal para agregar cámara -->
<div id="modalAgregarCamara" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal('modalAgregarCamara')">&times;</span>
        <h2>Agregar Nueva Cámara</h2>
        <div class="error-messages">
            <?php echo validation_errors(); ?>
        </div>
        <?php echo form_open_multipart('camaras/guardar'); ?>
        
        <div class="modal-body">
            <div class="modal-column">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" required>

                <label for="marca">Marca:</label>
                <input type="text" name="marca" required>

                <label for="resolucion">Resolución:</label>
                <input type="text" name="resolucion" required>
            </div>
            <div class="modal-column">
                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" required>

                <label for="observacion">Observación:</label>
                <textarea name="observacion"></textarea>

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" accept="image/*">
            </div>
        </div>

        <input type="submit" value="Agregar Cámara">
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Modal para editar cámara -->
<?php foreach ($camaras as $camara): ?>
<div id="modalEditarCamara_<?php echo $camara['id']; ?>" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal('modalEditarCamara_<?php echo $camara['id']; ?>')">&times;</span>
        <h2>Editar Cámara</h2>
        <div class="error-messages">
            <?php echo validation_errors(); ?>
        </div>
        <?php echo form_open_multipart('camaras/editar/'.$camara['id']); ?>

        <div class="modal-body">
            <div class="modal-column">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $camara['nombre']; ?>" required placeholder="Sin nombre">

                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" value="<?php echo $camara['modelo']; ?>" required>

                <label for="marca">Marca:</label>
                <input type="text" name="marca" value="<?php echo $camara['marca']; ?>" required>

                <label for="resolucion">Resolución:</label>
                <input type="text" name="resolucion" value="<?php echo $camara['resolucion']; ?>" required>
            </div>
            <div class="modal-column">
                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" value="<?php echo $camara['departamento']; ?>" required>

                <label for="observacion">Observación:</label>
                <textarea name="observacion"><?php echo $camara['observacion']; ?></textarea>

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen">
                <?php if($camara['imagen']): ?>
                    <img src="<?php echo base_url('uploads/'.$camara['imagen']); ?>" width="100"><br>
                <?php endif; ?>
            </div>
        </div>

        <input type="submit" value="Actualizar Cámara">
        <?php echo form_close(); ?>
    </div>
</div>
<?php endforeach; ?>

<style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.5); 
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 80%; 
        max-width: 600px;
        border-radius: 8px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-body {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .modal-column {
        flex: 1;
    }

    label {
        font-weight: bold;
        margin-top: 10px;
        display: block;
        color: #555;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        color: #333;
        background-color: #f9f9f9;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
        margin-top: 20px;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    .error-messages {
        color: #d9534f;
        margin-bottom: 20px;
    }
</style>

<script>
    var modalAgregar = document.getElementById("modalAgregarCamara");
    var btnAbrirModalAgregar = document.getElementById("btnAbrirModalAgregar");
    var spanCerrarModalAgregar = modalAgregar.getElementsByClassName("close")[0];

    btnAbrirModalAgregar.onclick = function() {
        modalAgregar.style.display = "block";
    }

    spanCerrarModalAgregar.onclick = function() {
        modalAgregar.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalAgregar) {
            modalAgregar.style.display = "none";
        }
    }

    // Funciones para manejar la apertura y cierre del modal de editar
    function abrirModalEditar(id) {
        var modal = document.getElementById("modalEditarCamara_" + id);
        modal.style.display = "block";
    }

    function cerrarModal(id) {
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        var modales = document.getElementsByClassName("modal");
        for (var i = 0; i < modales.length; i++) {
            if (event.target == modales[i]) {
                modales[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>
