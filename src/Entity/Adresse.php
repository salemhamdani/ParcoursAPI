<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Adresse
 *
 * @ORM\Table(name="adresses")
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Adresse
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->archive = false;
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
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="ligne1", type="string", length=255, nullable=true)
     */
    private $ligne1;

    /**
     * @var string
     *
     * @ORM\Column(name="ligne2", type="string", length=255, nullable=true)
     */
    private $ligne2;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=255, nullable=true)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=20, nullable=true)
     */
    private $pays;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiinsert;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiupdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateinsert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateupdate;

    /**
     * @ORM\PrePersist
     */
    public function ajout()
    {
        $this->dateinsert = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
        $this->dateupdate = new \DateTime();
    }


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Adresse
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set ligne1
     *
     * @param string $ligne1
     *
     * @return Adresse
     */
    public function setLigne1($ligne1)
    {
        $this->ligne1 = $ligne1;

        return $this;
    }

    /**
     * Get ligne1
     *
     * @return string
     */
    public function getLigne1()
    {
        return $this->ligne1;
    }

    /**
     * Set ligne2
     *
     * @param string $ligne2
     *
     * @return Adresse
     */
    public function setLigne2($ligne2)
    {
        $this->ligne2 = $ligne2;

        return $this;
    }

    /**
     * Get ligne2
     *
     * @return string
     */
    public function getLigne2()
    {
        return $this->ligne2;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     *
     * @return Adresse
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Adresse
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Adresse
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Adresse
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Adresse
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Adresse
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert
     *
     * @return \DateTime
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     *
     * @return Adresse
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate
     *
     * @return \DateTime
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }


    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Adresse
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert
     *
     * @return \App\Entity\User
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate
     *
     * @param \App\Entity\User $quiupdate
     *
     * @return Adresse
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate
     *
     * @return \App\Entity\User
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }

/*	
	public function myClone($source)
	{
		$this->titre=$source->getTitre();
		$this->ligne1=$source->getLigne1();
		$this->ligne2=$source->getLigne2();
		$this->codepostal=$source->getCodepostal();
		$this->ville=$source->getVille();
		$this->pays=$source->getPays();
		$this->latitude=$source->getLatitude();
		$this->longitude=$source->getLongitude();
		$this->archive=$source->getArchive();

	}
*/
	public function getFullFormate()
	{
		return $this->titre.'<br/>'.$this->ligne1.'<br/>'.$this->ligne2.'<br/>'.$this->codepostal.' '.$this->ville;
	}

	public function getFullDesignation()
	{
		return $this->titre.' '.$this->ligne1.' '.$this->ligne2.' '.$this->codepostal.' '.$this->ville;
	}
}
