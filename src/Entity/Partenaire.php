<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Partenaire
 *
 * @ORM\Table(name="partenaires")
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Partenaire
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etablissements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
		
		$this->archive=false;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siren;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formejuridique;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $photo;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $categories;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $rubrique;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Etablissement", cascade={"persist", "remove"})
     */
    private $etablissements;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\PersonalInformations",cascade={"persist"})
    */
    private $contacts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tiers",cascade={"all"})
     */
    private $tiers;

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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="shortdescription", type="text", nullable=true)
     */
    private $shortdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seotitle", type="string", length=255, nullable=true)
     */
    private $seotitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="text", nullable=true)
     */
    private $seodescription;

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
     * Set siren
     *
     * @param string $siren
     *
     * @return Partenaire
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * Get siren
     *
     * @return string
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set formejuridique
     *
     * @param string $formejuridique
     *
     * @return Partenaire
     */
    public function setFormejuridique($formejuridique)
    {
        $this->formejuridique = $formejuridique;

        return $this;
    }

    /**
     * Get formejuridique
     *
     * @return string
     */
    public function getFormejuridique()
    {
        return $this->formejuridique;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
     * Set photo
     *
     * @param \App\Entity\Upload $photo
     *
     * @return Partenaire
     */
    public function setPhoto(\App\Entity\Upload $photo = null)
    {
        $this->photo = $photo;
		$this->photo->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo'));
        return $this;
    }

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
     * Add etablissement
     *
     * @param \App\Entity\Etablissement $etablissement
     *
     * @return Partenaire
     */
    public function addEtablissement(\App\Entity\Etablissement $etablissement)
    {
        $this->etablissements[] = $etablissement;

        return $this;
    }

    /**
     * Remove etablissement
     *
     * @param \App\Entity\Etablissement $etablissement
     */
    public function removeEtablissement(\App\Entity\Etablissement $etablissement)
    {
        $this->etablissements->removeElement($etablissement);
    }

    /**
     * Get etablissements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtablissements()
    {
        return $this->etablissements;
    }

    /**
     * Add contact
     *
     * @param \App\Entity\PersonalInformations $contact
     *
     * @return Partenaire
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Partenaire
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
     * @return Partenaire
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
     * Add category
     *
     * @param \App\Entity\Masterlistelg $category
     *
     * @return Partenaire
     */
    public function addCategory(\App\Entity\Masterlistelg $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \App\Entity\Masterlistelg $category
     */
    public function removeCategory(\App\Entity\Masterlistelg $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }



    /**
     * Set seodescription
     *
     * @param string $seodescription
     *
     * @return Partenaire
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
     * Set seotitle
     *
     * @param string $seotitle
     *
     * @return Partenaire
     */
    public function setSeotitle($seotitle)
    {
        $this->seotitle = $seotitle;

        return $this;
    }

    /**
     * Get seotitle
     *
     * @return string
     */
    public function getSeotitle()
    {
        return $this->seotitle;
    }

    

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Partenaire
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set shortdescription
     *
     * @param string $shortdescription
     *
     * @return Partenaire
     */
    public function setShortdescription($shortdescription)
    {
        $this->shortdescription = $shortdescription;

        return $this;
    }

    /**
     * Get shortdescription
     *
     * @return string
     */
    public function getShortdescription()
    {
        return $this->shortdescription;
    }

    /**
     * Set tiers.
     *
     * @param \App\Entity\Tiers|null $tiers
     *
     * @return Partenaire
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
     * Set rubrique.
     *
     * @param \App\Entity\Masterlistelg|null $rubrique
     *
     * @return Partenaire
     */
    public function setRubrique(\App\Entity\Masterlistelg $rubrique = null)
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    /**
     * Get rubrique.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }
}
