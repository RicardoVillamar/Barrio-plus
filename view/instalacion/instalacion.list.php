<!-- Autor: Villamar Minuche Ricardo Daniel -->

<?php require_once HEADER; ?>
<main id="main">
    <!-- Filtro -->
    <aside class="filtro">
        <h2 class="subtitulos">Filtros</h2>
        <section>
            <p class="texto">Estado</p>
            <select
                id="estado"
                style="width: 90%; height: 25px; border-radius: 4px">
                <option value="todos">Todos</option>
                <option value="ocupado">Ocupado</option>
                <option value="libre">Libre</option>
            </select>
        </section>
        <section>
            <p class="texto">Tamaño</p>
            <ul>
                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="todos" />
                        Todos
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="grande" />
                        Grande
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="mediano" />
                        Mediano
                    </label>
                </li>

                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="pequeño" />
                        Pequeño
                    </label>
                </li>
            </ul>
        </section>
        <section>
            <p class="texto">Tipos</p>
            <ul>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="todos" />
                        Todos
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="aire" />
                        Aire libre
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="aula" />
                        Aula
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="salon" />
                        Salón
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="taller" />
                        Taller
                    </label>
                </li>
            </ul>
        </section>
    </aside>
    <!-- Main -->
    <div class="principal">
        <!-- Cabecera -->
        <section class="cabezera">
            <h2 class="titulo-buscar titulos">Instalaciones</h2>
            <div class="buscar">
                <label for="buscar-barra" class="texto" style="font-weight: bold">Buscar</label>
                <input
                    placeholder="Nombre de la instalación"
                    type="text"
                    id="buscar-barra"
                    style="
                padding: 0 10px;
                padding-right: 30px;
                margin: 10px;
                border-radius: 4px;
                border: 1px solid rgba(0, 0, 0, 0.1);
                height: 30px;
              " />
            </div>
        </section>
        <!-- Tabla -->
        <section
            style="display: flex; justify-content: center; overflow-x: auto">
            <table style="background-color: white; border-radius: 8px">
                <thead style="border-bottom: 1px solid brown">
                    <tr>
                        <th class="tabla-titulos">Estado</th>
                        <th class="tabla-titulos">Instalación</th>
                        <th class="tabla-titulos">Tamaño</th>
                        <th class="tabla-titulos">Tipo</th>
                        <th class="tabla-titulos">Reservar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Instalación 1 -->
                    <tr>
                        <td><span class="disponible"> </span></td>
                        <td class="imagen">
                            <img
                                src="../../assets/img/instalaciones/salon-comunal.png"
                                alt="saloncomunal"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Salon comunal</p>
                        </td>
                        <td>
                            <span class="texto tam-instalacion">Grande</span>
                        </td>
                        <td>
                            <span class="texto">Salon</span>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                    <!-- Instalación 2 -->
                    <tr>
                        <td><span class="no-disponible"> </span></td>
                        <td>
                            <img
                                src="../../assets/img/instalaciones/area-deportiva.png"
                                alt="areadeportiva"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Area deportiva</p>
                        </td>

                        <td>
                            <span class="texto tam-instalacion">Mediano</span>
                        </td>
                        <td>
                            <span class="texto">Aire libre</span>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                    <!-- Instalación 3 -->
                    <tr>
                        <td><span class="no-disponible"> </span></td>
                        <td>
                            <img
                                src="../../assets/img/instalaciones/gimnasio.png"
                                alt="gimnasio"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Gimnasio comunitario</p>
                        </td>

                        <td>
                            <span class="texto tam-instalacion">Pequeño</span>
                        </td>
                        <td>
                            <span class="texto">Taller</span>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                    <!-- Instalación 4 -->
                    <tr>
                        <td><span class="disponible"> </span></td>
                        <td>
                            <img
                                src="../../assets/img/instalaciones/piscina.png"
                                alt="piscina"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Piscina comunitaria</p>
                        </td>
                        <td>
                            <span class="texto tam-instalacion">Pequeño</span>
                        </td>
                        <td>
                            <span class="texto">Aire libre</span>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                    <!-- Instalación 5 -->
                    <tr>
                        <td><span class="no-disponible"> </span></td>
                        <td>
                            <img
                                src="../../assets/img/instalaciones/biblioteca.png"
                                alt="biblioteca"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Biblioteca comunitaria</p>
                        </td>
                        <td>
                            <span class="texto tam-instalacion">Pequeño</span>
                        </td>
                        <td>
                            <span class="texto">Taller</span>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                    <!-- Instalación 6 -->
                    <tr>
                        <td><span class="no-disponible"> </span></td>
                        <td>
                            <img
                                src="../../assets/img/instalaciones/parque-infantil.png"
                                alt="parque"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Parque infantil</p>
                        </td>
                        <td>
                            <span class="texto tam-instalacion">Grande</span>
                        </td>
                        <td>
                            <p class="texto">Aire libre</p>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                    <!-- Instalación 7 -->
                    <tr>
                        <td><span class="disponible"> </span></td>
                        <td>
                            <img
                                src="../../assets/img/instalaciones/sala-recreativa.png"
                                alt="salarecreativa"
                                class="imagen-tabla" />
                            <p class="texto nombre-instalacion">Sala recreativa</p>
                        </td>
                        <td>
                            <span class="texto tam-instalacion">Mediano</span>
                        </td>
                        <td>
                            <span class="texto">Aula</span>
                        </td>
                        <td>
                            <p class="texto">$15.00</p>
                            <button class="boton-mediano reserva">Reservar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</main>
<?php require_once FOOTER; ?>