<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodeAbsence
 *
 * @ORM\Table(name="CodeAbsences")
 * @ORM\Entity(repositoryClass="App\Repository\CodeAbsenceRepository")
 */
class CodeAbsence
{

    public function __construct() {
		$this->ouvre = true;
		$this->continu = true;
		$this->facturable = false;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $nbjours;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $ouvre;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $continu;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $facturable;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur", inversedBy="codeabsences")
	*/
	private $financeur;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return CodeAbsence
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return CodeAbsence
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set ouvre
     *
     * @param boolean $ouvre
     *
     * @return CodeAbsence
     */
    public function setOuvre($ouvre)
    {
        $this->ouvre = $ouvre;

        return $this;
    }

    /**
     * Get ouvre
     *
     * @return boolean
     */
    public function getOuvre()
    {
        return $this->ouvre;
    }

    /**
     * Set continu
     *
     * @param boolean $continu
     *
     * @return CodeAbsence
     */
    public function setContinu($continu)
    {
        $this->continu = $continu;

        return $this;
    }

    /**
     * Get continu
     *
     * @return boolean
     */
    public function getContinu()
    {
        return $this->continu;
    }

    /**
     * Set financeur
     *
     * @param \App\Entity\Financeur $financeur
     *
     * @return CodeAbsence
     */
    public function setFinanceur(\App\Entity\Financeur $financeur = null)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set nbjours
     *
     * @param integer $nbjours
     *
     * @return CodeAbsence
     */
    public function setNbjours($nbjours)
    {
        $this->nbjours = $nbjours;

        return $this;
    }

    /**
     * Get nbjours
     *
     * @return integer
     */
    public function getNbjours()
    {
        return $this->nbjours;
    }

    /**
     * Set facturable
     *
     * @param boolean $facturable
     *
     * @return CodeAbsence
     */
    public function setFacturable($facturable)
    {
        $this->facturable = $facturable;

        return $this;
    }

    /**
     * Get facturable
     *
     * @return boolean
     */
    public function getFacturable()
    {
        return $this->facturable;
    }
}
