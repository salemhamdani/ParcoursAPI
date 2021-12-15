<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Financeur
 *
 * @ORM\Table(name="financeurs")
 * @ORM\Entity(repositoryClass="App\Repository\FinanceurRepository")
 * @UniqueEntity(fields={"intitule"}, message="Ce financeur existe déjà.")
 * @ORM\HasLifecycleCallbacks
 */
class Financeur
{

    public function __construct() {
        $this->financeuradresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->codeabsences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coderetards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
		$this->financeurcodes = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
    }

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
    * @ORM\OneToMany(targetEntity="App\Entity\Action", mappedBy="financeur",cascade={"persist"})
    */
    private $actions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateupdate;

	/**
	* @ORM\OneToOne(targetEntity="App\Entity\Tchat", cascade={"all"})
     */
    private $tchat;

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
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=250, nullable=true)
     * 
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=250)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;


    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="text", nullable=true)
     * @Assert\Url(message = "Le lien '{{ value }}' n'est pas une URL valide.")
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="seotitre", type="string", length=250, nullable=true)
     */
    private $seotitre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="string", length=250, nullable=true)
     */
    private $seodescription;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=250, nullable=true)
     */
    private $keywords;
    
    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @var int
     *
     * @ORM\Column(name="remise", type="integer", nullable=true)
     */
    private $remise;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $category;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $financementopco;

     /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PerimetreFinancement", cascade={"persist", "remove"}, mappedBy="financeur", orphanRemoval=true)
     */
    private $perimetres;

     /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\FinanceurCode", cascade={"persist", "remove"}, mappedBy="financeursource", orphanRemoval=true)
     */
    private $financeurcodes;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $type;
    
    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\FinanceurAdresse", cascade={"persist", "remove"}, mappedBy="financeur", orphanRemoval=true)
     */
    private $financeuradresses;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\PersonalInformations",cascade={"persist"})
    */
    private $contacts;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CodeAbsence", cascade={"persist", "remove"}, mappedBy="financeur", orphanRemoval=true)
     */
    private $codeabsences;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CodeRetard", cascade={"persist", "remove"}, mappedBy="financeur", orphanRemoval=true)
     */
    private $coderetards;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tiers",cascade={"all"})
     */
    private $tiers;
    
    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=256, nullable=true)
     */
    private $path;

     /**
     * Get photo
     *
     * @return \App\Entity\Upload
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
       /**
     * Set photo
     * @param \App\Entity\Upload $photo
     * @return PersonalInformations
     */
    public function setPhoto(\App\Entity\Upload $photo = null)
    {
        $this->photo = $photo;
		$this->photo->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo'));
        return $this;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Financeur
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
     * @return Financeur
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
     * @return Financeur
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
     * Set alt
     *
     * @param string $alt
     *
     * @return Financeur
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Financeur
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Financeur
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return Financeur
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Financeur
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set seotitre
     *
     * @param string $seotitre
     *
     * @return Financeur
     */
    public function setSeotitre($seotitre)
    {
        $this->seotitre = $seotitre;

        return $this;
    }

    /**
     * Get seotitre
     *
     * @return string
     */
    public function getSeotitre()
    {
        return $this->seotitre;
    }

    /**
     * Set seodescription
     *
     * @param string $seodescription
     *
     * @return Financeur
     */
    public function setSeodescription($seodescription)
    {
        $this->seodescription = $seodescription;

        return $this;
    }

    /**
     * Get seodescription
     *
     * @return string
     */
    public function getSeodescription()
    {
        return $this->seodescription;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Financeur
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Financeur
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
     * @return Financeur
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
     * Set remise
     *
     * @param integer $remise
     *
     * @return Financeur
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return integer
     */
    public function getRemise()
    {
        return $this->remise;
    }

     /**
     * Set category
     *
     * @param \App\Entity\Masterlistelg $category
     *
     * @return Financeur
     */
    public function setCategory(\App\Entity\Masterlistelg $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategory()
    {
        return $this->category;
    }

     /**
     * Set financementopco
     *
     * @param \App\Entity\Masterlistelg $financementopco
     *
     * @return Financeur
     */
    public function setFinancementopco(\App\Entity\Masterlistelg $financementopco = null)
    {
        $this->financementopco = $financementopco;

        return $this;
    }

    /**
     * Get financementopco
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFinancementopco()
    {
        return $this->financementopco;
    }
    
     /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Financeur
     */
    public function setType(\App\Entity\Masterlistelg $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set tchat
     *
     * @param \App\Entity\Tchat $tchat
     *
     * @return Financeur
     */
    public function setTchat(\App\Entity\Tchat $tchat = null)
    {
        $this->tchat = $tchat;

        return $this;
    }

    /**
     * Get tchat
     *
     * @return \App\Entity\Tchat
     */
    public function getTchat()
    {
        return $this->tchat;
    }

    /**
     * Add financeuradress
     *
     * @param \App\Entity\FinanceurAdresse $financeuradress
     *
     * @return Financeur
     */
    public function addFinanceuradress(\App\Entity\FinanceurAdresse $financeuradress)
    {
        $this->financeuradresses[] = $financeuradress;
		$financeuradress->setFinanceur($this);
        return $this;
    }

    /**
     * Remove financeuradress
     *
     * @param \App\Entity\FinanceurAdresse $financeuradress
     */
    public function removeFinanceuradress(\App\Entity\FinanceurAdresse $financeuradress)
    {
        $this->financeuradresses->removeElement($financeuradress);
    }

    /**
     * Get financeuradresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinanceuradresses()
    {
        return $this->financeuradresses;
    }

    /**
     * Add contact
     *
     * @param \App\Entity\PersonalInformations $contact
     *
     * @return Financeur
     */
    public function addContact(\App\Entity\PersonalInformations $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \App\Entity\PersonalInformations $contact
     */
    public function removeContact(\App\Entity\PersonalInformations $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add codeabsence
     *
     * @param \App\Entity\CodeAbsence $codeabsence
     *
     * @return Financeur
     */
    public function addCodeabsence(\App\Entity\CodeAbsence $codeabsence)
    {
        $this->codeabsences[] = $codeabsence;
		$codeabsence->setFinanceur($this);
        return $this;
    }

    /**
     * Remove codeabsence
     *
     * @param \App\Entity\CodeAbsence $codeabsence
     */
    public function removeCodeabsence(\App\Entity\CodeAbsence $codeabsence)
    {
        $this->codeabsences->removeElement($codeabsence);
    }

    /**
     * Get codeabsences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCodeabsences()
    {
        return $this->codeabsences;
    }

    /**
     * Add coderetard
     *
     * @param \App\Entity\CodeRetard $coderetard
     *
     * @return Financeur
     */
    public function addCoderetard(\App\Entity\CodeRetard $coderetard)
    {
        $this->coderetards[] = $coderetard;

        return $this;
    }

    /**
     * Remove coderetard
     *
     * @param \App\Entity\CodeRetard $coderetard
     */
    public function removeCoderetard(\App\Entity\CodeRetard $coderetard)
    {
        $this->coderetards->removeElement($coderetard);
    }

    /**
     * Get coderetards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoderetards()
    {
        return $this->coderetards;
    }


    /**
     * Add perimetre
     *
     * @param \App\Entity\PerimetreFinancement $perimetre
     *
     * @return Financeur
     */
    public function addPerimetre(\App\Entity\PerimetreFinancement $perimetre)
    {
        $this->perimetres[] = $perimetre;

        return $this;
    }

    /**
     * Remove perimetre
     *
     * @param \App\Entity\PerimetreFinancement $perimetre
     */
    public function removePerimetre(\App\Entity\PerimetreFinancement $perimetre)
    {
        $this->perimetres->removeElement($perimetre);
    }

    /**
     * Get perimetres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerimetres()
    {
        return $this->perimetres;
    }

    /**
     * Add financeurcode
     *
     * @param \App\Entity\FinanceurCode $financeurcode
     *
     * @return Financeur
     */
    public function addFinanceurcode(\App\Entity\FinanceurCode $financeurcode)
    {
        $this->financeurcodes[] = $financeurcode;

        return $this;
    }

    /**
     * Remove financeurcode
     *
     * @param \App\Entity\FinanceurCode $financeurcode
     */
    public function removeFinanceurcode(\App\Entity\FinanceurCode $financeurcode)
    {
        $this->financeurcodes->removeElement($financeurcode);
    }

    /**
     * Get financeurcodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinanceurcodes()
    {
        return $this->financeurcodes;
    }

    /**
     * Add action
     *
     * @param \App\Entity\Action $action
     *
     * @return Financeur
     */
    public function addAction(\App\Entity\Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \App\Entity\Action $action
     */
    public function removeAction(\App\Entity\Action $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set tiers.
     *
     * @param \App\Entity\Tiers|null $tiers
     *
     * @return Financeur
     */
    public function setTiers(\App\Entity\Tiers $tiers = null)
    {
        $this->tiers = $tiers;

        return $this;
    }

    /**
     * Get tiers.
     *
     * @return \App\Entity\Tiers|null
     */
    public function getTiers()
    {
        return $this->tiers;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Financeur
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
