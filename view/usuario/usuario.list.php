<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php require_once HEADER; ?>

<div style="padding: 20px;">
    <h1 class="titulos">Perfil</h1>

    <div class="profile-section" style="background-color: #fff; padding: 20px; border-radius: 8px; margin-top: 20px;">
        <?php if (isset($usuario) && is_array($usuario)): ?>
            <!-- Información del Usuario -->
            <section>
                <h2 class="subtitulos"><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?></h2>
                <p class="texto"><?php echo htmlspecialchars($usuario['correo']); ?></p>
                <p>Datos del usuario</p>
                <button onclick="window.location.href='index.php?c=usuario&f=view_edit'" >Editar información</button>
                <button onclick="window.location.href='index.php?c=usuario&f=logout'" >Cerrar sesión</button>
            </section>

            <!-- Reservas de Herramientas -->
            <section>
                <h2 class="subtitulos">Reservas de Herramientas</h2>
                <?php if (isset($reservasHerramientas) && is_array($reservasHerramientas) && !empty($reservasHerramientas)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Herramienta</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservasHerramientas as $reserva): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reserva['Herramienta']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['FechaInicio']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['FechaFin']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['Cantidad']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay reservas de herramientas disponibles.</p>
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
                                <th style="border: 1px solid #ddd; padding: 8px;">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservasInstalaciones as $reserva): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reserva['Instalacion']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['FechaInicio']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['FechaFin']); ?></td>
                                    <td><?php echo htmlspecialchars($reserva['Cantidad']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay reservas de instalaciones disponibles.</p>
                <?php endif; ?>
            </section>
        <?php else: ?>
            <p>No se encontraron datos del usuario.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once FOOTER; ?>
