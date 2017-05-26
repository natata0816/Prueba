<?php

namespace MainBundle\Entity;

/**
 * tipom
 */
class tipom
{
   
    /**
     * @var int
     */
    private $idTipoM;

    /**
     * @var string
     */
    private $nomTipo;

    /**
     * Set idTipoM
     *
     * @param integer $idTipoM
     *
     * @return tipom
     */
    public function setIdTipoM($idTipoM)
    {
        $this->idTipoM = $idTipoM;

        return $this;
    }

    /**
     * Get idTipoM
     *
     * @return int
     */
    public function getIdTipoM()
    {
        return $this->idTipoM;
    }

    /**
     * Set nomTipo
     *
     * @param string $nomTipo
     *
     * @return tipom
     */
    public function setNomTipo($nomTipo)
    {
        $this->nomTipo = $nomTipo;

        return $this;
    }

    /**
     * Get nomTipo
     *
     * @return string
     */
    public function getNomTipo()
    {
        return $this->nomTipo;
    }
}

