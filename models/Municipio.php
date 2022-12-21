<?php

use database\Connection;

class Municipio{
    private $id;
    private $municipio_es_mx;

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
    public function getMunicipioEsMx()
    {
        return $this->municipio_es_mx;
    }

    /**
     * @param mixed $municipio_es_mx
     */
    public function setMunicipioEsMx($municipio_es_mx)
    {
        $this->municipio_es_mx = $municipio_es_mx;
    }

    public function findAll(){
        $sql = "select id, municipio_es_mx from cat_municipio";

        $statement = Connection::getConnection()->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        $statement->execute();
        return $statement->fetchAll();
    }

    public function findMunicipiosByIdEstado($id_estado){
        $sql = "select id as id_municipio, municipio_es_mx as nombre_municipio from cat_municipio  
                where id_cat_estado = :id_estado";

        $statement = Connection::getConnection()->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $statement->bindParam("id_estado", $id_estado);

        $statement->execute();
        return $statement->fetchAll();
    }

}
