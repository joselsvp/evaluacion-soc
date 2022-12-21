<?php

use database\Connection;

class Estado{
    private $id;
    private $estado_es_mx;

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
    public function getEstadoEsMx()
    {
        return $this->estado_es_mx;
    }

    /**
     * @param mixed $estado_es_mx
     */
    public function setEstadoEsMx($estado_es_mx)
    {
        $this->estado_es_mx = $estado_es_mx;
    }

    public function findAll(){
        $sql = "select id, estado_es_mx from cat_estado";

        $statement = Connection::getConnection()->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        $statement->execute();
        return $statement->fetchAll();
    }

}
