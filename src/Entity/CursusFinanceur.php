<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * CursusFinanceur
 *
 * @ORM\Table(name="cursus_financeur")
 * @ORM\Entity(repositoryClass="App\Repository\CursusFinanceurRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CursusFinanceur {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursuslgs = new \Doctrine\Common\Collections\ArrayCollection();
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
    * @ORM\ManyToOne(targetEntity="App\Entity\DossierFinanceur", inversedBy="cursusfinanceurs")
    */
    private $dossierfinanceur;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typecursus;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Cursuslg", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $cursuslgs;

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
    * @ORM\OneToMany(targetEntity="App\Entity\CursusReponse", mappedBy="cursusfinanceur",  orphanRemoval=true, cascade={"all"})
    */
    private $reponse;

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
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Cursus
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
     * @return Cursus
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
     * Set dossierfinanceur.
     *
     * @param \App\Entity\DossierFinanceur|null $dossierfinanceur
     *
     * @return Cursus
     */
    public function setDossierfinanceur(\App\Entity\DossierFinanceur $dossierfinanceur = null)
    {
        $this->dossierfinanceur = $dossierfinanceur;

        return $this;
    }

    /**
     * Get dossierfinanceur.
     *
     * @return \App\Entity\DossierFinanceur|null
     */
    public function getDossierfinanceur()
    {
        return $this->dossierfinanceur;
    }

    /**
     * Add cursuslg.
     *
     * @param \App\Entity\Cursuslg $cursuslg
     *
     * @return Cursus
     */
    public function addCursuslg(\App\Entity\Cursuslg $cursuslg)
    {
        $this->cursuslgs[] = $cursuslg;

        return $this;
    }

    /**
     * Remove cursuslg.
     *
     * @param \App\Entity\Cursuslg $cursuslg
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCursuslg(\App\Entity\Cursuslg $cursuslg)
    {
        return $this->cursuslgs->removeElement($cursuslg);
    }

    /**
     * Get cursuslgs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursuslgs()
    {
        return $this->cursuslgs;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return Cursus
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate.
     *
     * @param \App\Entity\User|null $quiupdate
     *
     * @return Cursus
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }


    /**
     * Add reponse.
     *
     * @param \App\Entity\CursusReponse $reponse
     *
     * @return CursusFinanceur
     */
    public function addReponse(\App\Entity\CursusReponse $reponse)
    {
        $this->reponse[] = $reponse;
        $reponse->setCursusFinanceur($this);
        return $this;
    }

    /**
     * Remove reponse.
     *
     * @param \App\Entity\CursusReponse $selection
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReponse(\App\Entity\CursusReponse $reponse)
    {
        return $this->reponse->removeElement($reponse);
    }

    /**
     * Get reponse.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}
