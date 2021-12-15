<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * TarifVenteTheme
 *
 * @ORM\Table(name="tarifVenteTheme")
 * @ORM\Entity(repositoryClass="App\Repository\TarifVenteThemeRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class TarifVenteTheme
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignes = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="tarifsvente",cascade={"persist"})
    */
    private $theme;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="tarifsvente",cascade={"persist"})
    */
    private $module;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\TarifVenteTheme")
    */
    private $tarifdefaut;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $tarifjour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\OneToMany(targetEntity="TarifVenteThemeLg", mappedBy="tarifventetheme", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $lignes;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;
    
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
     * Set tarifjour
     *
     * @param boolean $tarifjour
     *
     * @return TarifVenteTheme
     */
    public function setTarifjour($tarifjour)
    {
        $this->tarifjour = $tarifjour;

        return $this;
    }

    /**
     * Get tarifjour
     *
     * @return boolean
     */
    public function getTarifjour()
    {
        return $this->tarifjour;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return TarifVenteTheme
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
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return TarifVenteTheme
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return TarifVenteTheme
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return TarifVenteTheme
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
     * @return TarifVenteTheme
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
     * Set theme
     *
     * @param \App\Entity\Theme $theme
     *
     * @return TarifVenteTheme
     */
    public function setTheme(\App\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \App\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return TarifVenteTheme
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
     * @return TarifVenteTheme
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
     * Add ligne
     *
     * @param \App\Entity\TarifVenteThemeLg $ligne
     *
     * @return TarifVenteTheme
     */
    public function addLigne(\App\Entity\TarifVenteThemeLg $ligne)
    {
        $this->lignes[] = $ligne;
		$ligne->setTarifventetheme($this);
        return $this;
    }

    /**
     * Remove ligne
     *
     * @param \App\Entity\TarifVenteThemeLg $ligne
     */
    public function removeLigne(\App\Entity\TarifVenteThemeLg $ligne)
    {
        $this->lignes->removeElement($ligne);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignes()
    {
        return $this->lignes;
    }

    /**
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return TarifVenteTheme
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set tarifdefaut
     *
     * @param \App\Entity\TarifVenteTheme $tarifdefaut
     *
     * @return TarifVenteTheme
     */
    public function setTarifdefaut(\App\Entity\TarifVenteTheme $tarifdefaut = null)
    {
        $this->tarifdefaut = $tarifdefaut;

        return $this;
    }

    /**
     * Get tarifdefaut
     *
     * @return \App\Entity\TarifVenteTheme
     */
    public function getTarifdefaut()
    {
        return $this->tarifdefaut;
    }

	public function getLignemax($tarifjour)
	{
		$lignemax=null;
		$valeurmax=0;
		foreach($this->getLignes() as $ligne)
		{
			if($ligne->getTarifjour()==$tarifjour){
				if($ligne->getValeurmin()>=$valeurmax){
					$valeurmax=$ligne->getValeurmin();
					$lignemax=$ligne;
				}
			}
		}
		return $lignemax;
	}

	public function getTarifForValue($combien)
	{
		$lignemax=$this->getLignemax($this->getTarifjour());

		if($this->getTarifjour()==true)
		{
			$lignemax=$this->getLignemax(true);
			foreach($this->getLignes() as $ligne)
			{
				if($ligne->getTarifjour()==true && $ligne->getValeurmin()==$combien){
					return $ligne;
				}
			}
			return $lignemax;
		}else{
			$lignemax=$this->getLignemax(false);
			foreach($this->getLignes() as $ligne)
			{
				if($ligne->getTarifjour()==false && $ligne->getValeurmin()<=$combien && $ligne->getValeurmax()>=$combien){
					return $ligne;
				}
			}
			return $lignemax;
		}
		$lignemax=$this->getLignemax($this->getTarifjour());
		return $lignemax;
	}

	public function getMontantForValue($combien)
	{
		$montant=0;
		$nb=1;
		if($this->getTarifjour()==true)
		{
			foreach($this->getLignes() as $ligne)
			{
				if($ligne->getTarifjour()==true){
					if($nb<=$combien){
						if($ligne->getValeurmin()==$nb){
							$montant+=$ligne->getTarif();
							$nb++;
						}
					}
				}
			}
			return $montant;
		}else{
			$lignemax=$this->getLignemax(false);
			foreach($this->getLignes() as $ligne)
			{
				if($ligne->getTarifjour()==false && $ligne->getValeurmin()<=$combien && $ligne->getValeurmax()>=$combien){
					return $ligne;
				}
			}
			return $lignemax;
		}
		$lignemax=$this->getLignemax($this->getTarifjour());
		return $lignemax;
	}

}
