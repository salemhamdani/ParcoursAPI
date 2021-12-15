<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historiqueemail
 *
 * @ORM\Table(name="historiqueemail")
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueemailRepository")
 */
class Historiqueemail {

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
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier")
    */
    private $dossier;

    /**
     * @var string
     *
     * @ORM\Column(name="emailsend", type="string", length=255, nullable=true)
     */
    private $emailsend;
    
    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="text", nullable=true)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreation", type="datetime", nullable=true)
     */
    private $dataCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUpdated", type="datetime", nullable=true)
     */
    private $dataUpdated; 
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $type;
    
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;
    
    /**
     * @var string
     *
     * @ORM\Column(name="code2", type="string", length=255, nullable=true)
     */
    private $code2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="urlattach", type="text",  nullable=true)
     */
    private $urlattach;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dataCreation = new \DateTime();
    }

    /**
     * Set nom
     *
     * @param string $objet
     *
     * @return Historiqueemail
     */
    public function setObjet($objet) {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet() {
        return $this->objet;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Historiqueemail
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Get code2
     *
     * @return string
     */
    public function getCode2() {
        return $this->code2;
    }

    /**
     * Set code2
     *
     * @param string $code2
     *
     * @return Historiqueemail
     */
    public function setCode2($code2) {
        $this->code2 = $code2;

        return $this;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Historiqueemail
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set emailsend
     *
     * @param string $emailsend
     *
     * @return Historiqueemail
     */
    public function setEmailsend($emailsend) {
        $this->emailsend = $emailsend;

        return $this;
    }

    /**
     * Get emailsend
     *
     * @return string
     */
    public function getEmailsend() {
        return $this->emailsend;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Historiqueemail
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
     * Set urlattach
     *
     * @param string $urlattach
     *
     * @return Historiqueemail
     */
    public function setUrlattach($urlattach) {
        $this->urlattach = $urlattach;

        return $this;
    }

    /**
     * Get urlattach
     *
     * @return string
     */
    public function getUrlattach() {
        return $this->urlattach;
    }

    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     * ORM\PrePersist
     * @return Historiqueemail
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
     * Set count
     *
     * @param integer $count
     *
     * @return Historiqueemail
     */
    public function setCount($count) {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount() {
        return $this->count;
    }

    
    /**
     * Set dataUpdated
     *
     * @param \DateTime $dataUpdated
     *
     * @return Historiqueemail
     */
    public function setDataUpdated($dataUpdated)
    {
        $this->dataUpdated = $dataUpdated;

        return $this;
    }

    /**
     * Get dataUpdated
     *
     * @return \DateTime
     */
    public function getDataUpdated()
    {
        return $this->dataUpdated;
    }



    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Historiqueemail
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
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Historiqueemail
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
}
