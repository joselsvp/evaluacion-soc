<?php
$getTipoTramites = $tipo_tramites;
$getTipoEmpleo = $tipo_empleo;
$getTipoComprobanteIngresos = $tipo_comprobante_ingresos;
$getEstados = $estados;
$getMunicipios = $municipios;

require_once 'nav.php'
?>

<div class="container">
    <div class="content-button">
        <a class="button-users" href="/usuario/show">Ver solicitudes</a>
    </div>

    <div class="title">Simulador SOC
    </div>
    <div class="content first-step">
        <div class="inf-details">
            <div class="input-box">
                <span class="details">Qué trámite necesitas realizar?</span>
                <select id="tipo_tramite" name="select_tipo_tramite" required>
                    <option value="0" disabled selected>Seleccione tipo de tr&aacute;mite</option>
                    <?php
                    foreach ($getTipoTramites as $tipo_tramite) { ?>
                        <option value="<?= $tipo_tramite['id']; ?>"><?= $tipo_tramite['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">¿Cu&aacute;nto monto necesitas?</span>
                <input type="number" id="monto" name="monto-destino" placeholder="Ingresa monto a solicitar" required>
            </div>
            <div class="input-box">
                <span class="details">Plazo</span>
                <select id="plazo" name="select_plazo" required>
                    <option value="0" disabled selected>Seleccione plazo</option>
                    <option value="1">1 año</option>
                    <option value="2">2 años</option>
                    <option value="3">3 años</option>
                    <option value="4">4 años</option>
                    <option value="5">5 años</option>
                    <option value="6">6 años</option>
                    <option value="7">7 años</option>
                    <option value="8">8 años</option>
                    <option value="9">9 años</option>
                    <option value="10">10 años</option>
                </select>
            </div>
        </div>
    </div>
    <div class="content second-step">
        <div class="inf-details">
            <div class="input-box">
                <span class="details">Nombre(s)</span>
                <input type="text" id="nombre" name="nombre-cliente" placeholder="Ingresa nombre(s)" required>
            </div>
            <div class="input-box">
                <span class="details">Apellido(s)</span>
                <input type="text" id="apellido" name="apellido-cliente" placeholder="Ingresa apellido(s)" required>
            </div>
            <div class="input-box">
                <span class="details">Correo electrónico</span>
                <input type="email" id="correo" name="correo-cliente" placeholder="Ingresa correo electrónico" required>
            </div>
            <div class="input-box">
                <span class="details">Edad</span>
                <input type="number" id="edad" name="edad-cliente" placeholder="Ingresa edad" required>
            </div>
            <div class="input-box">
                <span class="details">Fecha de nacimiento</span>
                <input type="date" id="fecha-nacimiento" name="fecha-nacimiento-cliente" required>
            </div>
            <div class="input-box">
                <span class="details">CURP</span>
                <input type="text" id="curp" name="curp-cliente" placeholder="Ingresa CURP" required>
            </div>
        </div>
        <div class="gender-details">
            <input type="radio" name="gender" id="dot-1">
            <input type="radio" name="gender" id="dot-2">
            <span class="gender-title">Sexo</span>
            <div class="category">
                <label for="dot-1">
                    <span class="dot one"></span>
                    <span class="gender">Hombre</span>
                </label>
                <label for="dot-2">
                    <span class="dot two"></span>
                    <span class="gender">Mujer</span>
                </label>
            </div>
        </div>
    </div>
    <div class="content three-step">
        <div class="inf-details">
            <div class="input-box">
                <span class="details">Empresa donde trabajas</span>
                <input type="text" id="empresa_trabajo" name="empresa-trabajo-cliente" placeholder="Ingresa el nombre de la empresa" required>
            </div>
            <div class="input-box">
                <span class="details">Fecha que iniciaste a trabajar</span>
                <input type="date" id="fecha_inicio_trabajo" name="fecha-inicio-trabajo-cliente" placeholder="Ingresa fecha de inicio de trabajo" required>
            </div>
            <div class="input-box">
                <span class="details">Tipo de empleo</span>
                <select id="tipo_empleo" name="select_tipo_empleo" required>
                    <option value="0" disabled selected>Seleccione tipo de empleo</option>
                    <?php
                    foreach ($getTipoEmpleo as $tipo_empleo) { ?>
                        <option value="<?= $tipo_empleo['id']; ?>"><?= $tipo_empleo['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Tipo de comprobante de ingresos</span>
                <select id="tipo_comprobante" name="select_tipo_comprobante" required>
                    <option value="0" disabled selected>Seleccione tipo de comprobante de ingreso</option>
                    <?php
                    foreach ($getTipoComprobanteIngresos as $comprobanteIngreso) { ?>
                        <option value="<?= $comprobanteIngreso['id']; ?>"><?= $comprobanteIngreso['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Salario bruto mensual</span>
                <input type="number" id="salario_bruto_mensual" name="salario-bruto-cliente" placeholder="Ingresa salario bruta mensual" required>
            </div>
            <div class="input-box">
                <span class="details">Salario neto mensual</span>
                <input type="text" id="salario_neto_mensual" name="salario-neto-cliente" placeholder="Ingresa salario neto mensual" required>
            </div>
            <div class="input-box">
                <span class="details">Código Postal</span>
                <input type="number" id="cod_postal" name="cod-postal-cliente" placeholder="Ingresa código postal" required>
            </div>
            <div class="input-box">
                <span class="details">Estado</span>
                <select id="estado" name="select_estado" required>
                    <option value="0" disabled selected>Seleccione un estado</option>
                    <?php
                    foreach ($getEstados as $estado) { ?>
                        <option value="<?= $estado['id']; ?>"><?= $estado['estado_es_mx']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Municipio</span>
                <select id="municipio" name="select_municipio" required>
                    <option value="0" disabled selected>Seleccione un municipio</option>
                    <?php
                    foreach ($getMunicipios as $municipio) { ?>
                        <option value="<?= $municipio['id']; ?>"><?= $municipio['municipio_es_mx']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Calle</span>
                <input type="text" id="calle" name="calle-cliente" placeholder="Ingresa calle" required>
            </div>
        </div>
        <div class="button">
            <input type="button" class="send_data_form" value="Registrar">
        </div>
    </div>
</div>

</body>
</html>