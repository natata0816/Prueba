<?php

namespace MainBundle\Entity;

/**
 * cliente
 */
class cliente
{
    

    /**
     * @var string
     */
    private $rFCCte;

    /**
     * @var string
     */
    private $codCte;

    /**
     * @var string
     */
    private $nomCte;

    /**
     * @var string
     */
    private $razSoc;

    /**
     * @var string
     */
    private $dirCte;

    /**
     * @var string
     */
    private $telCte;

    /**
     * @var string
     */
    private $codPostCte;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rFCCte
     *
     * @param string $rFCCte
     *
     * @return cliente
     */
    public function setRFCCte($rFCCte)
    {
        $this->rFCCte = $rFCCte;

        return $this;
    }

    /**
     * Get rFCCte
     *
     * @return string
     */
    public function getRFCCte()
    {
        return $this->rFCCte;
    }

    /**
     * Set codCte
     *
     * @param string $codCte
     *
     * @return cliente
     */
    public function setCodCte($codCte)
    {
        $this->codCte = $codCte;

        return $this;
    }

    /**
     * Get codCte
     *
     * @return string
     */
    public function getCodCte()
    {
        return $this->codCte;
    }

    /**
     * Set nomCte
     *
     * @param string $nomCte
     *
     * @return cliente
     */
    public function setNomCte($nomCte)
    {
        $this->nomCte = $nomCte;

        return $this;
    }

    /**
     * Get nomCte
     *
     * @return string
     */
    public function getNomCte()
    {
        return $this->nomCte;
    }

    /**
     * Set razSoc
     *
     * @param string $razSoc
     *
     * @return cliente
     */
    public function setRazSoc($razSoc)
    {
        $this->razSoc = $razSoc;

        return $this;
    }

    /**
     * Get razSoc
     *
     * @return string
     */
    public function getRazSoc()
    {
        return $this->razSoc;
    }

    /**
     * Set dirCte
     *
     * @param string $dirCte
     *
     * @return cliente
     */
    public function setDirCte($dirCte)
    {
        $this->dirCte = $dirCte;

        return $this;
    }

    /**
     * Get dirCte
     *
     * @return string
     */
    public function getDirCte()
    {
        return $this->dirCte;
    }

    /**
     * Set telCte
     *
     * @param string $telCte
     *
     * @return cliente
     */
    public function setTelCte($telCte)
    {
        $this->telCte = $telCte;

        return $this;
    }

    /**
     * Get telCte
     *
     * @return string
     */
    public function getTelCte()
    {
        return $this->telCte;
    }

    /**
     * Set codPostCte
     *
     * @param string $codPostCte
     *
     * @return cliente
     */
    public function setCodPostCte($codPostCte)
    {
        $this->codPostCte = $codPostCte;

        return $this;
    }

    /**
     * Get codPostCte
     *
     * @return string
     */
    public function getCodPostCte()
    {
        return $this->codPostCte;
    }
}

