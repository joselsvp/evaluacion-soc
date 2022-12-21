<?php
require_once 'models/TipoTramite.php';
require_once 'models/TipoEmpleo.php';
require_once 'models/TipoComprobanteIngreso.php';
require_once 'models/Estado.php';
require_once 'models/Municipio.php';
require_once 'models/Usuario.php';
require_once 'models/IngresosUsuario.php';
require_once 'models/Solicitud.php';

class FormController{

    public function __construct(){
    }

    /**
     * @throws Exception
     */
    public function save(){
        $now = new DateTime();
        $fecha_nacimiento = new DateTime($_POST['fecha_nacimiento']);
        $fecha_inicio_trabajo = new DateTime($_POST['fecha_inicio_trabajo']);
        $is_update = $_POST['is_update'];
        $id_usuario = $_POST['id_usuario'];

        $usuario = new Usuario();
        $usuario->setNombre($_POST['nombre_cliente']);
        $usuario->setApellido($_POST['apellido_cliente']);
        $usuario->setEdad($_POST['edad']);
        $usuario->setCorreo($_POST['correo']);
        $usuario->setFechaNacimiento($fecha_nacimiento->format('Y-m-d'));
        $usuario->setCurp($_POST['curp_cliente']);
        $usuario->setSexo($_POST['genero']);
        $usuario->setCodigoPostal($_POST['cod_postal']);
        $usuario->setCalle($_POST['calle']);
        $usuario->setIdCatMunicipio($_POST['municipio']);
        $usuario->setFechaRegistro($now->format('Y-m-d'));
        $usuario->setFechaActualizacion($now->format('Y-m-d'));
        if($is_update == 1 && $id_usuario > 0){
            $usuario->updateById($id_usuario);
        }else{
            $usuario->save();
        }

        $ingresosUsuario = new IngresosUsuario();

        $ingresosUsuario->setIdUsuario($usuario->getId());
        $ingresosUsuario->setNombreEmpresa($_POST['nombre_empresa']);
        $ingresosUsuario->setTipoComprobanteIngreso($_POST['tipo_comprobante']);
        $ingresosUsuario->setSalarioBrutoMensual($_POST['salario_bruto_mensual']);
        $ingresosUsuario->setSalarioNetoMensual($_POST['salario_neto_mensual']);
        $ingresosUsuario->setTipoEmpleo($_POST['tipo_empleo']);
        $ingresosUsuario->setFechaInicio($fecha_inicio_trabajo->format('Y-m-d'));
        if($is_update == 1 && $id_usuario > 0){
            $ingresosUsuario->updateById($id_usuario);
        }else{
            $ingresosUsuario->save();
        }

        $solicitud = new Solicitud();
        $solicitud->setFolio( uniqid('',true).rand(1,99));
        $solicitud->setFechaRegistro($now->format('Y-m-d H:i:s'));
        $solicitud->setTipoTramite($_POST['tipo_tramite']);
        $solicitud->setMontoSolicitado($_POST['monto']);
        $solicitud->setPlazoSolicitado($_POST['plazo']);
        $solicitud->setIdUsuario($usuario->getId());
        if($is_update == 1 && $id_usuario > 0){
            $solicitud->updateById($id_usuario);
        }else{
            $solicitud->save();
        }
    }

    public function index(){
        $tipo_tramites = (new TipoTramite())->findAll();
        $tipo_empleo = (new TipoEmpleo())->findAll();
        $tipo_comprobante_ingresos = (new TipoComprobanteIngreso())->findAll();
        $estados = (new Estado())->findAll();
        $municipios = (new Municipio())->findAll();

        require_once 'views/FormRegistro.php';
    }

    public function show(){
        $isEdit = true;
        $tipo_tramites = (new TipoTramite())->findAll();
        $tipo_empleo = (new TipoEmpleo())->findAll();
        $tipo_comprobante_ingresos = (new TipoComprobanteIngreso())->findAll();
        $estados = (new Estado())->findAll();
        $municipios = (new Municipio())->findAll();

        if(isset($_GET['id'])){
            $solicitudUsuario = (new Solicitud())->getFormByUserId(base64_decode($_GET['id']));
            if(!empty($solicitudUsuario)){
                require_once 'views/FormRegistro.php';
            }
        }

    }

}
