<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Cursus
 *
 * @ORM\Table(name="cursus")
 * @ORM\Entity(repositoryClass="App\Repository\CursusRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Cursus {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->selection = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cursuslgs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->matieres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->softskills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->softskilltextes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projetpros = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="cursuss")
     */
    private $personne;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $typepersonne;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="cursuss")
    */
    private $dossier;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typecursus;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Cursuslg", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $cursuslgs;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CursusSelection", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $selection;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CursusMatiere", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $matieres;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $dernierdiplome;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SoftSkill", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $softskills;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SoftSkillTexte", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $softskilltextes;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CursusProjetPro", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $projetpros;

    /**
     * @var boolean 
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $candidatrecontacte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $quandrecontacte;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $niveauetude;

    /**
     * @var boolean 
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $permisB;

    /**
     * @var boolean 
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vehicule;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $anneeexperience;

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
     * Set dernierdiplome.
     *
     * @param string|null $dernierdiplome
     *
     * @return Cursus
     */
    public function setDernierdiplome($dernierdiplome = null)
    {
        $this->dernierdiplome = $dernierdiplome;

        return $this;
    }

    /**
     * Get dernierdiplome.
     *
     * @return string|null
     */
    public function getDernierdiplome()
    {
        return $this->dernierdiplome;
    }

    /**
     * Set candidatrecontacte.
     *
     * @param bool|null $candidatrecontacte
     *
     * @return Cursus
     */
    public function setCandidatrecontacte($candidatrecontacte = null)
    {
        $this->candidatrecontacte = $candidatrecontacte;

        return $this;
    }

    /**
     * Get candidatrecontacte.
     *
     * @return bool|null
     */
    public function getCandidatrecontacte()
    {
        return $this->candidatrecontacte;
    }

    /**
     * Set quandrecontacte.
     *
     * @param \DateTime|null $quandrecontacte
     *
     * @return Cursus
     */
    public function setQuandrecontacte($quandrecontacte = null)
    {
        $this->quandrecontacte = $quandrecontacte;

        return $this;
    }

    /**
     * Get quandrecontacte.
     *
     * @return \DateTime|null
     */
    public function getQuandrecontacte()
    {
        return $this->quandrecontacte;
    }

    /**
     * Set permisB.
     *
     * @param bool|null $permisB
     *
     * @return Cursus
     */
    public function setPermisB($permisB = null)
    {
        $this->permisB = $permisB;

        return $this;
    }

    /**
     * Get permisB.
     *
     * @return bool|null
     */
    public function getPermisB()
    {
        return $this->permisB;
    }

    /**
     * Set vehicule.
     *
     * @param bool|null $vehicule
     *
     * @return Cursus
     */
    public function setVehicule($vehicule = null)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule.
     *
     * @return bool|null
     */
    public function getVehicule()
    {
        return $this->vehicule;
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
     * Set personne.
     *
     * @param \App\Entity\Personne|null $personne
     *
     * @return Cursus
     */
    public function setPersonne(\App\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne.
     *
     * @return \App\Entity\Personne|null
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set dossier.
     *
     * @param \App\Entity\Dossier|null $dossier
     *
     * @return Cursus
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier.
     *
     * @return \App\Entity\Dossier|null
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set typecursus.
     *
     * @param \App\Entity\Masterlistelg|null $typecursus
     *
     * @return Cursus
     */
    public function setTypecursus(\App\Entity\Masterlistelg $typecursus = null)
    {
        $this->typecursus = $typecursus;

        return $this;
    }

    /**
     * Get typecursus.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypecursus()
    {
        return $this->typecursus;
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
     * Add matiere.
     *
     * @param \App\Entity\CursusMatiere $matiere
     *
     * @return Cursus
     */
    public function addMatiere(\App\Entity\CursusMatiere $matiere)
    {
        $this->matieres[] = $matiere;

        return $this;
    }

    /**
     * Remove matiere.
     *
     * @param \App\Entity\CursusMatiere $matiere
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMatiere(\App\Entity\CursusMatiere $matiere)
    {
        return $this->matieres->removeElement($matiere);
    }

    /**
     * Get matieres.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatieres()
    {
        return $this->matieres;
    }

    /**
     * Add softskill.
     *
     * @param \App\Entity\SoftSkill $softskill
     *
     * @return Cursus
     */
    public function addSoftskill(\App\Entity\SoftSkill $softskill)
    {
        $this->softskills[] = $softskill;

        return $this;
    }

    /**
     * Remove softskill.
     *
     * @param \App\Entity\SoftSkill $softskill
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSoftskill(\App\Entity\SoftSkill $softskill)
    {
        return $this->softskills->removeElement($softskill);
    }

    /**
     * Get softskills.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoftskills()
    {
        return $this->softskills;
    }

    /**
     * Add softskilltexte.
     *
     * @param \App\Entity\SoftSkillTexte $softskilltexte
     *
     * @return Cursus
     */
    public function addSoftskilltexte(\App\Entity\SoftSkillTexte $softskilltexte)
    {
        $this->softskilltextes[] = $softskilltexte;

        return $this;
    }

    /**
     * Remove softskilltexte.
     *
     * @param \App\Entity\SoftSkillTexte $softskilltexte
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSoftskilltexte(\App\Entity\SoftSkillTexte $softskilltexte)
    {
        return $this->softskilltextes->removeElement($softskilltexte);
    }

    /**
     * Get softskilltextes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoftskilltextes()
    {
        return $this->softskilltextes;
    }

    /**
     * Add projetpro.
     *
     * @param \App\Entity\CursusProjetPro $projetpro
     *
     * @return Cursus
     */
    public function addProjetpro(\App\Entity\CursusProjetPro $projetpro)
    {
        $this->projetpros[] = $projetpro;

        return $this;
    }

    /**
     * Remove projetpro.
     *
     * @param \App\Entity\CursusProjetPro $projetpro
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProjetpro(\App\Entity\CursusProjetPro $projetpro)
    {
        return $this->projetpros->removeElement($projetpro);
    }

    /**
     * Get projetpros.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjetpros()
    {
        return $this->projetpros;
    }

    /**
     * Set niveauetude.
     *
     * @param \App\Entity\Masterlistelg|null $niveauetude
     *
     * @return Cursus
     */
    public function setNiveauetude(\App\Entity\Masterlistelg $niveauetude = null)
    {
        $this->niveauetude = $niveauetude;

        return $this;
    }

    /**
     * Get niveauetude.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getNiveauetude()
    {
        return $this->niveauetude;
    }

    /**
     * Set anneeexperience.
     *
     * @param \App\Entity\Masterlistelg|null $anneeexperience
     *
     * @return Cursus
     */
    public function setAnneeexperience(\App\Entity\Masterlistelg $anneeexperience = null)
    {
        $this->anneeexperience = $anneeexperience;

        return $this;
    }

    /**
     * Get anneeexperience.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getAnneeexperience()
    {
        return $this->anneeexperience;
    }

    /**
     * Add selection.
     *
     * @param \App\Entity\CursusSelection $selection
     *
     * @return Cursus
     */
    public function addSelection(\App\Entity\CursusSelection $selection)
    {
        $this->selection[] = $selection;
		$selection->setCursus($this);
        return $this;
    }

    /**
     * Remove selection.
     *
     * @param \App\Entity\CursusSelection $selection
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSelection(\App\Entity\CursusSelection $selection)
    {
        return $this->selection->removeElement($selection);
    }

    /**
     * Get selection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSelection()
    {
        return $this->selection;
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
     * Set typepersonne.
     *
     * @param string|null $typepersonne
     *
     * @return Cursus
     */
    public function setTypepersonne($typepersonne = null)
    {
        $this->typepersonne = $typepersonne;

        return $this;
    }

    /**
     * Get typepersonne.
     *
     * @return string|null
     */
    public function getTypepersonne()
    {
        return $this->typepersonne;
    }

    public function getSelectionCourant()
    {
        if(is_null($this->selection)){
            return null;
        }
        
        $courant=null;
        foreach($this->selection as $ligne){
            $courant=$ligne;
        }
        return $courant;
    }
}
