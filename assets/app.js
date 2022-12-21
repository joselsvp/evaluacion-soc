const send_data = document.querySelector('.send_data_form');

send_data.addEventListener('click', function () {
    let formData = new FormData()
    let id_usuario = document.querySelector(".send_data_form").getAttribute("id-usuario");
    let is_update = document.querySelector(".send_data_form").getAttribute("is-update");

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