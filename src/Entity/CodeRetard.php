<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodeRetard
 *
 * @ORM\Table(name="CodeRetards")
 * @ORM\Entity(repositoryClass="App\Repository\CodeRetardRepository")
 */
class CodeRetard
{

    public function __construct() {
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
    private $tranchemin;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $tranchemax;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur", inversedBy="coderetards")
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
     * @return CodeRetard
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
     * @return CodeRetard
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
     * Set tranchemin
     *
     * @param integer $tranchemin
     *
     * @return CodeRetard
     */
    public function setTranchemin($tranchemin)
    {
        $this->tranchemin = $tranchemin;

        return $this;
    }

    /**
     * Get tranchemin
     *
     * @return integer
     */
    public function getTranchemin()
    {
        return $this->tranchemin;
    }

    /**
     * Set tranchemax
     *
     * @param integer $tranchemax
     *
     * @return CodeRetard
     */
    public function setTranchemax($tranchemax)
    {
        $this->tranchemax = $tranchemax;

        return $this;
    }

    /**
     * Get tranchemax
     *
     * @return integer
     */
    public function getTranchemax()
    {
        return $this->tranchemax;
    }

    /**
     * Set financeur
     *
     * @param \App\Entity\Financeur $financeur
     *
     * @return CodeRetard
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
}
