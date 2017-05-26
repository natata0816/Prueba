<?php

namespace MainBundle\Entity;

/**
 * usuario
 */
class usuario
{

    /**
     * @var string
     */
    private $correo;

    /**
     * @var string
     */
    private $nomUsr;

    /**
     * @var string
     */
    private $pwd;

    /**
     * @var int
     */
    private $tipoUsr;

    /**
     * @var int
     */
    private $activo;

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return usuario
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
     * Set nomUsr
     *
     * @param string $nomUsr
     *
     * @return usuario
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
     * Set pwd
     *
     * @param string $pwd
     *
     * @return usuario
     */
    public function setPwd($pwd)
    {
        $this->pwd = md5($pwd);

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
     * Set tipoUsr
     *
     * @param integer $tipoUsr
     *
     * @return usuario
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
     * Set activo
     *
     * @param integer $activo
     *
     * @return usuario
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
}

