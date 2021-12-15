<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousThemeTheme
 *
 * @ORM\Table(name="sous_theme_theme")
 * @ORM\Entity(repositoryClass="App\Repository\SousThemeThemeRepository")
 */
class SousThemeTheme
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->archive = false;
        $this->module = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousTheme", inversedBy="sousthemetheme", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $soustheme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="sousthemetheme", cascade={"persist"})
     * @ORM\JoinColumn()
     */
    private $theme;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Module", mappedBy="sousthemetheme")
     */
    private $module;

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return SousThemeTheme
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
     * @return SousThemeTheme
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
     * @return SousThemeTheme
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return SousThemeTheme
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SousThemeTheme
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
     * @return SousThemeTheme
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
     * Set soustheme
     *
     * @param \App\Entity\SousTheme $soustheme
     *
     * @return SousThemeTheme
     */
    public function setSoustheme(\App\Entity\SousTheme $soustheme = null)
    {
        $this->soustheme = $soustheme;

        return $this;
    }

    /**
     * Get soustheme
     *
     * @return \App\Entity\SousTheme
     */
    public function getSoustheme()
    {
        return $this->soustheme;
    }

    /**
     * Set theme
     *
     * @param \App\Entity\Theme $theme
     *
     * @return SousThemeTheme
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
     * Add module
     *
     * @param \App\Entity\Module $module
     *
     * @return SousThemeTheme
     */
    public function addModule(\App\Entity\Module $module)
    {
        $this->module[] = $module;
		$module->setSousThemeTheme($this);
        return $this;
    }

    /**
     * Remove module
     *
     * @param \App\Entity\Module $module
     */
    public function removeModule(\App\Entity\Module $module)
    {
        $this->module->removeElement($module);
    }

    /**
     * Get module
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModule()
    {
        return $this->module;
    }
}
