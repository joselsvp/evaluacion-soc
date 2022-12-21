<?php

use database\Connection;

class TipoTramite{
    private $id;
    private $nombre;

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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function save(){
        $sql = "INSERT INTO categorias Values(NULL, '{$this->getNombre()}', '{$this->getCategoriaHija()}') ";

        $statement = Connection::getConnection()->prepare($sql);

        $statement->execute();
        $this->setId(Connection::getConnection()->lastInsertId());

        return "Se ha guardado la categorias";
    }


    public function findAll(){
        $sql = "select id, nombre from tipo_tramite";

        $statement = Connection::getConnection()->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        $statement->execute();
        return $statement->fetchAll();
    }

}
