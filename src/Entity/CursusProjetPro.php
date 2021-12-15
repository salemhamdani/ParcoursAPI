<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursusProjetPro
 *
 * @ORM\Table(name="cursusprojetpro")
 * @ORM\Entity(repositoryClass="App\Repository\CursusProjetProRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CursusProjetPro {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cursus", inversedBy="projetpros",cascade={"persist"})
     */
    private $cursus;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $reponse;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quievalue;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $sourceeval;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Sessionevenement")
    */
    private $sessionevenement;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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
     * Set reponse.
     *
     * @param string|null $reponse
     *
     * @return CursusProjetPro
     */
    public function setReponse($reponse = null)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse.
     *
     * @return string|null
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return CursusProjetPro
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
     * @return CursusProjetPro
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
     * Set cursus.
     *
     * @param \App\Entity\Cursus|null $cursus
     *
     * @return CursusProjetPro
     */
    public function setCursus(\App\Entity\Cursus $cursus = null)
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * Get cursus.
     *
     * @return \App\Entity\Cursus|null
     */
    public function getCursus()
    {
        return $this->cursus;
    }

    /**
     * Set question.
     *
     * @param \App\Entity\Masterlistelg|null $question
     *
     * @return CursusProjetPro
     */
    public function setQuestion(\App\Entity\Masterlistelg $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set quievalue.
     *
     * @param \App\Entity\User|null $quievalue
     *
     * @return CursusProjetPro
     */
    public function setQuievalue(\App\Entity\User $quievalue = null)
    {
        $this->quievalue = $quievalue;

        return $this;
    }

    /**
     * Get quievalue.
     *
     * @return \App\Entity\User|null
     */
    public function getQuievalue()
    {
        return $this->quievalue;
    }

    /**
     * Set sourceeval.
     *
     * @param \App\Entity\Masterlistelg|null $sourceeval
     *
     * @return CursusProjetPro
     */
    public function setSourceeval(\App\Entity\Masterlistelg $sourceeval = null)
    {
        $this->sourceeval = $sourceeval;

        return $this;
    }

    /**
     * Get sourceeval.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getSourceeval()
    {
        return $this->sourceeval;
    }

    /**
     * Set sessionevenement.
     *
     * @param \App\Entity\Sessionevenement|null $sessionevenement
     *
     * @return CursusProjetPro
     */
    public function setSessionevenement(\App\Entity\Sessionevenement $sessionevenement = null)
    {
        $this->sessionevenement = $sessionevenement;

        return $this;
    }

    /**
     * Get sessionevenement.
     *
     * @return \App\Entity\Sessionevenement|null
     */
    public function getSessionevenement()
    {
        return $this->sessionevenement;
    }
}
