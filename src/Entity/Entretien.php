<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entretien
 *
 * @ORM\Table(name="entretien")
 * @ORM\Entity(repositoryClass="App\Repository\EntretienRepository")
 */
class Entretien {

    public function __construct() {
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->typeaccompagnements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @var \stdClass
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
     */
    private $examinateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy ="entretienformateurs")
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy ="entretien")
     */
    private $dossier;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut = false;

    
    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle")
     * @ORM\JoinColumn(name="salle", nullable=true)
     */
    private $salle;

    
    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="heurs", type="string", length=100, nullable=true)
     */
    private $heurs;


    /**
     * @var string
     *
     * @ORM\Column(name="autremetier", type="text", nullable=true)
     */
    private $autremetier;
    
    /**
     * @var string
     *
     * @ORM\Column(name="autresorganismes", type="text", nullable=true)
     */
    private $autresorganismes;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nbrexperiences", type="integer", nullable=true)
     */
    private $nbrexperiences;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nbrexperiencescontinue", type="integer", nullable=true)
     */
    private $nbrexperiencescontinue;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nbrexperiencesalternance", type="integer", nullable=true)
     */
    private $nbrexperiencesalternance;
    
    /**
     * @var int
     *
     * @ORM\Column(name="nbrexperiencesinitiale", type="integer", nullable=true)
     */
    private $nbrexperiencesinitiale;

    /**
     * @var int
     *
     * @ORM\Column(name="depuisquandformateur", type="integer", nullable=true)
     */
    private $depuisquandformateur;
    
    /**
     * @var int
     *
     * @ORM\Column(name="publicjeunes", type="integer", nullable=true)
     */
    private $publicjeunes;

    /**
     * @var int
     *
     * @ORM\Column(name="publicdemandeurs", type="integer", nullable=true)
     */
    private $publicdemandeurs;

    /**
     * @var int
     *
     * @ORM\Column(name="publicsalaries", type="integer", nullable=true)
     */
    private $publicsalaries;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="concevoirformation", type="boolean", nullable=true)
     */
    private $concevoirformation = false;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="participerpedagogiques", type="boolean")
     */
    private $participerpedagogiques = false;
    
     /**
     * @var bool
     *
     * @ORM\Column(name="orienterstagiaires", type="boolean")
     */
    private $orienterstagiaires = false;


    /**
     *  @ORM\ManyToMany(targetEntity="App\Entity\Theme", cascade={"persist"})
     */
    private $themes;

    /**
     *  @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeaccompagnements;

    /**
     * @var string
     *
     * @ORM\Column(name="competence", type="text", nullable=true)
     */
    private $competence;

    /**
     * @var string
     *
     * @ORM\Column(name="competecommentairesnce", type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @var boolean 
     *
     * @ORM\Column(name="virtuel", type="boolean", nullable=true)
     */
    private $virtuel;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Add theme
     *
     * @param \App\Entity\Theme $theme
     *
     * @return Formateur
     */
    public function addTheme(\App\Entity\Theme $theme)
    {
        $this->themes[] = $theme;
        return $this;
    }

    /**
     * Remove theme
     *
     * @param \App\Entity\Theme $theme
     */
    public function removeTheme(\App\Entity\Theme $theme)
    {
        $this->themes->removeElement($theme);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThemes()
    {
        return $this->themes;
    }


    /**
     * Add typeaccompagnement
     *
     * @param \App\Entity\Masterlistelg $typeaccompagnement
     *
     * @return Formateur
     */
    public function addTypeaccompagnement(\App\Entity\Masterlistelg $typeaccompagnement)
    {
        $this->typeaccompagnements[] = $typeaccompagnement;
        return $this;
    }

    /**
     * Remove typeaccompagnement
     *
     * @param \App\Entity\Masterlistelg $typeaccompagnement
     */
    public function removeTypeaccompagnement(\App\Entity\Masterlistelg $typeaccompagnement)
    {
        $this->typeaccompagnements->removeElement($typeaccompagnement);
    }

    /**
     * Get typeaccompagnements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeaccompagnements()
    {
        return $this->typeaccompagnements;
    }

    /**
     * Set date
     *
     * @param \Date $date
     *
     * @return Entretien
     */
    public function setDate($date) {
         
        $this->date =  $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \Date
     */
    public function getDate() {

          return $this->date;   

    }


    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Entretien
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Entretien
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
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Entretien
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }


    /**
     * Set examinateur
     *
     * @param \App\Entity\Employe $examinateur
     *
     * @return Entretien
     */
    public function setExaminateur(\App\Entity\Employe $examinateur = null)
    {
        $this->examinateur = $examinateur;

        return $this;
    }

    /**
     * Get examinateur
     *
     * @return \App\Entity\Employe
     */
    public function getExaminateur()
    {
        return $this->examinateur;
    }



    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Entretien
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return Entretien
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
     * Set heurs
     *
     * @param string $heurs
     *
     * @return Entretien
     */
    public function setHeurs($heurs)
    {
        $this->heurs = $heurs;

        return $this;
    }

    /**
     * Get heurs
     *
     * @return string
     */
    public function getHeurs()
    {
        return $this->heurs;
    }


    /**
     * Set autremetier
     *
     * @param string $autremetier
     *
     * @return Entretien
     */
    public function setAutremetier($autremetier)
    {
        $this->autremetier = $autremetier;

        return $this;
    }

    /**
     * Get autremetier
     *
     * @return string
     */
    public function getAutremetier()
    {
        return $this->autremetier;
    }


    /**
     * Set autresorganismes
     *
     * @param string $autresorganismes
     *
     * @return Entretien
     */
    public function setAutresorganismes($autresorganismes)
    {
        $this->autresorganismes = $autresorganismes;

        return $this;
    }

    /**
     * Get autresorganismes
     *
     * @return string
     */
    public function getAutresorganismes()
    {
        return $this->autresorganismes;
    }

    /**
     * Set nbrexperiences
     *
     * @param integer $nbrexperiences
     *
     * @return Entretien
     */
    public function setNbrexperiences($nbrexperiences)
    {
        $this->nbrexperiences = $nbrexperiences;

        return $this;
    }

    /**
     * Get nbrexperiences
     *
     * @return integer
     */
    public function getNbrexperiences()
    {
        return $this->nbrexperiences;
    }


    /**
     * Set depuisquandformateur
     *
     * @param integer $depuisquandformateur
     *
     * @return Entretien
     */
    public function setDepuisquandformateur($depuisquandformateur)
    {
        $this->depuisquandformateur = $depuisquandformateur;

        return $this;
    }

    /**
     * Get depuisquandformateur
     *
     * @return integer
     */
    public function getDepuisquandformateur()
    {
        return $this->depuisquandformateur;
    }

    /**
     * Set publicjeunes
     *
     * @param integer $publicjeunes
     *
     * @return Entretien
     */
    public function setPublicjeunes($publicjeunes)
    {
        $this->publicjeunes = $publicjeunes;

        return $this;
    }

    /**
     * Get publicjeunes
     *
     * @return integer
     */
    public function getPublicjeunes()
    {
        return $this->publicjeunes;
    }


    /**
     * Set publicdemandeurs
     *
     * @param integer $publicdemandeurs
     *
     * @return Entretien
     */
    public function setPublicdemandeurs($publicdemandeurs)
    {
        $this->publicdemandeurs = $publicdemandeurs;

        return $this;
    }

    /**
     * Get publicdemandeurs
     *
     * @return integer
     */
    public function getPublicdemandeurs()
    {
        return $this->publicdemandeurs;
    }


    /**
     * Set publicsalaries
     *
     * @param integer $publicsalaries
     *
     * @return Entretien
     */
    public function setPublicsalaries($publicsalaries)
    {
        $this->publicsalaries = $publicsalaries;

        return $this;
    }

    /**
     * Get publicsalaries
     *
     * @return integer
     */
    public function getPublicsalaries()
    {
        return $this->publicsalaries;
    }


    /**
     * Set concevoirformation
     *
     * @param boolean $concevoirformation
     *
     * @return Entretien
     */
    public function setConcevoirformation($concevoirformation)
    {
        $this->concevoirformation = $concevoirformation;

        return $this;
    }

    /**
     * Get concevoirformation
     *
     * @return boolean
     */
    public function getConcevoirformation()
    {
        return $this->concevoirformation;
    }



    /**
     * Set participerpedagogiques
     *
     * @param boolean $participerpedagogiques
     *
     * @return Entretien
     */
    public function setParticiperpedagogiques($participerpedagogiques)
    {
        $this->participerpedagogiques = $participerpedagogiques;

        return $this;
    }

    /**
     * Get participerpedagogiques
     *
     * @return boolean
     */
    public function getParticiperpedagogiques()
    {
        return $this->participerpedagogiques;
    }


    /**
     * Set orienterstagiaires
     *
     * @param boolean $orienterstagiaires
     *
     * @return Entretien
     */
    public function setOrienterstagiaires($orienterstagiaires)
    {
        $this->orienterstagiaires = $orienterstagiaires;

        return $this;
    }

    /**
     * Get orienterstagiaires
     *
     * @return boolean
     */
    public function getOrienterstagiaires()
    {
        return $this->orienterstagiaires;
    }


    /**
     * Set salle
     *
     * @param \App\Entity\Salle $salle
     *
     * @return Entretien
     */
    public function setSalle(\App\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return \App\Entity\Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }


    /**
     * Set competence
     *
     * @param string $competence
     *
     * @return Entretien
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return string
     */
    public function getCompetence()
    {
        return $this->competence;
    }


    /**
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Entretien
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }


    /**
     * Set virtuel
     *
     * @param boolean $virtuel
     *
     * @return Entretien
     */
    public function setVirtuel($virtuel) {
        $this->virtuel = $virtuel;

        return $this;
    }

    /**
     * Get virtuel
     *
     * @return boolean
     */
    public function getVirtuel() {
        return $this->virtuel;
    }

    public function getFullLieu()
    {
        if(! $this->virtuel and ! is_null($this->salle))
        return $this->salle->getIntitule().''.$this->salle->getSite()->getIntitule();
        return 'Entretien virtuel';
    }

    /**
     * Set nbrexperiencesinitiale
     *
     * @param integer $nbrexperiencesinitiale
     *
     * @return Entretien
     */
    public function setNbrexperiencesinitiale($nbrexperiencesinitiale)
    {
        $this->nbrexperiencesinitiale = $nbrexperiencesinitiale;

        return $this;
    }

    /**
     * Get nbrexperiencesinitiale
     *
     * @return integer
     */
    public function getNbrexperiencesinitiale()
    {
        return $this->nbrexperiencesinitiale+$this->getNbreAnnee();
    }

    /**
     * Set nbrexperiencesalternance
     *
     * @param integer $nbrexperiencesalternance
     *
     * @return Entretien
     */
    public function setNbrexperiencesalternance($nbrexperiencesalternance)
    {
        $this->nbrexperiencesalternance = $nbrexperiencesalternance;

        return $this;
    }

    /**
     * Get nbrexperiencesalternance
     *
     * @return integer
     */
    public function getNbrexperiencesalternance()
    {
        return $this->nbrexperiencesalternance+$this->getNbreAnnee();
    }

    /**
     * Set nbrexperiencescontinue
     *
     * @param integer $nbrexperiencescontinue
     *
     * @return Entretien
     */
    public function setNbrexperiencescontinue($nbrexperiencescontinue)
    {
        $this->nbrexperiencescontinue = $nbrexperiencescontinue;

        return $this;
    }

    /**
     * Get nbrexperiencescontinue
     *
     * @return integer
     */
    public function getNbrexperiencescontinue()
    {
        return $this->nbrexperiencescontinue+$this->getNbreAnnee();
    }

    public function getNbreAnnee()
    {
        if(is_null($this->date)) return 0;
        $anneeentretien= $this->date->format('Y');
        $now= new \DateTime('now');
        $anneeencours= $now->format('Y');
        return $anneeencours-$anneeentretien;
    }

}
