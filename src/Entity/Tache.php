<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\PrincipalesInformation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity(repositoryClass="App\Repository\TacheRepository")
 */
class Tache extends PrincipalesInformation
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
     * @Assert\GreaterThan(-1)
     * @ORM\Column(name="ordre", type="integer", nullable=true, unique=false)
     */
    private $ordre;

    /**
     * @var float
     *
     * @ORM\Column(name="repetition", type="float", nullable=true)
     */
    private $repetition;

    /**
     * @ORM\Column(name="est_archivee", type="boolean", nullable=false, unique=false)
     */
    private $est_archivee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="executedate", type="datetime")
     */
    private $executedate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prochaindate", type="datetime")
     */
    private $prochaindate;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statut;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $categorie;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $modeles;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $resultat;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $service;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->est_archivee = false;
        $this->ordre = 0;
        $this->modeles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get the value of ordre
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set the value of ordre
     *
     * @return  self
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Set estArchivee
     *
     * @param boolean $estArchivee
     *
     * @return Tache
     */
    public function setEstArchivee($estArchivee)
    {
        $this->est_archivee = $estArchivee;

        return $this;
    }

    /**
     * Get estArchivee
     *
     * @return boolean
     */
    public function getEstArchivee()
    {
        return $this->est_archivee;
    }

    /**
     * Set repetition
     *
     * @param float $repetition
     *
     * @return Offer
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;

        return $this;
    }

    /**
     * Get repetition
     *
     * @return float
     */
    public function getRepetition()
    {
        return $this->repetition;
    }

    /**
     * Set executedate
     *
     * @param \DateTime $executedate
     *
     * @return Offer
     */
    public function setExecutedate($executedate)
    {
        $this->executedate = $executedate;

        return $this;
    }

    /**
     * Get executedate
     *
     * @return \DateTime
     */
    public function getExecutedate()
    {
        return $this->executedate;
    }

    /**
     * Set prochaindate
     *
     * @param \DateTime $prochaindate
     *
     * @return Offer
     */
    public function setProchaindate($prochaindate)
    {
        $this->prochaindate = $prochaindate;

        return $this;
    }

    /**
     * Get prochaindate
     *
     * @return \DateTime
     */
    public function getProchaindate()
    {
        return $this->prochaindate;
    }


    /**
     * Set resultat
     *
     * @param \App\Entity\Masterlistelg $resultat
     *
     * @return Tache
     */
    public function setResultat(\App\Entity\Masterlistelg $resultat = null)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getResultat()
    {
        return $this->resultat;
    }


    /**
     * Set statut
     *
     * @param \App\Entity\Masterlistelg $statut
     *
     * @return Tache
     */
    public function setStatut (\App\Entity\Masterlistelg $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatut ()
    {
        return $this->statut;
    }


    /**
     * Set service
     *
     * @param \App\Entity\Masterlistelg $service
     *
     * @return Tache
     */
    public function setService(\App\Entity\Masterlistelg $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getService()
    {
        return $this->service;
    }


    /**
     * Set categorie
     *
     * @param \App\Entity\Masterlistelg $categorie
     *
     * @return Tache
     */
    public function setCategorie(\App\Entity\Masterlistelg $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add modele
     *
     * @param \App\Entity\Masterlistelg $modele
     *
     * @return Tache
     */
    public function addModele(\App\Entity\Masterlistelg $modele)
    {
        $this->modeles[] = $modele;

        return $this;
    }

    /**
     * Remove modele
     *
     * @param \App\Entity\Masterlistelg $modele
     */
    public function removeModele(\App\Entity\Masterlistelg $modele)
    {
        $this->modeles->removeElement($modele);
    }

    /**
     * Get modeles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModele()
    {
        return $this->modeles;
    }
}
