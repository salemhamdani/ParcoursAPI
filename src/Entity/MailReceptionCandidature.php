<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * MailReceptionCandidature
 *
 * @ORM\Table(name="mailreceptioncandidatures")
 * @ORM\Entity(repositoryClass="App\Repository\MailReceptionCandidatureRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MailReceptionCandidature {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parcours = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ obligatoire.")
     */
    private $intitule;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
     */
    private $employes;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
     */
    private $principal;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Parcours")
     */
    private $parcours;

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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return MailReceptionCandidature
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
     * @return MailReceptionCandidature
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
     * @return MailReceptionCandidature
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
     * Add employe
     *
     * @param \App\Entity\Employe $employe
     *
     * @return MailReceptionCandidature
     */
    public function addEmploye(\App\Entity\Employe $employe)
    {
        $this->employes[] = $employe;

        return $this;
    }

    /**
     * Remove employe
     *
     * @param \App\Entity\Employe $employe
     */
    public function removeEmploye(\App\Entity\Employe $employe)
    {
        $this->employes->removeElement($employe);
    }

    /**
     * Get employes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployes()
    {
        return $this->employes;
    }



    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return MailReceptionCandidature
     */
    public function setParcours(\App\Entity\Parcours $parcours = null)
    {
        $this->parcours[] = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \App\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

      /**
     * Remove parcours
     *
     *@param \App\Entity\Parcours $parcours
     */
    public function removeParcours(\App\Entity\Parcours $parcours)
    {
        $this->parcours->removeElement($parcours);
    }




    /**
     * Set principal
     *
     * @param \App\Entity\Employe $principal
     *
     * @return MailReceptionCandidature
     */
    public function setPrincipal(\App\Entity\Employe $principal = null)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return \App\Entity\Employe
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return MailReceptionCandidature
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
     * @return MailReceptionCandidature
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return MailReceptionCandidature
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
     * Add parcourss
     *
     * @param \App\Entity\Parcours $parcourss
     *
     * @return MailReceptionCandidature
     */
    public function addParcourss(\App\Entity\Parcours $parcourss)
    {
        $this->parcourss[] = $parcourss;

        return $this;
    }

    /**
     * Remove parcourss
     *
     * @param \App\Entity\Parcours $parcourss
     */
    public function removeParcourss(\App\Entity\Parcours $parcourss)
    {
        $this->parcourss->removeElement($parcourss);
    }
}
