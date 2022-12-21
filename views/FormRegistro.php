<?php
$getTipoTramites = $tipo_tramites;
$getTipoEmpleo = $tipo_empleo;
$getTipoComprobanteIngresos = $tipo_comprobante_ingresos;
$getEstados = $estados;
$getMunicipios = $municipios;
$datos_usuario = array();
$id_usuario = 0;
$is_update = 0;

if(isset($isEdit)){
    $datos_usuario = $solicitudUsuario;
    $id_usuario = $datos_usuario['id_usuario'];
    $is_update = 1;
    $id_usuario = $datos_usuario['id_usuario'];
}

require_once 'nav.php' ?>
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
                    foreach ($getTipoTramites as $tipo_tramite) {
                        if(isset($datos_usuario['tipo_tramite']) && $datos_usuario['tipo_tramite'] == $tipo_tramite['id']){ ?>
                            <option value="<?= $tipo_tramite['id']; ?>" selected><?= $tipo_tramite['nombre']; ?></option>
                            <?php
                        }else{?>
                            <option value="<?= $tipo_tramite['id']; ?>"><?= $tipo_tramite['nombre']; ?></option>
                            <?php
                        }?>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">¿Cu&aacute;nto monto necesitas?</span>
                <input type="number" id="monto" name="monto-destino" value="<?= isset($datos_usuario['monto_solicitado']) ? $datos_usuario['monto_solicitado'] : '' ?>" placeholder="Ingresa monto a solicitar" required>
            </div>
            <div class="input-box">
                <span class="details">Plazo</span>
                <select id="plazo" name="select_plazo" required>
                    <option value="0" disabled selected>Seleccione plazo</option>
                    <?php
                    for ($i=1; $i<=10; $i++){
                        if(isset($datos_usuario['plazo_solicitado']) && $datos_usuario['plazo_solicitado'] == $i){ ?>
                            <option value="<?=$i?>" selected><?= $i ?> año(s)</option>
                            <?php
                        }else{?>
                            <option value="<?=$i?>"><?= $i ?> año(s)</option>
                            <?php
                        }?>
                    <?php
                    }
                    ?>

                </select>
            </div>
        </div>
    </div>
    <div class="content second-step">
        <div class="inf-details">
            <div class="input-box">
                <span class="details">Nombre(s)</span>
                <input type="text" id="nombre" name="nombre-cliente" value="<?= isset($datos_usuario['nombre']) ? $datos_usuario['nombre'] : '' ?>" placeholder="Ingresa nombre(s)" required>
            </div>
            <div class="input-box">
                <span class="details">Apellido(s)</span>
                <input type="text" id="apellido" name="apellido-cliente" value="<?= isset($datos_usuario['apellido']) ? $datos_usuario['apellido'] : '' ?>" placeholder="Ingresa apellido(s)" required>
            </div>
            <div class="input-box">
                <span class="details">Correo electrónico</span>
                <input type="email" id="correo" name="correo-cliente" value="<?= isset($datos_usuario['correo']) ? $datos_usuario['correo'] : '' ?>" placeholder="Ingresa correo electrónico" required>
            </div>
            <div class="input-box">
                <span class="details">Edad</span>
                <input type="number" id="edad" name="edad-cliente" value="<?= isset($datos_usuario['edad']) ? $datos_usuario['edad'] : '' ?>" placeholder="Ingresa edad" required>
            </div>
            <div class="input-box">
                <span class="details">Fecha de nacimiento</span>
                <input type="date" id="fecha-nacimiento" value="<?= isset($datos_usuario['fecha_nacimiento']) ? $datos_usuario['fecha_nacimiento'] : '' ?>" name="fecha-nacimiento-cliente" required>
            </div>
            <div class="input-box">
                <span class="details">CURP</span>
                <input type="text" id="curp" name="curp-cliente" value="<?= isset($datos_usuario['curp']) ? $datos_usuario['curp'] : '' ?>" placeholder="Ingresa CURP" required>
            </div>
            <div class="input-box">
                <?php
                for($i=1; $i<=2; $i++){
                    if(isset($datos_usuario['sexo']) && $datos_usuario['sexo'] == $i){?>
                        <input type="radio" name="gender" id="dot-<?=$i?>" value="<?=$i?>" checked>
                        <?php
                    }else{ ?>
                        <input type="radio" name="gender" id="dot-<?=$i?>" value="<?=$i?>">
                    <?php
                    } ?>
                <?php
                }
                ?>
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
            <div class="input-box">
                <span class="details">Empresa donde trabajas</span>
                <input type="text" id="empresa_trabajo" name="empresa-trabajo-cliente" value="<?= isset($datos_usuario['nombre_empresa']) ? $datos_usuario['nombre_empresa'] : '' ?>" placeholder="Ingresa el nombre de la empresa" required>
            </div>
            <div class="input-box">
                <span class="details">Fecha que iniciaste a trabajar</span>
                <input type="date" id="fecha_inicio_trabajo" name="fecha-inicio-trabajo-cliente" value="<?= isset($datos_usuario['fecha_inicio']) ? $datos_usuario['fecha_inicio'] : '' ?>" placeholder="Ingresa fecha de inicio de trabajo" required>
            </div>
        </div>
    </div>
    <div class="content three-step">
        <div class="inf-details">
            <div class="input-box">
                <span class="details">Tipo de empleo</span>
                <select id="tipo_empleo" name="select_tipo_empleo" required>
                    <option value="0" disabled selected>Seleccione tipo de empleo</option>
                    <?php
                    foreach ($getTipoEmpleo as $tipo_empleo) {
                        if(isset($datos_usuario['tipo_empleo']) && $datos_usuario['tipo_empleo'] == $tipo_empleo['id']){ ?>
                            <option value="<?= $tipo_empleo['id']; ?>" selected><?= $tipo_empleo['nombre']; ?></option>
                        <?php
                        }else{?>
                            <option value="<?= $tipo_empleo['id']; ?>"><?= $tipo_empleo['nombre']; ?></option>
                        <?php
                        }?>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Tipo de comprobante de ingresos</span>
                <select id="tipo_comprobante" name="select_tipo_comprobante" required>
                    <option value="0" disabled selected>Seleccione tipo de comprobante de ingreso</option>
                    <?php
                    foreach ($getTipoComprobanteIngresos as $comprobanteIngreso) {
                        if(isset($datos_usuario['tipo_comprobante_ingreso']) && $datos_usuario['tipo_comprobante_ingreso'] == $comprobanteIngreso['id']){ ?>
                            <option value="<?= $comprobanteIngreso['id']; ?>" selected><?= $comprobanteIngreso['nombre']; ?></option>
                            <?php
                        }else{?>
                            <option value="<?= $comprobanteIngreso['id']; ?>"><?= $comprobanteIngreso['nombre']; ?></option>
                            <?php
                        }?>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Salario bruto mensual</span>
                <input type="number" id="salario_bruto_mensual" name="salario-bruto-cliente" value="<?= isset($datos_usuario['salario_bruto_mensual']) ? $datos_usuario['salario_bruto_mensual'] : '' ?>" placeholder="Ingresa salario bruta mensual" required>
            </div>
            <div class="input-box">
                <span class="details">Salario neto mensual</span>
                <input type="text" id="salario_neto_mensual" name="salario-neto-cliente" value="<?= isset($datos_usuario['salario_neto_mensual']) ? $datos_usuario['salario_neto_mensual'] : '' ?>" placeholder="Ingresa salario neto mensual" required>
            </div>
            <div class="input-box">
                <span class="details">Código Postal</span>
                <input type="number" id="cod_postal" name="cod-postal-cliente" value="<?= isset($datos_usuario['codigo_postal']) ? $datos_usuario['codigo_postal'] : '' ?>" placeholder="Ingresa código postal" required>
            </div>
            <div class="input-box">
                <span class="details">Estado</span>
                <select id="estado" name="select_estado" required>
                    <option value="0" disabled selected>Seleccione un estado</option>
                    <?php
                    foreach ($getEstados as $estado) {
                        if(isset($datos_usuario['id_cat_estado']) && $datos_usuario['id_cat_estado'] == $estado['id']){ ?>
                            <option value="<?= $estado['id']; ?>" selected><?= $estado['estado_es_mx']; ?></option>
                            <?php
                        }else{?>
                            <option value="<?= $estado['id']; ?>"><?= $estado['estado_es_mx']; ?></option>
                            <?php
                        }?>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Municipio</span>
                <select id="municipio" name="select_municipio" required>
                    <option value="0" disabled selected>Seleccione un municipio</option>
                    <?php
                    foreach ($getMunicipios as $municipio) {
                        if(isset($datos_usuario['id_cat_municipio']) && $datos_usuario['id_cat_municipio'] == $municipio['id']){ ?>
                            <option value="<?= $municipio['id']; ?>" selected><?= $municipio['municipio_es_mx']; ?></option>
                            <?php
                        }else{?>
                            <option value="<?= $municipio['id']; ?>"><?= $municipio['municipio_es_mx']; ?></option>
                            <?php
                        }?>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Calle</span>
                <input type="text" id="calle" name="calle-cliente" value="<?= isset($datos_usuario['calle']) ? $datos_usuario['calle'] : '' ?>" placeholder="Ingresa calle" required>
            </div>
        </div>
        <div class="button">
            <input type="button" class="send_data_form" value="Registrar" id-usuario = '<?= $id_usuario ?>' is-update = '<?= $is_update ?>'>
        </div>
    </div>
</div>

</body>
</html>