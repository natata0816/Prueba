<?php

namespace MainBundle\Entity;

/**
 * area
 */
class area
{


    /**
     * @var int
     */
    private $isarea;

    /**
     * @var string
     */
    private $nomArea;


    /**
     * Set isarea
     *
     * @param integer $isarea
     *
     * @return area
     */
    public function setIsarea($isarea)
    {
        $this->isarea = $isarea;

        return $this;
    }

    /**
     * Get isarea
     *
     * @return int
     */
    public function getIsarea()
    {
        return $this->isarea;
    }

    /**
     * Set nomArea
     *
     * @param string $nomArea
     *
     * @return area
     */
    public function setNomArea($nomArea)
    {
        $this->nomArea = $nomArea;

        return $this;
    }

    /**
     * Get nomArea
     *
     * @return string
     */
    public function getNomArea()
    {
        return $this->nomArea;
    }
}

