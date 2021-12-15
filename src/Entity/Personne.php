<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Personne
 * 
 * @ORM\Table(name="personnes")
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 */
class Personne extends User
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dossiers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cursuss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->rgpd = false;
    }

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",  cascade={"persist"})
    */
    private $personalinformations;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\DossierInformations",  cascade={"all"})
    */
    private $dossierinformations;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\Tchat", cascade={"all"})
     */
    private $tchat;

    /**
     * @var bool
     *
     * @ORM\Column(name="rgpd", type="boolean", nullable=true)
     */
    private $rgpd = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CvFormation", mappedBy="personne",cascade={"persist"})
    */
    private $formations;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="personne",cascade={"persist"})
    */
    private $dossiers;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Dossier", cascade={"persist", "remove"})
    */
    private $dossiercourant;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\PersonneDocument", mappedBy="personne",cascade={"persist"})
    */
    private $documents;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Adresse",  cascade={"persist"})
    */
    private $adresse;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Cursus", mappedBy="personne",cascade={"persist"})
    */
    private $cursuss;

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
     * @Assert\Email(
     *     message = "ce email '{{ value }}' est non valide.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(name="email_pro", type="string", length=255, nullable=true)
     */
    private $emailPro;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailperso;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomSupplementaire", type="string", length=100, nullable=true)
     */
    private $prenomSupplementaire;
    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=100, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numsecusociale;

    /**
     * @var bool
     *
     * @ORM\Column(name="type_personne", type="boolean", nullable=true)
     */
    private $typePerso = false;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datergpd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="items", type="text",  nullable=true)
     */
    private $items;

    /**
     * Set crif
     *
     * @param boolean $rgpd
     *
     * @return Personne
     */
    public function setRgpd($rgpd)
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    /**
     * Get rgpd
     *
     * @return boolean
     */
    public function getRgpd()
    {
        return $this->rgpd;
    }


    /**
     * Set datergpd
     *
     * @param \DateTime $datergpd
     *
     * @return Personne
     */
    public function setDatergpd($datergpd)
    {
        $this->datergpd = $datergpd;

        return $this;
    }

    /**
     * Get datergpd
     *
     * @return \DateTime
     */
    public function getDatergpd()
    {
        return $this->datergpd;
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Personne
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
     * Set emailPro
     *
     * @param string $emailPro
     *
     * @return Personne
     */
    public function setEmailPro($emailPro)
    {
        $this->emailPro = $emailPro;

        return $this;
    }

    /**
     * Get emailPro
     *
     * @return string
     */
    public function getEmailPro()
    {
        return $this->emailPro;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Personne
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
     * @return Personne
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Personne
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
     * @return Personne
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
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Personne
     */
    public function setPersonalinformations(\App\Entity\PersonalInformations $personalinformations = null)
    {
        $this->personalinformations = $personalinformations;

        return $this;
    }

    /**
     * Get personalinformations
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getPersonalinformations()
    {
        return $this->personalinformations;
    }

    /**
     * Set prenomSupplementaire
     *
     * @param string $prenomSupplementaire
     *
     * @return Personne
     */
    public function setPrenomSupplementaire($prenomSupplementaire)
    {
        $this->prenomSupplementaire = $prenomSupplementaire;

        return $this;
    }

    /**
     * Get prenomSupplementaire
     *
     * @return string
     */
    public function getPrenomSupplementaire()
    {
        return $this->prenomSupplementaire;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Personne
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set typePerso
     *
     * @param boolean $typePerso
     *
     * @return Personne
     */
    public function setTypePerso($typePerso)
    {
        $this->typePerso = $typePerso;

        return $this;
    }

    /**
     * Get typePerso
     *
     * @return boolean
     */
    public function getTypePerso()
    {
        return $this->typePerso;
    }


    /**
     * Add dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Personne
     */
    public function addDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossiers[] = $dossier;
        $dossier->setPersonne($this);
        return $this;
    }

    /**
     * Remove dossier
     *
     * @param \App\Entity\Dossier $dossier
     */
    public function removeDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossiers->removeElement($dossier);
    }

    /**
     * Get dossiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossiers()
    {
        return $this->dossiers;
    }
    

    /**
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return Personne
     */
    public function setAdresse(\App\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tchat
     *
     * @param \App\Entity\Tchat $tchat
     *
     * @return Personne
     */
    public function setTchat(\App\Entity\Tchat $tchat = null)
    {
        $this->tchat = $tchat;

        return $this;
    }

    /**
     * Get tchat
     *
     * @return \App\Entity\Tchat
     */
    public function getTchat()
    {
        return $this->tchat;
    }

    /**
     * Add document
     *
     * @param \App\Entity\PersonneDocument $document
     *
     * @return Personne
     */
    public function addDocument(\App\Entity\PersonneDocument $document)
    {
        $this->documents[] = $document;
        $document->setPersonne($this);
        return $this;
    }

    /**
     * Remove document
     *
     * @param \App\Entity\PersonneDocument $document
     */
    public function removeDocument(\App\Entity\PersonneDocument $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }


    /**
     * Set dossiercourant
     *
     * @param \App\Entity\Dossier $dossiercourant
     *
     * @return Personne
     */
    public function setDossiercourant(\App\Entity\Dossier $dossiercourant = null)
    {
        $this->dossiercourant = $dossiercourant;

        return $this;
    }

    /**
     * Get dossiercourant
     *
     * @return \App\Entity\Dossier
     */
    public function getDossiercourant()
    {
        return $this->dossiercourant;
    }

    /**
     * Set dossierinformations
     *
     * @param \App\Entity\DossierInformations $dossierinformations
     *
     * @return Personne
     */
    public function setDossierinformations(\App\Entity\DossierInformations $dossierinformations = null)
    {
        $this->dossierinformations = $dossierinformations;

        return $this;
    }

    /**
     * Get dossierinformations
     *
     * @return \App\Entity\DossierInformations
     */
    public function getDossierinformations()
    {
        return $this->dossierinformations;
    }

    public function getPersonalInformationsCourant()
    {
        if(!is_null($this->getDossiercourant())){
            if(!is_null($this->getDossiercourant()->getPersonalInformations())){
                return $this->getDossiercourant()->getPersonalInformations();
            }
        }
        return $this->getPersonalInformations();
    }

    /**
     * Add formation
     *
     * @param \App\Entity\CvFormation $formation
     *
     * @return Personne
     */
    public function addFormation(\App\Entity\CvFormation $formation)
    {
        $this->formations[] = $formation;
        $formation->setPersonne($this);
        return $this;
    }

    /**
     * Remove formation
     *
     * @param \App\Entity\CvFormation $formation
     */
    public function removeFormation(\App\Entity\CvFormation $formation)
    {
        $this->dossiers->removeElement($formation);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormations()
    {
        return $this->formations;
    }
  

    /**
     * Add cursus.
     *
     * @param \App\Entity\Cursus $cursus
     *
     * @return Personne
     */
    public function addCursus(\App\Entity\Cursus $cursus)
    {
        $this->cursuss[] = $cursus;
        $cursus->setPersonne($this);
        return $this;
    }

    /**
     * Remove cursuss.
     *
     * @param \App\Entity\Cursus $cursus
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCursus(\App\Entity\Cursus $cursus)
    {
        return $this->cursuss->removeElement($cursus);
    }

    /**
     * Get cursuss.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursuss()
    {
        return $this->cursuss;
    }

    public function getCursusCourant()
    {
        if(is_null($this->cursuss)){
            return null;
        }
        
        $courant=null;
        foreach($this->cursuss as $ligne){
            $courant=$ligne;
        }
        return $courant;
    }

    /**
     * Set numsecusociale.
     *
     * @param string|null $numsecusociale
     *
     * @return Personne
     */
    public function setNumsecusociale($numsecusociale = null)
    {
        $this->numsecusociale = $numsecusociale;

        return $this;
    }

    /**
     * Get numsecusociale.
     *
     * @return string|null
     */
    public function getNumsecusociale()
    {
        return $this->numsecusociale;
    }


    /**
     * Set emailperso.
     *
     * @param string|null $emailperso
     *
     * @return Personne
     */
    public function setEmailperso($emailperso = null)
    {
        $this->emailperso = $emailperso;

        return $this;
    }

    /**
     * Get emailperso.
     *
     * @return string|null
     */
    public function getEmailperso()
    {
        return $this->emailperso;
    }

    /**
     * Add cursuss.
     *
     * @param \App\Entity\Cursus $cursuss
     *
     * @return Personne
     */
    public function addCursuss(\App\Entity\Cursus $cursuss)
    {
        $this->cursuss[] = $cursuss;

        return $this;
    }

    /**
     * Remove cursuss.
     *
     * @param \App\Entity\Cursus $cursuss
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCursuss(\App\Entity\Cursus $cursuss)
    {
        return $this->cursuss->removeElement($cursuss);
    }

        /**
     * @return array
     */
    public function getItems()
    {
        if ($this->items === null) {
            return [];
        }

        return json_decode($this->items, true);
    }

   
    public function addItem(string $intitule , string $urltemplate,$espace,$type)
    {   
        $exit=false;
        $items = $this->getItems();

                foreach ($items as $item) {
                    if($item['intitule']==$intitule and isset($item['espace']) and $item['espace']==$espace)$exit=true;
                } 

               if($exit==false) 
        $items[] = [
                'intitule' => $intitule,
                'urltemplate' => $urltemplate,
                'espace' => $espace,
                'type' => $type
                ];


        $this->items = json_encode($items);
        return $this;
    }
        public function removeItem(int $templateId)
    {
        $items = $this->getItems();
        if (array_key_exists($templateId, $items) === true) {
            unset($items[$templateId]);
        }
        $this->items = json_encode($items);

        return $this;
    }

    public function editItem(string $intitule , string $urltemplate)
    {
        $items = $this->getItems();

        if (array_key_exists($templateId, $items) === true) {
            $items[$productId]['urltemplate'] = $urltemplate;
            $items[$productId]['intitule'] = $intitule;
        }
        $this->items = json_encode($items);

        return $this;
    }

    
        public function removeItems()
    {
         $this->items = NULL;

        return $this;
    }

}
