<?php

use database\Connection;

class IngresosUsuario{
    private $id;
    private $id_usuario;
    private $nombre_empresa;
    private $tipo_comprobante_ingreso;
    private $salario_bruto_mensual;
    private $salario_neto_mensual;
    private $tipo_empleo;
    private $fecha_inicio;

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

    /**
     * @return mixed
     */
    public function getNombreEmpresa()
    {
        return $this->nombre_empresa;
    }

    /**
     * @param mixed $nombre_empresa
     */
    public function setNombreEmpresa($nombre_empresa)
    {
        $this->nombre_empresa = $nombre_empresa;
    }

    /**
     * @return mixed
     */
    public function getTipoComprobanteIngreso()
    {
        return $this->tipo_comprobante_ingreso;
    }

    /**
     * @param mixed $tipo_comprobante_ingreso
     */
    public function setTipoComprobanteIngreso($tipo_comprobante_ingreso)
    {
        $this->tipo_comprobante_ingreso = $tipo_comprobante_ingreso;
    }

    /**
     * @return mixed
     */
    public function getSalarioBrutoMensual()
    {
        return $this->salario_bruto_mensual;
    }

    /**
     * @param mixed $salario_bruto_mensual
     */
    public function setSalarioBrutoMensual($salario_bruto_mensual)
    {
        $this->salario_bruto_mensual = $salario_bruto_mensual;
    }

    /**
     * @return mixed
     */
    public function getSalarioNetoMensual()
    {
        return $this->salario_neto_mensual;
    }

    /**
     * @param mixed $salario_neto_mensual
     */
    public function setSalarioNetoMensual($salario_neto_mensual)
    {
        $this->salario_neto_mensual = $salario_neto_mensual;
    }

    /**
     * @return mixed
     */
    public function getTipoEmpleo()
    {
        return $this->tipo_empleo;
    }

    /**
     * @param mixed $tipo_empleo
     */
    public function setTipoEmpleo($tipo_empleo)
    {
        $this->tipo_empleo = $tipo_empleo;
    }

    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * @param mixed $fecha_inicio
     */
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function save(){

        error_log(print_r($this, true));

        $sql = "INSERT INTO ingresos_usuario Values(
                           NULL, '{$this->getIdUsuario()}', '{$this->getNombreEmpresa()}', '{$this->getTipoComprobanteIngreso()}', '{$this->getSalarioBrutoMensual()}', '{$this->getSalarioNetoMensual()}', 
                           '{$this->getTipoEmpleo()}', '{$this->getFechaInicio()}')";

        $statement = Connection::getConnection()->prepare($sql);

        $statement->execute();
        $this->setId(Connection::getConnection()->lastInsertId());

        return "Se ha guardado el registro";
    }
}
