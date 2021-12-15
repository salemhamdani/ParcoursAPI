<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $etat;

    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $type;

    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $fonction;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier")
    */
    private $dossiers;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="text", nullable=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Formateur")
    */
    private $formateur;
    

     /**
     * Constructor
     */
    public function __construct()
    {
        $this->creationdate = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return Notification
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \App\Entity\Formateur
     */
    public function getFormateur()
    {
        return $this->formateur;
    }



    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Notification
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }
    
  
    /**
     * Set etat
     *
     * @param \App\Entity\Masterlistelg $etat
     *
     * @return Notification
     */
    public function setEtat(\App\Entity\Masterlistelg $etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getEtat()
    {
        return $this->etat;
    }
    
  

    /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Notification
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
     * Set fonction
     *
     * @param \App\Entity\Masterlistelg $fonction
     *
     * @return Notification
     */
    public function setFonction(\App\Entity\Masterlistelg $fonction = null)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Notification
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Notification
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set dossiers
     *
     * @param string $dossiers
     *
     * @return Notification
     */
    public function setDossiers($dossiers)
    {
        $this->dossiers = $dossiers;

        return $this;
    }

    /**
     * Get dossiers
     *
     * @return string
     */
    public function getDossiers()
    {
        return $this->dossiers;
    }



    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Notification
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
