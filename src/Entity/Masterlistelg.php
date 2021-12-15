<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * listelg
 *
 * @ORM\Table(name="masterlistelgs")
 * @ORM\Entity(repositoryClass="App\Repository\MasterlistelgRepository")
 */
class Masterlistelg
{
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
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=512, nullable=true)
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=512, nullable=true)
     */
    private $valeur2;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlvaleur", type="text", nullable=true)
     */
    private $htmlvaleur;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valeur3;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterliste", inversedBy="masterlistelgs")
	*/
	private $masterliste;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContentSection", inversedBy="diffusions")
     **/
    private $contentsection;
    
    

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
     * @return Masterlistelg
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
     * @return Masterlistelg
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
     * Set valeur
     *
     * @param string $valeur
     *
     * @return Masterlistelg
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set valeur2
     *
     * @param string $valeur2
     *
     * @return Masterlistelg
     */
    public function setValeur2($valeur2)
    {
        $this->valeur2 = $valeur2;

        return $this;
    }

    /**
     * Get valeur2
     *
     * @return string
     */
    public function getValeur2()
    {
        return $this->valeur2;
    }


    /**
     * Set htmlvaleur
     *
     * @param string $htmlvaleur
     *
     * @return Masterlistelg
     */
    public function setHtmlvaleur($htmlvaleur)
    {
        $this->htmlvaleur = $htmlvaleur;

        return $this;
    }

    /**
     * Get htmlvaleur
     *
     * @return string
     */
    public function getHtmlvaleur()
    {
        return $this->htmlvaleur;
    }
    /**
     * Set masterliste
     *
     * @param \App\Entity\Masterliste $masterliste
     *
     * @return Masterlistelg
     */
    public function setMasterliste(\App\Entity\Masterliste $masterliste = null)
    {
        $this->masterliste = $masterliste;

        return $this;
    }

    /**
     * Get masterliste
     *
     * @return \App\Entity\Masterliste
     */
    public function getMasterliste()
    {
        return $this->masterliste;
    }
	
	public function getFullDesignation()
	{
		return $this->getCode().' '.$this->getDesignation();
	}

    /**
     * Set valeur3
     *
     * @param boolean $valeur3
     *
     * @return Masterlistelg
     */
    public function setValeur3($valeur3)
    {
        $this->valeur3 = $valeur3;

        return $this;
    }

    /**
     * Get valeur3
     *
     * @return boolean
     */
    public function getValeur3()
    {
        return $this->valeur3;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentsection = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contentsection.
     *
     * @param \App\Entity\ContentSection $contentsection
     *
     * @return Masterlistelg
     */
    public function addContentsection(\App\Entity\ContentSection $contentsection)
    {
        $this->contentsection[] = $contentsection;

        return $this;
    }

    /**
     * Remove contentsection.
     *
     * @param \App\Entity\ContentSection $contentsection
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeContentsection(\App\Entity\ContentSection $contentsection)
    {
        return $this->contentsection->removeElement($contentsection);
    }

    /**
     * Get contentsection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentsection()
    {
        return $this->contentsection;
    }
}
