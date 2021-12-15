<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Bondecommande
 *
 * @ORM\Table(name="bondecommandes")
 * @ORM\Entity(repositoryClass="App\Repository\BondecommandeRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Bondecommande
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
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numcomplementaire;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $remuneration;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iddokelio;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Sousaction", inversedBy="bondecommandes", cascade={"persist"})
	*/
	private $sousaction;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\BondecommandeParcours", orphanRemoval=true, mappedBy="bondecommande", cascade={"all"})
    */
    private $bdcparcours;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalapiaes;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalGF;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $modele;


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
     * Set numero
     *
     * @param string $numero
     *
     * @return Bondecommande
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Bondecommande
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
     * @return Bondecommande
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
     * Set numcomplementaire
     *
     * @param string $numcomplementaire
     *
     * @return Bondecommande
     */
    public function setNumcomplementaire($numcomplementaire)
    {
        $this->numcomplementaire = $numcomplementaire;

        return $this;
    }

    /**
     * Get numcomplementaire
     *
     * @return string
     */
    public function getNumcomplementaire()
    {
        return $this->numcomplementaire;
    }


    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Bondecommande
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
     * @return Bondecommande
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
     * Set sousaction
     *
     * @param \App\Entity\Sousaction $sousaction
     *
     * @return Bondecommande
     */
    public function setSousaction(\App\Entity\Sousaction $sousaction = null)
    {
        $this->sousaction = $sousaction;

        return $this;
    }

    /**
     * Get sousaction
     *
     * @return \App\Entity\Sousaction
     */
    public function getSousaction()
    {
        return $this->sousaction;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Bondecommande
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
     * @return Bondecommande
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
     * Set remuneration
     *
     * @param boolean $remuneration
     *
     * @return Bondecommande
     */
    public function setRemuneration($remuneration)
    {
        $this->remuneration = $remuneration;

        return $this;
    }

    /**
     * Get remuneration
     *
     * @return boolean
     */
    public function getRemuneration()
    {
        return $this->remuneration;
    }

    /**
     * Set iddokelio
     *
     * @param string $iddokelio
     *
     * @return Bondecommande
     */
    public function setIddokelio($iddokelio)
    {
        $this->iddokelio = $iddokelio;

        return $this;
    }

    /**
     * Get iddokelio
     *
     * @return string
     */
    public function getIddokelio()
    {
        return $this->iddokelio;
    }

    /**
     * Set totalapiaes
     *
     * @param string $totalapiaes
     *
     * @return Bondecommande
     */
    public function setTotalapiaes($totalapiaes)
    {
        $this->totalapiaes = $totalapiaes;

        return $this;
    }

    /**
     * Get totalapiaes
     *
     * @return string
     */
    public function getTotalapiaes()
    {
        return $this->totalapiaes;
    }

    /**
     * Set totalGF
     *
     * @param string $totalGF
     *
     * @return Bondecommande
     */
    public function setTotalGF($totalGF)
    {
        $this->totalGF = $totalGF;

        return $this;
    }

    /**
     * Get totalapiaes
     *
     * @return string
     */
    public function getTotalGF()
    {
        return $this->totalGF;
    }

    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bdcparcours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bdcparcour
     *
     * @param \App\Entity\BondecommandeParcours $bdcparcour
     *
     * @return Bondecommande
     */
    public function addBdcparcour(\App\Entity\BondecommandeParcours $bdcparcour)
    {
        $this->bdcparcours[] = $bdcparcour;
		$bdcparcour->setBondecommande($this);
        return $this;
    }

    /**
     * Remove bdcparcour
     *
     * @param \App\Entity\BondecommandeParcours $bdcparcour
     */
    public function removeBdcparcour(\App\Entity\BondecommandeParcours $bdcparcour)
    {
        $this->bdcparcours->removeElement($bdcparcour);
    }

    /**
     * Get bdcparcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBdcparcours()
    {
        return $this->bdcparcours;
    }

    /**
     * Set modele
     *
     * Set modele
     * @param \App\Entity\Masterlistelg $modele
     *
     * @return bdcparcours
     */
    public function setModele(\App\Entity\Masterlistelg $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getModele()
    {
        return $this->modele;
    }
}
