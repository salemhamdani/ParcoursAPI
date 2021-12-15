<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContratEmargementEntreprise
 *
 * @ORM\Table(name="contrat_emargement_entreprise")
 * @ORM\Entity(repositoryClass="App\Repository\ContratEmargementEntrepriseRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class ContratEmargementEntreprise {

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->retard = false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $ampm;

	/**
	* @ORM\Column(type="boolean",nullable=true)
	*/
    private $estpresent;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\CodeAbsence")
    */
    private $motifabsences;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Convention")
    */
    private $convention;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $motifabsencecentre;

	/**
	* @ORM\Column(type="boolean",nullable=true)
	*/
    private $retard;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\CodeRetard")
    */
    private $motifretards;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $motifretardcentre;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiemarge;

	/**
     * @ORM\Column(type="datetime", nullable=true)
	*/
	private $dateemarge;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SessionEmargementJustificatif", inversedBy="sessionemargements", cascade={"persist"})
     */
    private $justificatif;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiinsert;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiupdate;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

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
    private $datedebut;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return ContratEmargementEntreprise
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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return ContratEmargementEntreprise
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }
    
    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     *
     * @return ContratEmargementEntreprise
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return ContratEmargementEntreprise
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
     * @return ContratEmargementEntreprise
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
     * Set ampm
     *
     * @param \App\Entity\Masterlistelg $ampm
     *
     * @return ContratEmargementEntreprise
     */
    public function setAmpm(\App\Entity\Masterlistelg $ampm = null)
    {
        $this->ampm = $ampm;

        return $this;
    }

    /**
     * Get ampm
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getAmpm()
    {
        return $this->ampm;
    }

    /**
     * Set convention
     *
     * @param \App\Entity\Convention $convention
     *
     * @return ContratEmargementEntreprise
     */
    public function setConvention(\App\Entity\Convention $convention = null)
    {
        $this->convention = $convention;

        return $this;
    }

    /**
     * Get convention
     *
     * @return \App\Entity\Convention
     */
    public function getConvention()
    {
        return $this->convention;
    }

    /**
     * Set dateemarge
     *
     * @param \DateTime $dateemarge
     *
     * @return ContratEmargementEntreprise
     */
    public function setDateemarge($dateemarge)
    {
        $this->dateemarge = $dateemarge;

        return $this;
    }

    /**
     * Get dateemarge
     *
     * @return \DateTime
     */
    public function getDateemarge()
    {
        return $this->dateemarge;
    }

    /**
     * Set quiemarge
     *
     * @param \App\Entity\User $quiemarge
     *
     * @return ContratEmargementEntreprise
     */
    public function setQuiemarge(\App\Entity\User $quiemarge = null)
    {
        $this->quiemarge = $quiemarge;

        return $this;
    }

    /**
     * Get quiemarge
     *
     * @return \App\Entity\User
     */
    public function getQuiemarge()
    {
        return $this->quiemarge;
    }

    /**
     * Set estpresent
     *
     * @param boolean $estpresent
     *
     * @return ContratEmargementEntreprise
     */
    public function setEstpresent($estpresent)
    {
        $this->estpresent = $estpresent;

        return $this;
    }

    /**
     * Get estpresent
     *
     * @return boolean
     */
    public function getEstpresent()
    {
        return $this->estpresent;
    }
	

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return ContratEmargementEntreprise
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
     * Set justificatif
     *
     * @param \App\Entity\SessionEmargementJustificatif $justificatif
     *
     * @return ContratEmargementEntreprise
     */
    public function setJustificatif(\App\Entity\SessionEmargementJustificatif $justificatif = null)
    {
        $this->justificatif = $justificatif;

        return $this;
    }

    /**
     * Get justificatif
     *
     * @return \App\Entity\SessionEmargementJustificatif
     */
    public function getJustificatif()
    {
        return $this->justificatif;
    }

    /**
     * Add motifabsence.
     *
     * @param \App\Entity\CodeAbsence $motifabsence
     *
     * @return ContratEmargementEntreprise
     */
    public function addMotifabsence(\App\Entity\CodeAbsence $motifabsence)
    {
        $this->motifabsences[] = $motifabsence;

        return $this;
    }

    /**
     * Remove motifabsence.
     *
     * @param \App\Entity\CodeAbsence $motifabsence
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMotifabsence(\App\Entity\CodeAbsence $motifabsence)
    {
        return $this->motifabsences->removeElement($motifabsence);
    }

    /**
     * Get motifabsences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifabsences()
    {
        return $this->motifabsences;
    }

    /**
     * Add motifretard.
     *
     * @param \App\Entity\CodeRetard $motifretard
     *
     * @return ContratEmargementEntreprise
     */
    public function addMotifretard(\App\Entity\CodeRetard $motifretard)
    {
        $this->motifretards[] = $motifretard;

        return $this;
    }

    /**
     * Remove motifretard.
     *
     * @param \App\Entity\CodeRetard $motifretard
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMotifretard(\App\Entity\CodeRetard $motifretard)
    {
        return $this->motifretards->removeElement($motifretard);
    }

    /**
     * Get motifretards.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifretards()
    {
        return $this->motifretards;
    }

    /**
     * Set retard.
     *
     * @param bool|null $retard
     *
     * @return ContratEmargementEntreprise
     */
    public function setRetard($retard = null)
    {
        $this->retard = $retard;

        return $this;
    }

    /**
     * Get retard.
     *
     * @return bool|null
     */
    public function getRetard()
    {
        return $this->retard;
    }

    /**
     * Set motifabsencecentre.
     *
     * @param \App\Entity\Masterlistelg|null $motifabsencecentre
     *
     * @return ContratEmargementEntreprise
     */
    public function setMotifabsencecentre(\App\Entity\Masterlistelg $motifabsencecentre = null)
    {
        $this->motifabsencecentre = $motifabsencecentre;

        return $this;
    }

    /**
     * Get motifabsencecentre.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMotifabsencecentre()
    {
        return $this->motifabsencecentre;
    }

    /**
     * Set motifretardcentre.
     *
     * @param \App\Entity\Masterlistelg|null $motifretardcentre
     *
     * @return ContratEmargementEntreprise
     */
    public function setMotifretardcentre(\App\Entity\Masterlistelg $motifretardcentre = null)
    {
        $this->motifretardcentre = $motifretardcentre;

        return $this;
    }

    /**
     * Get motifretardcentre.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMotifretardcentre()
    {
        return $this->motifretardcentre;
    }
}
