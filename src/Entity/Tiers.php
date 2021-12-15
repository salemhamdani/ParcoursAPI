<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tiers
 *
 * @ORM\Table(name="tiers")
 * @ORM\Entity(repositoryClass="App\Repository\TiersRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Tiers
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $statutJuridique;
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSocial", type="string", length=255, nullable=true)
     */
    private $raisonSocial;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $codebanque;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $codeguichet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $numcompte;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $clerib;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $domiciliation;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     * 
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $naf;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="numTva", type="string", length=255, nullable=true)
     */
    private $numTva;

    /**
     * @var string
     *
     * @ORM\Column(name="effectif", type="string", length=65, nullable=true)
     */
    private $effectif;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $logo;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\Tchat", cascade={"all"})
     */
    private $tchat;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\PersonalInformations",cascade={"persist"})
    */
    private $contacts;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",cascade={"all"})
    */
    private $personalinformations;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteweb;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set raisonSocial.
     *
     * @param string|null $raisonSocial
     *
     * @return Tiers
     */
    public function setRaisonSocial($raisonSocial = null)
    {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    /**
     * Get raisonSocial.
     *
     * @return string|null
     */
    public function getRaisonSocial()
    {
        return $this->raisonSocial;
    }

    /**
     * Set codebanque.
     *
     * @param string|null $codebanque
     *
     * @return Tiers
     */
    public function setCodebanque($codebanque = null)
    {
        $this->codebanque = $codebanque;

        return $this;
    }

    /**
     * Get codebanque.
     *
     * @return string|null
     */
    public function getCodebanque()
    {
        return $this->codebanque;
    }

    /**
     * Set codeguichet.
     *
     * @param string|null $codeguichet
     *
     * @return Tiers
     */
    public function setCodeguichet($codeguichet = null)
    {
        $this->codeguichet = $codeguichet;

        return $this;
    }

    /**
     * Get codeguichet.
     *
     * @return string|null
     */
    public function getCodeguichet()
    {
        return $this->codeguichet;
    }

    /**
     * Set numcompte.
     *
     * @param string|null $numcompte
     *
     * @return Tiers
     */
    public function setNumcompte($numcompte = null)
    {
        $this->numcompte = $numcompte;

        return $this;
    }

    /**
     * Get numcompte.
     *
     * @return string|null
     */
    public function getNumcompte()
    {
        return $this->numcompte;
    }

    /**
     * Set clerib.
     *
     * @param string|null $clerib
     *
     * @return Tiers
     */
    public function setClerib($clerib = null)
    {
        $this->clerib = $clerib;

        return $this;
    }

    /**
     * Get clerib.
     *
     * @return string|null
     */
    public function getClerib()
    {
        return $this->clerib;
    }

    /**
     * Set domiciliation.
     *
     * @param string|null $domiciliation
     *
     * @return Tiers
     */
    public function setDomiciliation($domiciliation = null)
    {
        $this->domiciliation = $domiciliation;

        return $this;
    }

    /**
     * Get domiciliation.
     *
     * @return string|null
     */
    public function getDomiciliation()
    {
        return $this->domiciliation;
    }

    /**
     * Set url.
     *
     * @param string|null $url
     *
     * @return Tiers
     */
    public function setUrl($url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Tiers
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siret.
     *
     * @param string|null $siret
     *
     * @return Tiers
     */
    public function setSiret($siret = null)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret.
     *
     * @return string|null
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set numTva.
     *
     * @param string|null $numTva
     *
     * @return Tiers
     */
    public function setNumTva($numTva = null)
    {
        $this->numTva = $numTva;

        return $this;
    }

    /**
     * Get numTva.
     *
     * @return string|null
     */
    public function getNumTva()
    {
        return $this->numTva;
    }

    /**
     * Set effectif.
     *
     * @param string|null $effectif
     *
     * @return Tiers
     */
    public function setEffectif($effectif = null)
    {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * Get effectif.
     *
     * @return string|null
     */
    public function getEffectif()
    {
        return $this->effectif;
    }

    /**
     * Set archive.
     *
     * @param bool $archive
     *
     * @return Tiers
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive.
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set siteweb.
     *
     * @param string|null $siteweb
     *
     * @return Tiers
     */
    public function setSiteweb($siteweb = null)
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * Get siteweb.
     *
     * @return string|null
     */
    public function getSiteweb()
    {
        return $this->siteweb;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Tiers
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Tiers
     */
    public function setDateinsert($dateinsert = null)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert.
     *
     * @return \DateTime|null
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate.
     *
     * @param \DateTime|null $dateupdate
     *
     * @return Tiers
     */
    public function setDateupdate($dateupdate = null)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate.
     *
     * @return \DateTime|null
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set statutJuridique.
     *
     * @param \App\Entity\Masterlistelg|null $statutJuridique
     *
     * @return Tiers
     */
    public function setStatutJuridique(\App\Entity\Masterlistelg $statutJuridique = null)
    {
        $this->statutJuridique = $statutJuridique;

        return $this;
    }

    /**
     * Get statutJuridique.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getStatutJuridique()
    {
        return $this->statutJuridique;
    }

    /**
     * Add role.
     *
     * @param \App\Entity\Masterlistelg $role
     *
     * @return Tiers
     */
    public function addRole(\App\Entity\Masterlistelg $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role.
     *
     * @param \App\Entity\Masterlistelg $role
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRole(\App\Entity\Masterlistelg $role)
    {
        return $this->roles->removeElement($role);
    }

    /**
     * Get roles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set naf.
     *
     * @param \App\Entity\Masterlistelg|null $naf
     *
     * @return Tiers
     */
    public function setNaf(\App\Entity\Masterlistelg $naf = null)
    {
        $this->naf = $naf;

        return $this;
    }

    /**
     * Get naf.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getNaf()
    {
        return $this->naf;
    }

    /**
     * Set logo.
     *
     * @param \App\Entity\Upload|null $logo
     *
     * @return Tiers
     */
    public function setLogo(\App\Entity\Upload $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return \App\Entity\Upload|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set tchat.
     *
     * @param \App\Entity\Tchat|null $tchat
     *
     * @return Tiers
     */
    public function setTchat(\App\Entity\Tchat $tchat = null)
    {
        $this->tchat = $tchat;

        return $this;
    }

    /**
     * Get tchat.
     *
     * @return \App\Entity\Tchat|null
     */
    public function getTchat()
    {
        return $this->tchat;
    }

    /**
     * Add contact.
     *
     * @param \App\Entity\PersonalInformations $contact
     *
     * @return Tiers
     */
    public function addContact(\App\Entity\PersonalInformations $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact.
     *
     * @param \App\Entity\PersonalInformations $contact
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeContact(\App\Entity\PersonalInformations $contact)
    {
        return $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set personalinformations.
     *
     * @param \App\Entity\PersonalInformations|null $personalinformations
     *
     * @return Tiers
     */
    public function setPersonalinformations(\App\Entity\PersonalInformations $personalinformations = null)
    {
        $this->personalinformations = $personalinformations;

        return $this;
    }

    /**
     * Get personalinformations.
     *
     * @return \App\Entity\PersonalInformations|null
     */
    public function getPersonalinformations()
    {
        return $this->personalinformations;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return Tiers
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate.
     *
     * @param \App\Entity\User|null $quiupdate
     *
     * @return Tiers
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }
}
