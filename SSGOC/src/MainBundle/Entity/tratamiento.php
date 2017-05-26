<?php

namespace MainBundle\Entity;


/**
 * tratamiento
 */
class tratamiento
{

    
    /**
     * @var int
     */
    private $idTrat;

    /**
     * @var string
     */
    private $nomTrat;




    /**
     * Set idTrat
     * @param integer $idTrat
     *
     * @return tratamiento
     */
    public function setIdTrat($idTrat)
    {
        $this->idTrat = $idTrat;

        return $this;
    }

    /**
     * Get idTrat
     *
     * @return int
     */
    public function getIdTrat()
    {
        return $this->idTrat;
    }

    /**
     * Set nomTrat
     *
     * @param string $nomTrat
     *
     * @return tratamiento
     */
    public function setNomTrat($nomTrat)
    {
        $this->nomTrat = $nomTrat;

        return $this;
    }

    /**
     * Get nomTrat
     *
     * @return string
     */
    public function getNomTrat()
    {
        return $this->nomTrat;
    }
}

