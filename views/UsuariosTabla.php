<?php
$users_registed = $getRegisteredApplicants;
require_once 'nav.php';
?>

<div class="container">
    <div class="content-button">
        <a class="button-users" href="/">Nuevo registro +</a>
    </div>
    <div class="title">Solicitudes</div>
    <?php
    if(!empty($users_registed)){?>
        <table id="customers" class="center-content-users">
            <tr>
                <th>Folio</th>
                <th>Nombre</th>
                <th>Destino</th>
                <th>Fecha de registro</th>
                <th>Acción</th>
            </tr>
        <?php
        foreach ($users_registed as $user){ ?>
            <tr>
                <td><?= $user['folio']?></td>
                <td><?= $user['nombre_completo']?></td>
                <td><?= $user['tipo_tramite']?></td>
                <td><?= $user['fecha_registro']?></td>
                <td><a class="button-edit-user" href="<?=base_url?>form/show?id=<?=base64_encode($user['id_usuario'])?>">Editar</a></td>
            </tr>
        <?php
        } ?>
        </table>
        <?php
    }else{ ?>
        <h5 class="center-content-users">Lo sentimos, por el momentos no hay solicitantes registrados</h5>
        <?php
    } ?>
</div>
</body>
</html>