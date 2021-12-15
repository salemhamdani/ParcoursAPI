<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
/**
 * Stagiaire
 * 
 * @ORM\Table(name="stagiaires")
 * @ORM\Entity(repositoryClass="App\Repository\StagiaireRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Stagiaire
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->conventions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\OneToOne(targetEntity="App\Entity\Dossier", cascade={"persist"}, inversedBy="stagiaire")
     */
    private $dossier;

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
     * @var bool
     *
     * @ORM\Column(name="generate", type="boolean", nullable=true)
     */
    private $generate = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="contratsigne", type="boolean", nullable=true)
     */
    private $contratsigne = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean", nullable=true)
     */
    private $valide = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="autorisation", type="boolean", nullable=true)
     */
    private $autorisation = false;

    /**
     * @var string
     *
     * @ORM\Column(name="typeformation", type="string", length=200, nullable=true)
     */
    private $typeformation;  //formation ="Etudiant" ou "Professionnel" 
    /**
     * @var string
     *
     * @ORM\Column(name="classroomstype", type="string", length=200, nullable=true)
     */
    private $classroomstype ;  

    /**
     * @var bool
     *
     * @ORM\Column(name="stateclassrooms", type="boolean", nullable=true)
     */
    private $stateclassrooms = false;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Stagiaire
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;
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
     * @return Stagiaire
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;
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
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Stagiaire
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;
	}

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }
    
   
    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Stagiaire
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
     * @return Stagiaire
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
     * Set typeformation
     *
     * @param string $typeformation
     *
     * @return Stagiaire
     */
    public function setTypeformation($typeformation)
    {
        $this->typeformation = $typeformation;

        return $this;
    }

    /**
     * Get typeformation
     *
     * @return string
     */
    public function getTypeformation()
    {
        return $this->typeformation;
    }

    /**
     * Set classroomstype
     *
     * @param string $classroomstype
     *
     * @return Stagiaire
     */
    public function setClassroomstype($classroomstype)
    {
        $this->classroomstype = $classroomstype;

        return $this;
    }

    /**
     * Get classroomstype
     *
     * @return string
     */
    public function getClassroomstype()
    {
        return $this->classroomstype;
    }

    /**
     * Set stateclassrooms
     *
     * @param boolean $stateclassrooms
     *
     * @return Stagiaire
     */
    public function setStateclassrooms($stateclassrooms)
    {
        $this->stateclassrooms = $stateclassrooms;

        return $this;
    }

    /**
     * Get stateclassrooms
     *
     * @return boolean
     */
    public function getStateclassrooms()
    {
        return $this->stateclassrooms;
    }

    /**
     * Set contratsigne
     *
     * @param boolean $contratsigne
     *
     * @return Stagiaire
     */
    public function setContratsigne($contratsigne)
    {
        $this->contratsigne = $contratsigne;

        return $this;
    }

    /**
     * Get contratsigne
     *
     * @return bool
     */
    public function getContratsigne()
    {
        return $this->contratsigne;
    }


    /**
     * Set generate
     *
     * @param boolean $generate
     *
     * @return Stagiaire
     */
    public function setGenerate($generate)
    {
        $this->generate = $generate;

        return $this;
    }

    /**
     * Get generate
     *
     * @return bool
     */
    public function getGenerate()
    {
        return $this->generate;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Stagiaire
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set autorisation
     *
     * @param boolean $autorisation
     *
     * @return Stagiaire
     */
    public function setAutorisation($autorisation)
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    /**
     * Get autorisation
     *
     * @return bool
     */
    public function getAutorisation()
    {
        return $this->autorisation;
    }


   
     /**
     * Set convention
     *
     * @param \App\Entity\Convention
     * @return Convention
     */
    public function setConvention(\App\Entity\Convention $convention = null)
    {
        $this->convention = $convention;

        return $this;
    }

    /**
     * Get convention
     *
     * @return \App\Entity\Convention
     */
    public function getConvention()
    {
        return $this->convention;
    }


    /**
     * Add convention
     *
     * @param \App\Entity\Convention $convention
     *
     * @return Dossier
     */
    public function addConvention(\App\Entity\Convention $convention)
    {
        $this->conventions[] = $convention;
        $convention->setStagiaire($this);
        return $this;
    }

    /**
     * Remove convention
     *
     * @param \App\Entity\Convention $convention
     */
    public function removeConvention(\App\Entity\Convention $convention)
    {
        $this->conventions->removeElement($convention);
    }

    /**
     * Get conventions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConventions()
    {
        return $this->conventions;
    }

}
