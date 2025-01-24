<!-- autor: Quiñonez Castrellón Anthony Joel -->


<div class="container">
    <div>
        <form action="index.php?c=herramientas&f=new" method="POST" name="formHerramienta" id="formHerramienta">
            
            <input type="hidden" name="idHerramienta" id="idHerramienta" value="<?php echo $herramienta['idHerramienta']; ?>" />

            <div class="form-row">
                <!-- Campo Nombre -->
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la herramienta" required>
                </div>

                <!-- Campo Imagen -->
                <div>
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>

                <!-- Campo Descripción -->
                <div class="Descripcion">
                    <label for="descripcion">Descripción:</label><br>
                    <textarea id="descripcion"name="descripcion" placeholder="Descripción de la herramienta" rows="5"
                    ></textarea>
                </div>

                <!-- Campo Precio -->
                <div>
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" placeholder="Precio de la herramienta" required>
                </div>

                <!-- Campo Fecha de Registro -->
                <div>
                    <label for="fechaRegistro">Fecha de Registro</label>
                    <input type="date" name="fechaRegistro" id="fechaRegistro" class="form-control" required>
                </div>

                <!-- Campo Mantenimiento -->
                <div>
                    <input type="checkbox" id="mantenimiento" name="mantenimiento">
                    <label for="mantenimiento">Requiere Mantenimiento</label>
                </div>

                <!-- Campo Cantidad -->
                <div>
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad disponible" required>
                </div>

                <!-- Botones -->
                <div>
                    <button type="submit" class="btn btn-primary" onclick="if (!confirm('¿Está seguro de modificar la herramienta?')) return false;">Guardar</button>
                    <a href="index.php?c=herramientas&f=index" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
