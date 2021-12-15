<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Personne
 * 
 * @ORM\Table(name="personne_documents")
 * @ORM\Entity(repositoryClass="App\Repository\PersonneDocumentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PersonneDocument
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->archive = false;
        $this->dateinsert = new \DateTime();
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="documents")
	*/
	private $personne;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="documents")
	*/
	private $dossier;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $document;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typedocument;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titre;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quivalide;

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
     * @return PersonneDocument
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
     * Set valide
     *
     * @param boolean $valide
     *
     * @return PersonneDocument
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return PersonneDocument
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
     * @return PersonneDocument
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
     * @return PersonneDocument
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
     * Set personne
     *
     * @param \App\Entity\Personne $personne
     *
     * @return PersonneDocument
     */
    public function setPersonne(\App\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \App\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return PersonneDocument
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
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
     * Set document
     *
     * @param \App\Entity\Upload $document
     *
     * @return PersonneDocument
     */
    public function setDocument(\App\Entity\Upload $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \App\Entity\Upload
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set typedocument
     *
     * @param \App\Entity\Masterlistelg $typedocument
     *
     * @return PersonneDocument
     */
    public function setTypedocument(\App\Entity\Masterlistelg $typedocument = null)
    {
        $this->typedocument = $typedocument;

        return $this;
    }

    /**
     * Get typedocument
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypedocument()
    {
        return $this->typedocument;
    }

    /**
     * Set quivalide
     *
     * @param \App\Entity\User $quivalide
     *
     * @return PersonneDocument
     */
    public function setQuivalide(\App\Entity\User $quivalide = null)
    {
        $this->quivalide = $quivalide;

        return $this;
    }

    /**
     * Get quivalide
     *
     * @return \App\Entity\User
     */
    public function getQuivalide()
    {
        return $this->quivalide;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return PersonneDocument
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
     * @return PersonneDocument
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
}
