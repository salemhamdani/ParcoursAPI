<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Evenement", cascade={"persist"})
     * @ORM\JoinTable(name="participant_evenements")
     */
    private $evenements;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreation", type="datetime", nullable=true)
     */
    private $dataCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true )
     */
    private $commentaire;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $category;
    
    
    

    /**
     * Constructor
     */
    public function __construct() {
        $this->dataCreation = new \DateTime();
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
    }

   
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Participant
     */
    public function setNom($nom) {
        $this->nom = strtoupper($nom);

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Participant
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Participant
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Participant
     */
    public function setTel($tel) {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel() {
        return $this->tel;
    }

   

    /**
     * Add evenement
     *
     * @param \App\Entity\Evenement $evenement
     *
     * @return Participant
     */
    public function addEvenement(\App\Entity\Evenement $evenement) {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \App\Entity\Evenement $evenement
     */
    public function removeEvenement(\App\Entity\Evenement $evenement) {
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements() {
        return $this->evenements;
    }

    /**
     * Set evenements
     *
     * @param $evenements
     * @return $this
     */
    public function setEvenement($evenements) {
        $this->evenements = $evenements;

        return $this;
    }
    
    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     * ORM\PrePersist
     * @return Participant
     */
    public function setDataCreation() {
        $this->dataCreation = new \DateTime();

        return $this;
    }

    /**
     * Get dataCreation
     *
     * @return \DateTime
     */
    public function getDataCreation() {
        return $this->dataCreation;
    }


     /**
     * Set category
     *
     * @param \App\Entity\Masterlistelg $category
     *
     * @return Participant
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Participant
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
}
