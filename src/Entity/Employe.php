<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Employe
 * 
 * @ORM\Table(name="employes")
 * @ORM\Entity(repositoryClass="App\Repository\EmployeRepository")
 */
class Employe extends User
{

    private $fullName;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->referentparcours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referentpedagogiques = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referentcoachs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referentcommercials = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referentadministratifs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->profils = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dossierreorienters = new \Doctrine\Common\Collections\ArrayCollection();

        $this->espaceformation=false;
        $this->espaceadmin=false;
        $this->espacequizz=false;
        $this->espaceactualites=false;
        $this->espacebodoranco=false;
        $this->espacebomycommunity=false;
        $this->espaceboclassrooms=false;
        $this->espaceclassrooms=false;
		$this->droitsniv2=false;
	}

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Profil", mappedBy="contactDevis" )
     */
    private $profils;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Adresse",  cascade={"persist"})
	*/
	private $adresse;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",  cascade={"persist"})
	*/
	private $personalinformations;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Parcours", mappedBy="referent")
     */
    private $referentparcours;
 
    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\EmployeIpAutorisee", mappedBy="employe",  cascade={"persist","remove"})
     */
    private $ipsautorisees;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $qualite;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
     */
    private $portails;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="referentpedagogique")
     */
    private $referentpedagogiques;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="referentcoach")
     */
    private $referentcoachs;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="reorienter")
     */
    private $dossierreorienters;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="responsable")
     */
    private $evenements;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="referentcommercial")
     */
    private $referentcommercials;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="referentadministratif")
     */
    private $referentadministratifs;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espaceformation;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espaceadmin;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espacequizz;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espaceactualites;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espacebodoranco;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espacebomycommunity;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espaceboclassrooms;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $espaceclassrooms;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $droitsniv2;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rgbd;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datergbd", type="datetime", nullable=true)
     */
    private $datergbd;

    /**
     * Add referentparcour
     *
     * @param \App\Entity\Parcours $referentparcour
     *
     * @return Employe
     */
    public function addReferentparcour(\App\Entity\Parcours $referentparcour)
    {
        $this->referentparcours[] = $referentparcour;
		$referentparcour->setReferant($this);
        return $this;
    }

    /**
     * Remove referentparcour
     *
     * @param \App\Entity\Parcours $referentparcour
     */
    public function removeReferentparcour(\App\Entity\Parcours $referentparcour)
    {
        $this->referentparcours->removeElement($referentparcour);
    }

    /**
     * Get referentparcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentparcours()
    {
        return $this->referentparcours;
    }

    /**
     * Add referentpedagogique
     *
     * @param \App\Entity\Dossier $referentpedagogique
     *
     * @return Employe
     */
    public function addReferentpedagogique(\App\Entity\Dossier $referentpedagogique)
    {
        $this->referentpedagogiques[] = $referentpedagogique;
		$referentpedagogique->setReferantpedagogique($this);
        return $this;
    }

    /**
     * Remove referentpedagogique
     *
     * @param \App\Entity\Dossier $referentpedagogique
     */
    public function removeReferentpedagogique(\App\Entity\Dossier $referentpedagogique)
    {
        $this->referentpedagogiques->removeElement($referentpedagogique);
    }

    /**
     * Get referentpedagogiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentpedagogiques()
    {
        return $this->referentpedagogiques;
    }

    /**
     * Add referentcoach
     *
     * @param \App\Entity\Dossier $referentcoach
     *
     * @return Employe
     */
    public function addReferentcoach(\App\Entity\Dossier $referentcoach)
    {
        $this->referentcoachs[] = $referentcoach;
        $referentcoach->setReferentcoach($this);
        return $this;
    }

    /**
     * Remove referentcoach
     *
     * @param \App\Entity\Dossier $referentcoach
     */
    public function removeReferentcoach(\App\Entity\Dossier $referentcoach)
    {
        $this->referentcoachs->removeElement($referentcoach);
    }

    /**
     * Get referentcoachs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentcoachs()
    {
        return $this->referentcoachs;
    }


    /**
     * Add dossierreorienter
     *
     * @param \App\Entity\Dossier $dossierreorienter
     *
     * @return Employe
     */
    public function addDossierreorienter(\App\Entity\Dossier $dossierreorienter)
    {
        $this->dossierreorienters[] = $dossierreorienter;
        $dossierreorienter->setDossierreorienter($this);
        return $this;
    }

    /**
     * Remove dossierreorienter
     *
     * @param \App\Entity\Dossier $dossierreorienter
     */
    public function removeDossierreorienter(\App\Entity\Dossier $dossierreorienter)
    {
        $this->dossierreorienters->removeElement($dossierreorienter);
    }

    /**
     * Get dossierreorienters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossierreorienters()
    {
        return $this->dossierreorienters;
    }

    /**
     * Add referentcommercial
     *
     * @param \App\Entity\Dossier $referentcommercial
     *
     * @return Employe
     */
    public function addReferentcommercial(\App\Entity\Dossier $referentcommercial)
    {
        $this->referentcommercials[] = $referentcommercial;
		$referentcommercial->setReferantcommercial($this);
        return $this;
    }

    /**
     * Remove referentcommercial
     *
     * @param \App\Entity\Dossier $referentcommercial
     */
    public function removeReferentcommercial(\App\Entity\Dossier $referentcommercial)
    {
        $this->referentcommercials->removeElement($referentcommercial);
    }

    /**
     * Get referentcommercials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentcommercials()
    {
        return $this->referentcommercials;
    }

    /**
     * Add referentadministratif
     *
     * @param \App\Entity\Dossier $referentadministratif
     *
     * @return Employe
     */
    public function addReferentadministratif(\App\Entity\Dossier $referentadministratif)
    {
        $this->referentadministratifs[] = $referentadministratif;
		$referentadministratif->setReferantadministratif($this);
        return $this;
    }

    /**
     * Remove referentadministratif
     *
     * @param \App\Entity\Dossier $referentadministratif
     */
    public function removeReferentadministratif(\App\Entity\Dossier $referentadministratif)
    {
        $this->referentadministratifs->removeElement($referentadministratif);
    }

    /**
     * Get referentadministratifs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentadministratifs()
    {
        return $this->referentadministratifs;
    }



      /**
     * Set qualite
     *
     * @param \App\Entity\Masterlistelg $qualite
     *
     * @return Employe
     */
    public function setQualite(\App\Entity\Masterlistelg $qualite = null)
    {
        $this->qualite = $qualite;

        return $this;
    }

    /**
     * Get qualite
     *
     * @return \App\Entity\Masterlistelg
     */
    
    public function getQualite()
    {
        return $this->qualite;
    }

    /**
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return Employe
     */
    public function setAdresse(\App\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Employe
     */
    public function setPersonalinformations(\App\Entity\PersonalInformations $personalinformations = null)
    {
        $this->personalinformations = $personalinformations;

        return $this;
    }

    /**
     * Get personalinformations
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getPersonalinformations()
    {
        return $this->personalinformations;
    }

    /**
     * Add profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return Employe
     */
    public function addProfil(\App\Entity\Profil $profil)
    {
        $this->profils[] = $profil;
		$profil->setContactDevis($this);
        return $this;
    }

    /**
     * Remove profil
     *
     * @param \App\Entity\Profil $profil
     */
    public function removeProfil(\App\Entity\Profil $profil)
    {
        $this->profils->removeElement($profil);
    }

    /**
     * Get profils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfils()
    {
        return $this->profils;
    }
	
	public function getNom()
	{
		if(!is_null($this->getPersonalinformations())){
			return $this->getPersonalinformations()->getNom();
		}
		return null;
	}
	
	public function getFullName()
	{

		if(!is_null($this->getPersonalinformations())){
			return $this->getPersonalinformations()->getFullName();
		}
		return null;
	}

    /**
     * Add evenement
     *
     * @param \App\Entity\Evenement $evenement
     *
     * @return Employe
     */
    public function addEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \App\Entity\Evenement $evenement
     */
    public function removeEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Add portail.
     *
     * @param \App\Entity\Masterlistelg $portail
     *
     * @return Employe
     */
    public function addPortail(\App\Entity\Masterlistelg $portail)
    {
        $this->portails[] = $portail;

        return $this;
    }

    /**
     * Remove portail.
     *
     * @param \App\Entity\Masterlistelg $portail
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePortail(\App\Entity\Masterlistelg $portail)
    {
        return $this->portails->removeElement($portail);
    }

    /**
     * Get portails.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortails()
    {
        return $this->portails;
    }

    /**
     * Set espaceformation.
     *
     * @param bool|null $espaceformation
     *
     * @return Employe
     */
    public function setEspaceformation($espaceformation = null)
    {
        $this->espaceformation = $espaceformation;

        return $this;
    }

    /**
     * Get espaceformation.
     *
     * @return bool|null
     */
    public function getEspaceformation()
    {
        return $this->espaceformation;
    }

    /**
     * Set espaceadmin.
     *
     * @param bool|null $espaceadmin
     *
     * @return Employe
     */
    public function setEspaceadmin($espaceadmin = null)
    {
        $this->espaceadmin = $espaceadmin;

        return $this;
    }

    /**
     * Get espaceadmin.
     *
     * @return bool|null
     */
    public function getEspaceadmin()
    {
        return $this->espaceadmin;
    }

    /**
     * Set espacequizz.
     *
     * @param bool|null $espacequizz
     *
     * @return Employe
     */
    public function setEspacequizz($espacequizz = null)
    {
        $this->espacequizz = $espacequizz;

        return $this;
    }

    /**
     * Get espacequizz.
     *
     * @return bool|null
     */
    public function getEspacequizz()
    {
        return $this->espacequizz;
    }

    /**
     * Set espaceactualites.
     *
     * @param bool|null $espaceactualites
     *
     * @return Employe
     */
    public function setEspaceactualites($espaceactualites = null)
    {
        $this->espaceactualites = $espaceactualites;

        return $this;
    }

    /**
     * Get espaceactualites.
     *
     * @return bool|null
     */
    public function getEspaceactualites()
    {
        return $this->espaceactualites;
    }

    /**
     * Set espacebodoranco.
     *
     * @param bool|null $espacebodoranco
     *
     * @return Employe
     */
    public function setEspacebodoranco($espacebodoranco = null)
    {
        $this->espacebodoranco = $espacebodoranco;

        return $this;
    }

    /**
     * Get espacebodoranco.
     *
     * @return bool|null
     */
    public function getEspacebodoranco()
    {
        return $this->espacebodoranco;
    }

    /**
     * Set espacebomycommunity.
     *
     * @param bool|null $espacebomycommunity
     *
     * @return Employe
     */
    public function setEspacebomycommunity($espacebomycommunity = null)
    {
        $this->espacebomycommunity = $espacebomycommunity;

        return $this;
    }

    /**
     * Get espacebomycommunity.
     *
     * @return bool|null
     */
    public function getEspacebomycommunity()
    {
        return $this->espacebomycommunity;
    }

    /**
     * Set espaceboclassrooms.
     *
     * @param bool|null $espaceboclassrooms
     *
     * @return Employe
     */
    public function setEspaceboclassrooms($espaceboclassrooms = null)
    {
        $this->espaceboclassrooms = $espaceboclassrooms;

        return $this;
    }

    /**
     * Get espaceboclassrooms.
     *
     * @return bool|null
     */
    public function getEspaceboclassrooms()
    {
        return $this->espaceboclassrooms;
    }

    /**
     * Set espaceclassrooms.
     *
     * @param bool|null $espaceclassrooms
     *
     * @return Employe
     */
    public function setEspaceclassrooms($espaceclassrooms = null)
    {
        $this->espaceclassrooms = $espaceclassrooms;

        return $this;
    }

    /**
     * Get espaceclassrooms.
     *
     * @return bool|null
     */
    public function getEspaceclassrooms()
    {
        return $this->espaceclassrooms;
    }

    /**
     * Set rgbd.
     *
     * @param bool|null $rgbd
     *
     * @return Employe
     */
    public function setRgbd($rgbd = null)
    {
        $this->rgbd = $rgbd;

        return $this;
    }

    /**
     * Get rgbd.
     *
     * @return bool|null
     */
    public function getRgbd()
    {
        return $this->rgbd;
    }

    /**
     * Set datergbd
     *
     * @param \DateTime $datergbd
     *
     * @return Employe
     */
    public function setDatergbd($datergbd)
    {
        $this->datergbd = $datergbd;

        return $this;
    }

    /**
     * Get datergbd
     *
     * @return \DateTime
     */
    public function getDatergbd()
    {
        return $this->datergbd;
    }


    /**
     * Set droitsniv2.
     *
     * @param bool|null $droitsniv2
     *
     * @return Employe
     */
    public function setDroitsniv2($droitsniv2 = null)
    {
        $this->droitsniv2 = $droitsniv2;

        return $this;
    }

    /**
     * Get droitsniv2.
     *
     * @return bool|null
     */
    public function getDroitsniv2()
    {
        return $this->droitsniv2;
    }

    /**
     * Add ipsautorisee.
     *
     * @param \App\Entity\EmployeIpAutorisee $ipsautorisee
     *
     * @return Employe
     */
    public function addIpsautorisee(\App\Entity\EmployeIpAutorisee $ipsautorisee)
    {
        $this->ipsautorisees[] = $ipsautorisee;
        $ipsautorisee->setEmploye($this);
        return $this;
    }

    /**
     * Remove ipsautorisee.
     *
     * @param \App\Entity\EmployeIpAutorisee $ipsautorisee
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIpsautorisee(\App\Entity\EmployeIpAutorisee $ipsautorisee)
    {
        return $this->ipsautorisees->removeElement($ipsautorisee);
    }

    /**
     * Get ipsautorisees.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIpsautorisees()
    {
        return $this->ipsautorisees;
    }
}
