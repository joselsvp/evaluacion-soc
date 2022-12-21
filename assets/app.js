window.addEventListener('DOMContentLoaded', (event) => {
    const send_data = document.querySelector('.send_data_form');
    const fecha_nacimiento = document.querySelector('#fecha-nacimiento');

    const CASA = 1;
    const AUTO = 2;
    const PRESTAMO = 3;
    const TARJETA_CREDITO = 4;

    const MONTO_CASA = 200000;
    const MONTO_AUTO = 100000;
    const MONTO_PRESTAMO = 50000;
    const MONTO_TARJETA_CREDITO = 20000;

    const MONTO_CASA_INGRESOS_MIN_NETOS = 50000;
    const MONTO_AUTO_INGRESOS_MIN_NETOS = 30000;
    const MONTO_PRESTAMO_INGRESOS_MIN_NETOS = 20000;
    const MONTO_TARJETA_CREDITO_INGRESOS_MIN_NETOS = 20000;

    let id_usuario = document.querySelector(".send_data_form").getAttribute("id-usuario");
    let is_update = document.querySelector(".send_data_form").getAttribute("is-update");
    let edad = 0;

    if(!(is_update == 1 && id_usuario > 0)){
        document.querySelector("#dot-1").checked = true;
    }

    fecha_nacimiento.addEventListener('change', function (){
        edad = calcularEdad(document.querySelector("#fecha-nacimiento").value);

        document.querySelector("#edad").value = edad;
    });

    send_data.addEventListener('click', function () {
        let formData = new FormData();

        let validarMontoMax = validarMontoMaxPorTipoDestino(parseFloat(document.querySelector("#monto").value) , parseInt(document.querySelector("#tipo_tramite").value));

        if(!validarMontoMax){
            return false;
        }

        let validarCorreo = validarEmail(document.querySelector("#correo").value);

        if(!validarCorreo){
            return false;
        }

        let validarIngresosMinimo = validarIngresos(document.querySelector("#salario_neto_mensual").value ,  parseInt(document.querySelector("#tipo_tramite").value));

        if(!validarIngresosMinimo){
            return false;
        }

        if(vacio("#tipo_tramite", "El campo tipo trámite") || vacio("#monto", "El campo monto") || vacio("#plazo", "El campo plazo") ||
            vacio("#nombre", "El campo nombre(s)") || vacio("#apellido", "El campo apellido(s)") || vacio("#correo", "El campo correo") ||
            vacio("#edad", "El campo edad") || vacio("#fecha-nacimiento", "El campo fecha de nacimiento") || vacio("#curp", "El campo curp") ||
            vacio("#empresa_trabajo", "El campo nombre de empresa") ||
            vacio("#fecha_inicio_trabajo", "El campo fecha de inicio de trabajo") || vacio("#tipo_empleo", "El campo tipo de empleo") || vacio("#tipo_comprobante", "El campo tipo de comprobante") ||
            vacio("#salario_bruto_mensual", "El campo salario bruto mensual") || vacio("#salario_neto_mensual", "El campo salario neto mensual") || vacio("#cod_postal", "El campo código postal") ||
            vacio("#estado", "El campo estado") || vacio("#municipio", "El campo municipio") || vacio("#calle", "El campo calle")){
            return false;
        }


        if(document.querySelector("#edad").value < 18){
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "El solicitantes debe ser mayor de edad",
                showConfirmButton: false,
                timer: 1000
            })
        }

        formData.append("id_usuario", id_usuario);
        formData.append("is_update", is_update);
        formData.append("tipo_tramite", document.querySelector("#tipo_tramite").value);
        formData.append("monto", document.querySelector("#monto").value);
        formData.append("plazo", document.querySelector("#plazo").value);
        formData.append("nombre_cliente", document.querySelector("#nombre").value);
        formData.append("apellido_cliente", document.querySelector("#apellido").value);
        formData.append("correo", document.querySelector("#correo").value);
        formData.append("edad", document.querySelector("#edad").value);
        formData.append("fecha_nacimiento", document.querySelector("#fecha-nacimiento").value);
        formData.append("curp_cliente", document.querySelector("#curp").value);
        formData.append("genero", document.querySelector("input[type='radio'][name=gender]:checked").value);
        //genero

        formData.append("nombre_empresa", document.querySelector("#empresa_trabajo").value);
        formData.append("fecha_inicio_trabajo", document.querySelector("#fecha_inicio_trabajo").value);
        formData.append("tipo_empleo", document.querySelector("#tipo_empleo").value);
        formData.append("tipo_comprobante", document.querySelector("#tipo_comprobante").value);
        formData.append("salario_bruto_mensual", document.querySelector("#salario_bruto_mensual").value);
        formData.append("salario_neto_mensual", document.querySelector("#salario_neto_mensual").value);
        formData.append("cod_postal", document.querySelector("#cod_postal").value);
        formData.append("estado", document.querySelector("#estado").value);
        formData.append("municipio", document.querySelector("#municipio").value);
        formData.append("calle", document.querySelector("#calle").value);


        fetch('/form/save', {
            method: 'POST',
            body: formData,
            processData: false,
            contentType: false,
        })
            .then((resp) => resp.json())
            .then(function (response) {
                var folio = '';
                if (response.folio != ''){
                    folio = "\n con el folio: " + response.folio;
                }
                if(response.type == 'success'){
                    Swal.fire({
                        icon: response.type,
                        title: response.message + folio,
                        showConfirmButton: true,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        console.log(result)
                        if(result.isConfirmed){
                            window.setTimeout(function (){
                                window.location.href = "/usuario/show";
                            },1000)
                        }
                    })
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            })
    });


    function vacio(selector, message){
        if ( (document.querySelector(selector).length == 0) || (document.querySelector(selector).value == "") || (document.querySelector(selector).value == null) || (parseInt(document.querySelector(selector).value) == 0) ) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: message + " es obligatorio",
                showConfirmButton: false,
                timer: 1000
            })
            return false;
        }
    }

    function calcularEdad(fecha) {
        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        return edad;
    }
    function validarMontoMaxPorTipoDestino(monto, destino) {
        switch (destino){
            case CASA:
                if(monto > MONTO_CASA){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El monto máximo a solicitar para el destino CASA es de " + MONTO_CASA,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }else{
                    return true;
                }
            case AUTO:
                if(monto > MONTO_AUTO){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El monto máximo a solicitar para el destino AUTO es de " + MONTO_AUTO,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }else{
                    return true;
                }
            case PRESTAMO:
                if(monto > MONTO_PRESTAMO){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El monto máximo a solicitar para el destino PRÉSTAMO es de " + MONTO_PRESTAMO,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }else{
                    return true;
                }
            case TARJETA_CREDITO:
                if(monto > MONTO_TARJETA_CREDITO){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El monto máximo a solicitar para el destino TARJETA DE CRÉDITO es de " + MONTO_TARJETA_CREDITO,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }
                else{
                    return true;
                }
            default:
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "No se ha identificado el tipo de destino",
                    showConfirmButton: false,
                    timer: 1000
                })
            break;
        }
    }

    function validarIngresos(monto_ingreso, destino) {
        switch (destino){
            case CASA:
                if(monto_ingreso < MONTO_CASA_INGRESOS_MIN_NETOS){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El ingreso neto mínimo requerido es de " + MONTO_CASA_INGRESOS_MIN_NETOS,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }else{
                    return true;
                }
            case AUTO:
                if(monto_ingreso < MONTO_AUTO_INGRESOS_MIN_NETOS){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El ingreso neto mínimo requerido es de " + MONTO_CASA_INGRESOS_MIN_NETOS,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }else{
                    return true;
                }
            case PRESTAMO:
                if(monto_ingreso < MONTO_PRESTAMO_INGRESOS_MIN_NETOS){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El ingreso neto mínimo requerido es de " + MONTO_PRESTAMO_INGRESOS_MIN_NETOS,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }else{
                    return true;
                }
            case TARJETA_CREDITO:
                if(monto_ingreso < MONTO_TARJETA_CREDITO_INGRESOS_MIN_NETOS){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "El ingreso neto mínimo requerido es de " + MONTO_TARJETA_CREDITO_INGRESOS_MIN_NETOS,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    return false;
                }
                else{
                    return true;
                }
            default:
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "No se ha identificado el tipo de destino",
                    showConfirmButton: false,
                    timer: 1000
                })
                break;
        }
    }


    function municipios(id_estado){
        let formDataMunicipios = new FormData();
        formDataMunicipios.append('id_estado', id_estado);

        fetch('/municipio/find', {
            method: 'POST',
            body: formDataMunicipios,
            processData: false,
            contentType: false,
        })
            .then((resp) => resp.json())
            .then(function (response) {
                document.getElementById("municipio").insertAdjacentHTML('beforeend',
                    `<option value = "0" disabled selected>Seleccione un municipio</option>>`
                )
                response.forEach(element =>
                    document.getElementById("municipio").insertAdjacentHTML('beforeend',
                        `<option value = "${element.id_municipio}">${element.nombre_municipio}</option>>`
                    )
                )
            })
    }

    function validarEmail(valor) {
        var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

        if (!validEmail.test(valor)){
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "El correo electrónico no es correcto",
                showConfirmButton: false,
                timer: 1000
            })
            return false;
        }else{
            return true;
        }
    }

    if(!(is_update == 1 && id_usuario > 0)){
        document.getElementById("municipio").options.length = 0;
        document.getElementById("municipio").insertAdjacentHTML('beforeend',
            `<option value = "0" disabled selected>Seleccione un municipio</option>>`
        )
    }


    document.querySelector("#estado").addEventListener('click', function () {
        document.getElementById("municipio").options.length = 0;

        municipios(document.querySelector("#estado").value);
    })

});

