<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Enchainement
 *
 * @ORM\Table(name="enchainement")
 * @ORM\Entity(repositoryClass="App\Repository\EnchainementRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"intitule", "parcours"}, message="Ce enchainement de compétence existe déjà dans ce parcours.")
 */
class Enchainement
{

    /**
     * Constructor
     */
    public function __construct()
    {
        
        $this->enchainementmodules = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
		$this->ordre = 0;
    }

	
	/**
	* @ORM\OneToMany(targetEntity="App\Entity\EnchainementModule", mappedBy="enchainement")
	*/
	private $enchainementmodules;

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
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

        /**
     * @var int
     *
     * @ORM\Column(name="enchainement_ref", type="integer",nullable=true)
     */
    private $enchainementref;
    


    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", cascade={"persist"}, inversedBy="enchainements")
     * @ORM\JoinColumn(name="parcours", nullable=true)
     */
    private $parcours;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;


    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Enchainement
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
     * @return Enchainement
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
     * @return Enchainement
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enchainementref
     *
     * @param integer $enchainementref
     *
     * @return Enchainement
     */
    public function setEnchainementref($enchainementref)
    {
        $this->enchainementref = $enchainementref;

        return $this;
    }

    /**
     * Get enchainementref
     *
     * @return integer
     */
    public function getEnchainementref()
    {
        return $this->enchainementref;
    }


    
    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Enchainement
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Enchainement
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Enchainement
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
     * @return Enchainement
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

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return Enchainement
     */
    public function setParcours(\App\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \App\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

   

    /**
     * Add enchainementmodule
     *
     * @param \App\Entity\Enchainementmodule $enchainementmodule
     *
     * @return Enchainement
     */
    public function addEnchainementmodule(\App\Entity\EnchainementModule $enchainementmodule)
    {
        $this->enchainementmodules[] = $enchainementmodule;
		$enchainementmodule->setEnchainement($this);
        return $this;
    }

    /**
     * Remove enchainementmodule
     *
     * @param \App\Entity\Enchainementmodule $enchainementmodule
     */
    public function removeEnchainementmodule(\App\Entity\EnchainementModule $enchainementmodule)
    {
        $this->enchainementmodules->removeElement($enchainementmodule);
    }

    /**
     * Get enchainementmodules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnchainementmodules()
    {
        return $this->enchainementmodules;
    }
}
