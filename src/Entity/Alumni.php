<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
/**
 * Alumni
 * 
 * @ORM\Table(name="alumni")
 * @ORM\Entity(repositoryClass="App\Repository\AlumniRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Alumni
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
     * @ORM\OneToOne(targetEntity="App\Entity\Dossier", cascade={"persist"}, inversedBy="alumni")
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
     * @var string
     *
     * @ORM\Column(name="formation", type="string", length=200, nullable=true)
     */
    private $formation; 

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="text", nullable=true)
     */
    private $module; 

    /**
     * @var string
     *
     * @ORM\Column(name="profil", type="string", length=200, nullable=true)
     */
    private $profil; 

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=200, nullable=true)
     */
    private $niveau; 

    /**
     * @var string
     *
     * @ORM\Column(name="situation", type="string", length=200, nullable=true)
     */
    private $situation; 

    /**
     * @var string
     *
     * @ORM\Column(name="provenance", type="string", length=200, nullable=true)
     */
    private $provenance; 

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=200, nullable=true)
     */
    private $categorie; 

    /**
     * @var string
     *
     * @ORM\Column(name="AnneeSortieSystemeScolaireDe", type="string", length=200, nullable=true)
     */
    private $AnneeSortieSystemeScolaireDe; 

    /**
     * @var string
     *
     * @ORM\Column(name="DureeExperienceProfessionnelleDe", type="string", length=200, nullable=true)
     */
    private $DureeExperienceProfessionnelleDe; 

    /**
     * @var string
     *
     * @ORM\Column(name="DateInscriptionPoleEmploi", type="string", length=200, nullable=true)
     */
    private $DateInscriptionPoleEmploi; 

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $InformationComplementaire; 


    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="text", nullable=true)
     */
    private $photo; 


  

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
     * @return Alumni
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
     * @return Alumni
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
     * @return Alumni
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
     * @return Alumni
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
     * @return Alumni
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
     * Set module
     *
     * @param string $module
     *
     * @return Alumni
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }


    /**
     * Set formation
     *
     * @param string $formation
     *
     * @return Alumni
     */
    public function setFormation($formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return string
     */
    public function getFormation()
    {
        return $this->formation;
    }
   
    /**
     * Set profil
     *
     * @param string $profil
     *
     * @return Alumni
     */
    public function setProfil($profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return string
     */
    public function getProfil()
    {
        return $this->profil;
    }
   
    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Alumni
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }


   
    /**
     * Set situation
     *
     * @param string $situation
     *
     * @return Alumni
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get situation
     *
     * @return string
     */
    public function getSituation()
    {
        return $this->situation;
    }


   
    /**
     * Set provenance
     *
     * @param string $provenance
     *
     * @return Alumni
     */
    public function setProvenance($provenance)
    {
        $this->provenance = $provenance;

        return $this;
    }

    /**
     * Get provenance
     *
     * @return string
     */
    public function getProvenance()
    {
        return $this->provenance;
    }


  
   
    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Alumni
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
  
   
    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Alumni
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }



  
   
    /**
     * Set DureeExperienceProfessionnelleDe
     *
     * @param string $DureeExperienceProfessionnelleDe
     *
     * @return Alumni
     */
    public function setDureeExperienceProfessionnelleDe($DureeExperienceProfessionnelleDe)
    {
        $this->DureeExperienceProfessionnelleDe = $DureeExperienceProfessionnelleDe;

        return $this;
    }

    /**
     * Get DureeExperienceProfessionnelleDe
     *
     * @return string
     */
    public function getDureeExperienceProfessionnelleDe()
    {
        return $this->DureeExperienceProfessionnelleDe;
    }

    /**
     * Set AnneeSortieSystemeScolaireDe
     *
     * @param string $AnneeSortieSystemeScolaireDe
     *
     * @return Alumni
     */
    public function setAnneeSortieSystemeScolaireDe($AnneeSortieSystemeScolaireDe)
    {
        $this->AnneeSortieSystemeScolaireDe = $AnneeSortieSystemeScolaireDe;

        return $this;
    }

    /**
     * Get AnneeSortieSystemeScolaireDe
     *
     * @return string
     */
    public function getAnneeSortieSystemeScolaireDe()
    {
        return $this->AnneeSortieSystemeScolaireDe;
    }
 
   
   
    /**
     * Set DateInscriptionPoleEmploi
     *
     * @param string $DateInscriptionPoleEmploi
     *
     * @return Alumni
     */
    public function setDateInscriptionPoleEmploi($DateInscriptionPoleEmploi)
    {
        $this->DateInscriptionPoleEmploi = $DateInscriptionPoleEmploi;

        return $this;
    }

    /**
     * Get DateInscriptionPoleEmploi
     *
     * @return string
     */
    public function getDateInscriptionPoleEmploi()
    {
        return $this->DateInscriptionPoleEmploi;
    }
   
    /**
     * Set InformationComplementaire
     *
     * @param string $InformationComplementaire
     *
     * @return Alumni
     */
    public function setInformationComplementaire($InformationComplementaire)
    {
        $this->InformationComplementaire = $InformationComplementaire;

        return $this;
    }

    /**
     * Get InformationComplementaire
     *
     * @return string
     */
    public function getInformationComplementaire()
    {
        return $this->InformationComplementaire;
    }


   
}
