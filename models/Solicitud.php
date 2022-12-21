<?php

use database\Connection;

class Solicitud{
    private $id;
    private $folio;
    private $fecha_registro;
    private $tipo_tramite;
    private $monto_solicitado;
    private $plazo_solicitado;
    private $id_usuario;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * @param mixed $folio
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;
    }

    /**
     * @return mixed
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * @param mixed $fecha_registro
     */
    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

    /**
     * @return mixed
     */
    public function getTipoTramite()
    {
        return $this->tipo_tramite;
    }

    /**
     * @param mixed $tipo_tramite
     */
    public function setTipoTramite($tipo_tramite)
    {
        $this->tipo_tramite = $tipo_tramite;
    }

    /**
     * @return mixed
     */
    public function getMontoSolicitado()
    {
        return $this->monto_solicitado;
    }

    /**
     * @param mixed $monto_solicitado
     */
    public function setMontoSolicitado($monto_solicitado)
    {
        $this->monto_solicitado = $monto_solicitado;
    }

    /**
     * @return mixed
     */
    public function getPlazoSolicitado()
    {
        return $this->plazo_solicitado;
    }

    /**
     * @param mixed $plazo_solicitado
     */
    public function setPlazoSolicitado($plazo_solicitado)
    {
        $this->plazo_solicitado = $plazo_solicitado;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function save(){
        $sql = "INSERT INTO solicitudes Values(
                           NULL, '{$this->getFolio()}', '{$this->getFechaRegistro()}', '{$this->getTipoTramite()}', '{$this->getMontoSolicitado()}', 
                           '{$this->getPlazoSolicitado()}', '{$this->getIdUsuario()}')";

        $statement = Connection::getConnection()->prepare($sql);

        $statement->execute();
        $this->setId(Connection::getConnection()->lastInsertId());

        return "Se ha guardado el registro";
    }

    public function updateById($id){
        $sql = "update  solicitudes set tipo_tramite = '{$this->getTipoTramite()}',monto_solicitado = '{$this->getMontoSolicitado()}',
                             plazo_solicitado = '{$this->getPlazoSolicitado()}' where id_usuario = :id";

        $statement = Connection::getConnection()->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return "Se ha actualizado el registro";
    }

    public function getRegisteredApplicants(){
        $sql = 'select s.id_usuario, s.folio, CONCAT(u.nombre, " ", u.apellido) AS nombre_completo, tpt.nombre as tipo_tramite, s.fecha_registro from solicitudes s 
                inner join usuario u on u.id = s.id_usuario
                inner join tipo_tramite tpt on tpt.id = s.tipo_tramite
                order by s.fecha_registro desc';

        $statement = Connection::getConnection()->prepare($sql);

        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getFormByUserId($user_id){
        $sql = 'select s.*, u.*, iu.*, cm.id_cat_estado from solicitudes s 
                inner join usuario u on u.id = s.id_usuario
                inner join ingresos_usuario iu on iu.id_usuario = s.id_usuario
                inner join cat_municipio cm on cm.id = u.id_cat_municipio
                where s.id_usuario = :user_id';

        $statement = Connection::getConnection()->prepare($sql);

        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        return $statement->fetch();
    }
}
