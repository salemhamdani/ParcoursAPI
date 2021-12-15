<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\PrincipalesInformation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tache
 *
 * @ORM\Table(name="tachehistorique")
 * @ORM\Entity(repositoryClass="App\Repository\TacheHistoriqueRepository")
 */
class TacheHistorique 
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
     * @var \DateTime
     *
     * @ORM\Column(name="executedate", type="datetime")
     */
    private $executedate;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statut;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $resultat;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Tache")
    */
    private $tache;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set executedate
     *
     * @param \DateTime $executedate
     *
     * @return executedate
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
     * Set resultat
     *
     * @param \App\Entity\Masterlistelg $resultat
     *
     * @return TacheHistorique
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
     * Set message.
     *
     * @param string|null $message
     *
     * @return TacheHistorique
     */
    public function setMessage($message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * Set statut
     *
     * @param \App\Entity\Masterlistelg $statut
     *
     * @return TacheHistorique
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
     * Set tache
     *
     * @param \App\Entity\Tache $tache
     *
     * @return TacheHistorique
     */
    public function setTache(\App\Entity\Tache $tache = null)
    {
        $this->tache = $tache;

        return $this;
    }

    /**
     * Get tache
     *
     * @return \App\Entity\Tache
     */
    public function getTache()
    {
        return $this->tache;
    }
}
