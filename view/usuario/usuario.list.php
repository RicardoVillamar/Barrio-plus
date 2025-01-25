<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php require_once HEADER; ?>

<div style="padding: 20px;">
    <h1 class="titulos">Perfil</h1>

    <div class="profile-section" style="background-color: #fff; padding: 20px; border-radius: 8px; margin-top: 20px;">
        <?php if (isset($usuario) && is_array($usuario)): ?>
            <h2 class="subtitulos"><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?></h2>
            <p class="texto"><?php echo htmlspecialchars($usuario['correo']); ?></p>
            <p>Datos del usuario</p>
            <button onclick="window.location.href='usuario.edit.php'" class="boton-mediano">Editar información</button>

            <!-- Reservas de Herramientas -->
            <h2 class="subtitulos">Reservas de Herramientas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Herramienta</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuario['reservasHerramientas'])): ?>
                        <?php foreach ($usuario['reservasHerramientas'] as $reserva): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reserva['idHerramientaFK']); ?></td>
                                <td><?php echo htmlspecialchars($reserva['fechaInicio']); ?></td>
                                <td><?php echo htmlspecialchars($reserva['fechaFin']); ?></td>
                                <td><?php echo htmlspecialchars($reserva['cantidad']); ?></td>
                                <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay reservas de herramientas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Reservas de Instalaciones -->
            <h2 class="subtitulos">Reservas de Instalaciones</h2>
            <table>
                <!-- Código similar al de herramientas -->
                <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px;">Instalación</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Fecha Inicio</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Fecha Fin</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Personas Esperadas</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Estado</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($usuario['reservasInstalaciones']) && is_array($usuario['reservasInstalaciones'])) { ?>
                    <?php foreach ($usuario['reservasInstalaciones'] as $reserva) { ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $reserva['idInstalacionFK']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $reserva['fechaInicio']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $reserva['fechaFin']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $reserva['personasEsperadas']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $reserva['estado']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px;">
                                <!-- Acciones como editar o eliminar -->
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" style="border: 1px solid #ddd; padding: 8px;">No hay reservas de instalaciones.</td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
        <?php else: ?>
            <p>Error: Información del usuario no disponible.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once FOOTER; ?>
