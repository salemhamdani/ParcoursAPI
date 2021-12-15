<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Dossier
 *
 * @ORM\Table(name="rechercheforms")
 * @ORM\Entity(repositoryClass="App\Repository\RechercheFormRepository")
 */
class RechercheForm
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parcourss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dispositifs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vue;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=2, scale=0, nullable=true)
     */
    private $agemini;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=2, scale=0, nullable=true)
     */
    private $agemaxi;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
	* @ORM\JoinTable(name="recherche_referentpedagogiques")
    */
    private $referentpedagogiques;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
	* @ORM\JoinTable(name="recherche_referentcommercials")
    */
    private $referentcommercials;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
	* @ORM\JoinTable(name="recherche_referentadministratifs")
    */
    private $referentadministratifs;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
    * @ORM\JoinTable(name="recherche_referentcoachs")
    */
    private $referentcoachs;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Profil")
     */
    private $profils;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
	* @ORM\JoinTable(name="recherche_typeformations")
    */
    private $typeformations;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Parcours")
     */
    private $parcourss;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
	* @ORM\JoinTable(name="recherche_dispositifs")
    */
    private $dispositifs;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
	* @ORM\JoinTable(name="recherche_niveauetudes")
    */
    private $niveauetudes;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dossiergroupe;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe")
     */
    private $portailemployes;

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
     * Set vue.
     *
     * @param string|null $vue
     *
     * @return RechercheForm
     */
    public function setVue($vue = null)
    {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue.
     *
     * @return string|null
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * Set designation.
     *
     * @param string|null $designation
     *
     * @return RechercheForm
     */
    public function setDesignation($designation = null)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation.
     *
     * @return string|null
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set agemini.
     *
     * @param string|null $agemini
     *
     * @return RechercheForm
     */
    public function setAgemini($agemini = null)
    {
        $this->agemini = $agemini;

        return $this;
    }

    /**
     * Get agemini.
     *
     * @return string|null
     */
    public function getAgemini()
    {
        return $this->agemini;
    }

    /**
     * Set agemaxi.
     *
     * @param string|null $agemaxi
     *
     * @return RechercheForm
     */
    public function setAgemaxi($agemaxi = null)
    {
        $this->agemaxi = $agemaxi;

        return $this;
    }

    /**
     * Get agemaxi.
     *
     * @return string|null
     */
    public function getAgemaxi()
    {
        return $this->agemaxi;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return RechercheForm
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
     * @return RechercheForm
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
     * Set dossiergroupe.
     *
     * @param bool|null $dossiergroupe
     *
     * @return RechercheForm
     */
    public function setDossiergroupe($dossiergroupe = null)
    {
        $this->dossiergroupe = $dossiergroupe;

        return $this;
    }

    /**
     * Get dossiergroupe.
     *
     * @return bool|null
     */
    public function getDossiergroupe()
    {
        return $this->dossiergroupe;
    }

    /**
     * Add referentpedagogique.
     *
     * @param \App\Entity\Employe $referentpedagogique
     *
     * @return RechercheForm
     */
    public function addReferentpedagogique(\App\Entity\Employe $referentpedagogique)
    {
        $this->referentpedagogiques[] = $referentpedagogique;

        return $this;
    }

    /**
     * Remove referentpedagogique.
     *
     * @param \App\Entity\Employe $referentpedagogique
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReferentpedagogique(\App\Entity\Employe $referentpedagogique)
    {
        return $this->referentpedagogiques->removeElement($referentpedagogique);
    }

    /**
     * Get referentpedagogiques.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentpedagogiques()
    {
        return $this->referentpedagogiques;
    }

    /**
     * Add referentcommercial.
     *
     * @param \App\Entity\Employe $referentcommercial
     *
     * @return RechercheForm
     */
    public function addReferentcommercial(\App\Entity\Employe $referentcommercial)
    {
        $this->referentcommercials[] = $referentcommercial;

        return $this;
    }

    /**
     * Remove referentcommercial.
     *
     * @param \App\Entity\Employe $referentcommercial
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReferentcommercial(\App\Entity\Employe $referentcommercial)
    {
        return $this->referentcommercials->removeElement($referentcommercial);
    }

    /**
     * Get referentcommercials.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentcommercials()
    {
        return $this->referentcommercials;
    }

    /**
     * Add referentadministratif.
     *
     * @param \App\Entity\Employe $referentadministratif
     *
     * @return RechercheForm
     */
    public function addReferentadministratif(\App\Entity\Employe $referentadministratif)
    {
        $this->referentadministratifs[] = $referentadministratif;

        return $this;
    }

    /**
     * Remove referentadministratif.
     *
     * @param \App\Entity\Employe $referentadministratif
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReferentadministratif(\App\Entity\Employe $referentadministratif)
    {
        return $this->referentadministratifs->removeElement($referentadministratif);
    }

    /**
     * Get referentadministratifs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentadministratifs()
    {
        return $this->referentadministratifs;
    }



    /**
     * Add referentcoach.
     *
     * @param \App\Entity\Employe $referentcoach
     *
     * @return RechercheForm
     */
    public function addReferentcoach(\App\Entity\Employe $referentcoach)
    {
        $this->referentcoachs[] = $referentcoach;

        return $this;
    }

    /**
     * Remove referentcoach.
     *
     * @param \App\Entity\Employe $referentcoach
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReferentcoach(\App\Entity\Employe $referentcoach)
    {
        return $this->referentcoachs->removeElement($referentcoach);
    }

    /**
     * Get referentcoachs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentcoachs()
    {
        return $this->referentcoachs;
    }

    /**
     * Add profil.
     *
     * @param \App\Entity\Profil $profil
     *
     * @return RechercheForm
     */
    public function addProfil(\App\Entity\Profil $profil)
    {
        $this->profils[] = $profil;

        return $this;
    }

    /**
     * Remove profil.
     *
     * @param \App\Entity\Profil $profil
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProfil(\App\Entity\Profil $profil)
    {
        return $this->profils->removeElement($profil);
    }

    /**
     * Get profils.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfils()
    {
        return $this->profils;
    }

    /**
     * Add typeformation.
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return RechercheForm
     */
    public function addTypeformation(\App\Entity\Masterlistelg $typeformation)
    {
        $this->typeformations[] = $typeformation;

        return $this;
    }

    /**
     * Remove typeformation.
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTypeformation(\App\Entity\Masterlistelg $typeformation)
    {
        return $this->typeformations->removeElement($typeformation);
    }

    /**
     * Get typeformations.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeformations()
    {
        return $this->typeformations;
    }

    /**
     * Add parcourss.
     *
     * @param \App\Entity\Parcours $parcourss
     *
     * @return RechercheForm
     */
    public function addParcourss(\App\Entity\Parcours $parcourss)
    {
        $this->parcourss[] = $parcourss;

        return $this;
    }

    /**
     * Remove parcourss.
     *
     * @param \App\Entity\Parcours $parcourss
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeParcourss(\App\Entity\Parcours $parcourss)
    {
        return $this->parcourss->removeElement($parcourss);
    }

    /**
     * Get parcourss.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParcourss()
    {
        return $this->parcourss;
    }

    /**
     * Add dispositif.
     *
     * @param \App\Entity\Masterlistelg $dispositif
     *
     * @return RechercheForm
     */
    public function addDispositif(\App\Entity\Masterlistelg $dispositif)
    {
        $this->dispositifs[] = $dispositif;

        return $this;
    }

    /**
     * Remove dispositif.
     *
     * @param \App\Entity\Masterlistelg $dispositif
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDispositif(\App\Entity\Masterlistelg $dispositif)
    {
        return $this->dispositifs->removeElement($dispositif);
    }

    /**
     * Get dispositifs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDispositifs()
    {
        return $this->dispositifs;
    }

    /**
     * Add niveauetude.
     *
     * @param \App\Entity\Masterlistelg $niveauetude
     *
     * @return RechercheForm
     */
    public function addNiveauetude(\App\Entity\Masterlistelg $niveauetude)
    {
        $this->niveauetudes[] = $niveauetude;

        return $this;
    }

    /**
     * Remove niveauetude.
     *
     * @param \App\Entity\Masterlistelg $niveauetude
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNiveauetude(\App\Entity\Masterlistelg $niveauetude)
    {
        return $this->niveauetudes->removeElement($niveauetude);
    }

    /**
     * Get niveauetudes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveauetudes()
    {
        return $this->niveauetudes;
    }

    /**
     * Add portailemploye.
     *
     * @param \App\Entity\Employe $portailemploye
     *
     * @return RechercheForm
     */
    public function addPortailemploye(\App\Entity\Employe $portailemploye)
    {
        $this->portailemployes[] = $portailemploye;

        return $this;
    }

    /**
     * Remove portailemploye.
     *
     * @param \App\Entity\Employe $portailemploye
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePortailemploye(\App\Entity\Employe $portailemploye)
    {
        return $this->portailemployes->removeElement($portailemploye);
    }

    /**
     * Get portailemployes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortailemployes()
    {
        return $this->portailemployes;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return RechercheForm
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
     * @return RechercheForm
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
}
