window.addEventListener('DOMContentLoaded', (event) => {
    const send_data = document.querySelector('.send_data_form');

    let id_usuario = document.querySelector(".send_data_form").getAttribute("id-usuario");
    let is_update = document.querySelector(".send_data_form").getAttribute("is-update");

    if(!(is_update == 1 && id_usuario > 0)){
        document.querySelector("#dot-1").checked = true;
    }

    send_data.addEventListener('click', function () {
        let formData = new FormData()

        if(vacio("#tipo_tramite", "El campo tipo trámite") || vacio("#monto", "El campo monto") || vacio("#plazo", "El campo plazo") ||
            vacio("#nombre", "El campo nombre(s)") || vacio("#apellido", "El campo apellido(s)") || vacio("#correo", "El campo correo") ||
            vacio("#edad", "El campo edad") || vacio("#fecha-nacimiento", "El campo fecha de nacimiento") || vacio("#curp", "El campo curp") ||
            vacio("#empresa_trabajo", "El campo nombre de empresa") ||
            vacio("#fecha_inicio_trabajo", "El campo fecha de inicio de trabajo") || vacio("#tipo_empleo", "El campo tipo de empleo") || vacio("#tipo_comprobante", "El campo tipo de comprobante") ||
            vacio("#salario_bruto_mensual", "El campo salario bruto mensual") || vacio("#salario_neto_mensual", "El campo salario neto mensual") || vacio("#cod_postal", "El campo código postal") ||
            vacio("#estado", "El campo estado") || vacio("#municipio", "El campo municipio") || vacio("#calle", "El campo calle")){
            return false;
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
            .then((resp) => resp.text())
            .then(function (response) {
                console.log(response);
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
        }
    }

});

