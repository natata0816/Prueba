<?php

namespace MainBundle\Entity;

/**
 * Usuarios
 */
class Usuarios
{
 
    /**
     * @var string
     */
    private $pwd;

    /**
     * @var int
     */
    private $activo;

    /**
     * @var int
     */
    private $tipoUsr;

    /**
     * @var string
     */
    private $nomUsr;

    /**
     * @var string
     */
    private $correo;

    /**
     * @var string
     */
    private $actividad;

    /**
     * @var string
     */
    private $rol;



    /**
     * Set pwd
     *
     * @param string $pwd
     *
     * @return Usuarios
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Usuarios
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return int
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set tipoUsr
     *
     * @param integer $tipoUsr
     *
     * @return Usuarios
     */
    public function setTipoUsr($tipoUsr)
    {
        $this->tipoUsr = $tipoUsr;

        return $this;
    }

    /**
     * Get tipoUsr
     *
     * @return int
     */
    public function getTipoUsr()
    {
        return $this->tipoUsr;
    }

    /**
     * Set nomUsr
     *
     * @param string $nomUsr
     *
     * @return Usuarios
     */
    public function setNomUsr($nomUsr)
    {
        $this->nomUsr = $nomUsr;

        return $this;
    }

    /**
     * Get nomUsr
     *
     * @return string
     */
    public function getNomUsr()
    {
        return $this->nomUsr;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Usuarios
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     *
     * @return Usuarios
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set rol
     *
     * @param string $rol
     *
     * @return Usuarios
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }
}

