<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentSection
 *
 * @ORM\Table(name="content_section")
 * @ORM\Entity(repositoryClass="App\Repository\ContentSectionRepository")
 */
class ContentSection
{   
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->creationdate = new \DateTime();
        $this->chiffres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diffusions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\OneToMany(targetEntity="PageSection", mappedBy="contentsection", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $pagesections;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $contenttheme;

    /**
     * @var int
     *
     * @ORM\Column(name="agenda", type="integer", nullable=true)
     */
    private $selectEvent = null;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", cascade={"persist"})
     */
    private $menu;  
    
    /**
     @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $identification;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="date", nullable=true)
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="date", nullable=true)
     */
    private $updatedate;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=85, nullable=true)
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $type;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeinclude;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $diffusions;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeblocs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $evaluationprofil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $appreciationglobale;


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
     * Set contenttheme
     *
     * @param \App\Entity\Masterlistelg $contenttheme
     *
     * @return ContentTheme
     */
    public function setContenttheme(\App\Entity\Masterlistelg $contenttheme = null)
    {
        $this->contenttheme = $contenttheme;

        return $this;
    }

    /**
     * Get contenttheme
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getContenttheme()
    {
        return $this->contenttheme;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return ContentSection
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return ContentSection
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return ContentSection
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set updatedate
     *
     * @param \DateTime $updatedate
     *
     * @return ContentSection
     */
    public function setUpdatedate($updatedate)
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    /**
     * Get updatedate
     *
     * @return \DateTime
     */
    public function getUpdatedate()
    {
        return $this->updatedate;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return ContentSection
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set rang
     *
     * @param integer $rang
     *
     * @return ContentSection
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return int
     */
    public function getRang()
    {
        return $this->rang;
    }




      public function getPagesections() 
    {
        return $this->pagesections->toArray();
    }

    public function addPagesection(PageSection $pagesection)
    {
        if (!$this->pagesections->contains($pagesection)) {
            $this->pagesections->add($pagesection);
            $pagesection->setSection($this);
        }

        return $this;
    }

    public function removePagesection(PageSection $job)
    {
        if ($this->pagesections->contains($pagesection)) {
            $this->pagesections->removeElement($pagesection);
            $pagesection->setSection(null);
        }

        return $this;
    }

        public function getSections()
    {
        return array_map(
            function ($pagesection) {
                return $pagesection->getSection();
            },
            $this->pagesections->toArray()
        );
    }

    

    /**
     * Set selectEvent
     *
     * @param integer $selectEvent
     *
     * @return contentsection
     */
    public function setSelectEvent($selectEvent)
    {
        $this->selectEvent = $selectEvent;

        return $this;
    }

    /**
     * Get selectEvent
     *
     * @return integer
     */
    public function getSelectEvent()
    {
        return $this->selectEvent;
    }

    /**
     * Set modele
     *
     * @param integer $modele
     *
     * @return Section
     */
    public function setModele($modele) {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return integer
     */
    public function getModele() {
        return $this->modele;
    }


    /**
     * Add chiffre
     *
     * @param \App\Entity\Statistic $chiffre
     *
     * @return Contentsection
     */
    public function addChiffre(\App\Entity\Statistic $chiffre) {

        $this->chiffres[] = $chiffre;

        return $this;
    }

    /**
     * Remove chiffre
     *
     * @param \App\Statistic $chiffre
     */
    public function removeChiffre(\App\Entity\Statistic $chiffre) {
        $this->chiffres->removeElement($chiffre);
    }

    /**
     * Get chiffres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChiffres() {
        return $this->chiffres;
    }

    
   

    /**
     * Add diffusion
     *
     * @param \App\Entity\Masterlistelg $evaluation
     *
     * @return ContentPage
     */
    public function addDiffusion(\App\Entity\Masterlistelg $diffusion)
    {
        $this->diffusions[] = $diffusion;

        return $this;
    }

    /**
     * Remove diffusion
     *
     * @param \App\Entity\Masterlistelg $diffusion
     */
    public function removeDiffusion(\App\Entity\Masterlistelg $diffusion)
    {
        $this->diffusions->removeElement($diffusion);
    }

    /**
     * Get diffusions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiffusions()
    {
        return $this->diffusions;
    }


    public function getIddiffusions()
    {
        $ids = array();
         foreach ($this->diffusions as $diffusion) {
            $ids[]=$diffusion->getId();
         }
        return $ids;
    }


    /**
     * Set typeblocs
     *
     * @param \App\Entity\Masterlistelg $typeblocs
     *
     * @return Contentsection
     */
    public function setTypeblocs(\App\Entity\Masterlistelg $typeblocs = null)
    {
        $this->typeblocs = $typeblocs;

        return $this;
    }

    /**
     * Get typeblocs
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeblocs()
    {
        return $this->typeblocs;
    }


    /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Contentsection
     */
    public function setType(\App\Entity\Masterlistelg $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set menu
     *
     * @param \App\Entity\Menu $menu
     *
     * @return Contentsection
     */
    public function setMenu(\App\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \App\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set typeinclude
     *
     * @param \App\Entity\Masterlistelg $typeinclude
     *
     * @return Contentsection
     */
    public function setTypeinclude(\App\Entity\Masterlistelg $typeinclude = null)
    {
        $this->typeinclude = $typeinclude;

        return $this;
    }

    /**
     * Get typeinclude
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeinclude()
    {
        return $this->typeinclude;
    }

    /**
     * Set identification
     *
     * @param \App\Entity\Masterlistelg $identification
     *
     * @return Contentsection
     */
    public function setIdentification(\App\Entity\Masterlistelg $identification = null)
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * Get identification
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getIdentification()
    {
        return $this->identification;
    }
    

     /**
     * Set evaluationprofil
     *
     * @param \App\Entity\Masterlistelg $evaluationprofil
     *
     * @return Contentsection
     */
    public function setEvaluationprofil(\App\Entity\Masterlistelg $evaluationprofil = null)
    {
        $this->evaluationprofil = $evaluationprofil;

        return $this;
    }

    /**
     * Get evaluationprofil
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getEvaluationprofil()
    {
        return $this->evaluationprofil;
    }



     /**
     * Set appreciationglobale
     *
     * @param \App\Entity\Masterlistelg $appreciationglobale
     *
     * @return Contentsection
     */
    public function setAppreciationglobale(\App\Entity\Masterlistelg $appreciationglobale = null)
    {
        $this->appreciationglobale = $appreciationglobale;

        return $this;
    }

    /**
     * Get appreciationglobale
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getAppreciationglobale()
    {
        return $this->appreciationglobale;
    }
    
}
