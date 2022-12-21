<?php

use database\Connection;

class Usuario{
    private $id;
    private $nombre;
    private $apellido;
    private $edad;
    private $fecha_nacimiento;
    private $curp;
    private $sexo;
    private $correo;
    private $codigo_postal;
    private $calle;
    private $id_cat_municipio;
    private $fecha_registro;
    private $fecha_actualizacion;


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

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param mixed $fecha_nacimiento
     */
    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * @return mixed
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * @param mixed $curp
     */
    public function setCurp($curp)
    {
        $this->curp = $curp;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getCodigoPostal()
    {
        return $this->codigo_postal;
    }

    /**
     * @param mixed $codigo_postal
     */
    public function setCodigoPostal($codigo_postal)
    {
        $this->codigo_postal = $codigo_postal;
    }

    /**
     * @return mixed
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * @return mixed
     */
    public function getIdCatMunicipio()
    {
        return $this->id_cat_municipio;
    }

    /**
     * @param mixed $id_cat_municipio
     */
    public function setIdCatMunicipio($id_cat_municipio)
    {
        $this->id_cat_municipio = $id_cat_municipio;
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
    public function getFechaActualizacion()
    {
        return $this->fecha_actualizacion;
    }

    /**
     * @param mixed $fecha_actualizacion
     */
    public function setFechaActualizacion($fecha_actualizacion)
    {
        $this->fecha_actualizacion = $fecha_actualizacion;
    }

    public function save(){
        $sql = "INSERT INTO usuario Values(
                           NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEdad()}', '{$this->getFechaNacimiento()}', 
                           '{$this->getCurp()}', '{$this->getSexo()}', '{$this->getCorreo()}','{$this->getCodigoPostal()}', '{$this->getCalle()}', 
                           '{$this->getIdCatMunicipio()}', '{$this->getFechaRegistro()}', '{$this->getFechaActualizacion()}')";

        $statement = Connection::getConnection()->prepare($sql);

        $statement->execute();
        $this->setId(Connection::getConnection()->lastInsertId());

        return "Se ha guardado el usuario";
    }

    public function updateById($id){
        $sql = "update  usuario set nombre = '{$this->getNombre()}',apellido = '{$this->getApellido()}',
                             edad = '{$this->getEdad()}',fecha_nacimiento = '{$this->getFechaNacimiento()}',
                             curp = '{$this->getCurp()}',sexo = '{$this->getSexo()}',correo = '{$this->getCorreo()}',sexo = '{$this->getSexo()}',
                             codigo_postal = '{$this->getCodigoPostal()}',calle = '{$this->getCalle()}',id_cat_municipio = '{$this->getIdCatMunicipio()}',
                             fecha_actualizacion = '{$this->getFechaActualizacion()}'where id = :id";

        $statement = Connection::getConnection()->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return "Se ha actualizado el registro";
    }
}
