<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Profil
 *
 * @ORM\Table(name="profil")
 * @ORM\Entity(repositoryClass="App\Repository\ProfilRepository")
 * @UniqueEntity(fields={"intitule"}, message="Le profil existe déjà.")
 * @ORM\HasLifecycleCallbacks
 */
class Profil
{


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
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=200)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=200, nullable=true)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;
    
    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $typeFormulaire;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe", cascade={"persist"})
     */
    
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="profils", cascade={"persist"})
     * @ORM\JoinColumn(name="contact_devis", nullable=true )
     */
    private $contactDevis;

    /**
    * @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $remisepourc;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $remisepourc=0;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Profil
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
     * @return Profil
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Profil
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
     * Set code
     *
     * @param string $code
     *
     * @return Profil
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Profil
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Profil
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Profil
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
     * @return Profil
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
     * Set typeFormulaire
     *
     * @param \App\Entity\Masterlistelg $typeFormulaire
     *
     * @return Profil
     */
    public function setTypeFormulaire(\App\Entity\Masterlistelg $typeFormulaire = null)
    {
        $this->typeFormulaire = $typeFormulaire;

        return $this;
    }

    /**
     * Get typeFormulaire
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeFormulaire()
    {
        return $this->typeFormulaire;
    }

    /**
     * Add user
     *
     * @param \App\Entity\Employe $user
     *
     * @return Profil
     */
    public function addUser(\App\Entity\Employe $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \App\Entity\Employe $user
     */
    public function removeUser(\App\Entity\Employe $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set contactDevis
     *
     * @param \App\Entity\Employe $contactDevis
     *
     * @return Profil
     */
    public function setContactDevis(\App\Entity\Employe $contactDevis = null)
    {
        $this->contactDevis = $contactDevis;

        return $this;
    }

    /**
     * Get contactDevis
     *
     * @return \App\Entity\Employe
     */
    public function getContactDevis()
    {
        return $this->contactDevis;
    }

    /**
     * Set remisepourc
     *
     * @param string $remisepourc
     *
     * @return Profil
     */
    public function setRemisepourc($remisepourc)
    {
        $this->remisepourc = $remisepourc;

        return $this;
    }

    /**
     * Get remisepourc
     *
     * @return string
     */
    public function getRemisepourc()
    {
        return $this->remisepourc;
    }
}
