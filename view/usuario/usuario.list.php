<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php require_once HEADER; ?>

<div style="padding: 20px;">
    <h1 class="titulos">Perfil</h1>

    <div class="profile-section" style="background-color: #fff; padding: 20px; border-radius: 8px; margin-top: 20px;">

        <?php if (isset($usuario) && is_array($usuario)): ?>
            <!-- Información del Usuario -->
            <section style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div>
                    <?php if (!empty($usuario['imagen'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($usuario['imagen']); ?>" alt="Imagen" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                    <?php endif; ?>
                </div>
                <div>
                    <h2 class="subtitulos"><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?></h2>
                </div>
                <p class="texto"><?php echo htmlspecialchars($usuario['correo']); ?></p>
                <div style="display: flex; flex-direction: column; gap: 10px; width: 100%; max-width: 300px;">
                    <button onclick="window.location.href='index.php?c=usuario&f=view_edit'" class="boton-mediano">Editar información</button>
                    <button onclick="window.location.href='index.php?c=usuario&f=logout'" class="boton-mediano">Cerrar sesión</button>
                </div>
                <br>
            </section>

            <!-- Formulario de Búsqueda -->
            <div style="display: flex; flex-direction: column; gap: 20px; width: 100%; padding: 20px; ">
                <?php if (isset($rol) && $rol == '1'): ?>
                    <div style="height: 10px;">
                        <hr>
                    </div>
                    <section style="margin-top: 10px;">
                        <h2 class="subtitulos">Buscar Reservas por Herramienta</h2>
                        <form method="GET" action="index.php">
                            <input type="hidden" name="c" value="usuario">
                            <input type="hidden" name="f" value="buscarReservasPorHerramientas">
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="query" style="width: 100%; padding-left:20px" placeholder="Buscar por nombre de herramienta...">
                                <button type="submit" class="boton-pequenio" style="font-size: 1rem;">Buscar</button>
                            </div>
                        </form>
                    </section>

                    <!-- Resultados de la Búsqueda -->
                    <section>
                        <h2 class=" subtitulos">Resultados de la Búsqueda</h2>
                        <?php if (!empty($resultados)): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre de la Herramienta</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Cantidad</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultados as $reserva): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($reserva['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['fechaInicio']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['fechaFin']); ?></td>

                                            <td><?php echo htmlspecialchars($reserva['cantidad'] ?? ''); ?></td>
                                            <td>
                                                <form method="GET" action="index.php">
                                                    <input type="hidden" name="c" value="usuario">
                                                    <input type="hidden" name="f" value="cancelarReservaHerramienta">
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reserva['IdReservacion'] ?? ''); ?>">
                                                    <button type="submit" class="boton-mediano">Cancelar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No se encontraron reservas.</p>
                        <?php endif; ?>
                    </section>

                    <!-- Reservas de Herramientas -->
                    <section>
                        <h2 class="subtitulos">Reservas de Herramientas</h2>

                        <?php if (isset($reservasHerramientas) && is_array($reservasHerramientas) && !empty($reservasHerramientas)): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre de la Herramienta</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Cantidad</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reservasHerramientas as $reserva): ?>
                                        <?php var_dump($reserva); ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($reserva['Herramienta'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['FechaInicio'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['FechaFin'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['Cantidad'] ?? ''); ?></td>
                                            <td>
                                                <form method="GET" action="index.php">
                                                    <input type="hidden" name="c" value="usuario">
                                                    <input type="hidden" name="f" value="cancelarReservaHerramienta">
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reserva['IdReservacion'] ?? ''); ?>">
                                                    <button type="submit" class="boton-mediano">Cancelar</button>
                                                </form>
                                            </td>



                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No se encontraron reservas.</p>
                        <?php endif; ?>
                    </section>
                    <div style="height: 10px;">
                        <hr>
                    </div>
                    <section style="margin-top: 10px;">
                        <h2 class="subtitulos">Buscar Reservas por Instalaciones</h2>
                        <form method="GET" action="index.php">
                            <input type="hidden" name="c" value="usuario">
                            <input type="hidden" name="f" value="buscarReservasPorInstalaciones">
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="query_instalaciones" style="width: 100%; padding-left:20px" placeholder="Buscar por nombre de instalacion...">
                                <button type="submit" class="boton-pequenio" style="font-size: 1rem;">Buscar</button>
                            </div>
                        </form>
                    </section>

                    <section>
                        <h2 class="subtitulos">Resultados de la Búsqueda</h2>
                        <?php if (!empty($resultadosI)): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre de la Herramienta</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Cantidad</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultadosI as $reservaI): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($reservaI['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($reservaI['fechaInicio']); ?></td>
                                            <td><?php echo htmlspecialchars($reservaI['fechaFin']); ?></td>

                                            <td><?php echo htmlspecialchars($reservaI['personasEsperadas']); ?></td>
                                            <td>
                                                <form method="GET" action="index.php">
                                                    <input type="hidden" name="c" value="usuario">
                                                    <input type="hidden" name="f" value="cancelarReservaInstalaciones">
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reservaI['idReservacion'] ?? ''); ?>">
                                                    <button type="submit" class="boton-mediano">Cancelar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No se encontraron reservas.</p>
                        <?php endif; ?>
                    </section>

                    <!-- Reservas de Instalaciones -->
                    <section>
                        <h2 class="subtitulos">Reservas de Instalaciones</h2>
                        <?php if (isset($reservasInstalaciones) && is_array($reservasInstalaciones) && !empty($reservasInstalaciones)): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Instalación</th>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Fecha Inicio</th>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Fecha Fin</th>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Personas Esperadas</th>
                                        <th style="border: 1px solid #ddd; padding: 8px;">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reservasInstalaciones as $reserva): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($reserva['Instalacion']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['FechaInicio']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['FechaFin']); ?></td>
                                            <td><?php echo htmlspecialchars($reserva['PersonasEsperadas']); ?></td>
                                            <td>
                                                <form method="GET" action="index.php">
                                                    <input type="hidden" name="c" value="usuario">
                                                    <input type="hidden" name="f" value="cancelarReservaInstalaciones">
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reserva['IdReservacion'] ?? ''); ?>">
                                                    <button type="submit" class="boton-mediano">Cancelar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No hay reservas de instalaciones disponibles.</p>
                        <?php endif; ?>
                    </section>
                <?php else: ?>
                    <p style="display: none;">No se encontraron datos del usuario.</p>
                <?php endif; ?>
            </div>
    </div>
</div>
<?php endif; ?>

<?php require_once FOOTER; ?>