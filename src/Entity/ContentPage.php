<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentPage
 *
 * @ORM\Table(name="content_page")
 * @ORM\Entity(repositoryClass="App\Repository\ContentPageRepository")
 */
class ContentPage
{   
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->creationdate = new \DateTime();
        $this->publication = true;
        $this->visible = true;
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
     * @ORM\OneToMany(targetEntity="PageSection", mappedBy="contentpage", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $pagesections;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ContentSeo" , inversedBy="contentpage" , cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="contentseo", nullable=true)
     */
    private $contentseo;


    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ContentSlider", cascade={"persist"},inversedBy="contentpages")
     * @ORM\JoinColumn(name="contentslider", nullable=true)
     */
    private $contentslider;   


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg",cascade={"persist"})
     */
    private $contenttemplate;   

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ContentPage", cascade={"persist"},inversedBy="child")
     * @ORM\JoinColumn(name="parent", nullable=true)
     */
    private $parent;

    /**
     * 
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\ContentPage", mappedBy="parent")
     */
    private $child;



    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string" , nullable=true, length=255, nullable=true)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean", nullable=true)
     */
    private $archive;


    /**
     * @var string
     *
     * @ORM\Column(name="titlepage", type="string", length=255, nullable=true)
     */
    private $titlepage;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string" , nullable=true, length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="shortdescription" , nullable=true, type="text")
     */
    private $shortdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="content", nullable=true, type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;

    /**
     * @var int
     *
     * @ORM\Column(name="layout", type="integer", nullable=true)
     */
    private $layout;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

    /**
     * @var bool
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="date")
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="date", nullable=true)
     */
    private $updatedate; 


    /**
     * @var string
     * 
     * @ORM\Column(name="index_entity_type", type="string", length=65, nullable=true)
     */
    private $indexEntityType;
    
     /**
     * @var int
     *
     * @ORM\Column(name="index_entity_id", type="integer", nullable=true)
     */
    private $indexEntityId;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="icon", type="string", length=65, nullable=true)
     */
    private $icon;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="color", type="string", length=65, nullable=true)
     */
    private $color;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="intitule_plus", type="string", length=65, nullable=true)
     */
    private $intitulePlus;
    


     /**
     * @ORM\OneToMany(targetEntity="App\Entity\MenuContentPage", mappedBy="contentpage", cascade={"persist"})
     */
    private $menucontentpage;

    /**
     @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typepage;

    

    /**
     * @var string
     *
     * @ORM\Column(name="colorheader", type="string" , nullable=true, length=255, nullable=true)
     */
    private $colorheader;
    /**
     * @var string
     *
     * @ORM\Column(name="colorleft", type="string" , nullable=true, length=255, nullable=true)
     */
    private $colorleft;
    /**
     * @var string
     *
     * @ORM\Column(name="colorcontent", type="string" , nullable=true, length=255, nullable=true)
     */
    private $colorcontent;
    /**
     * @var string
     *
     * @ORM\Column(name="colorfooter", type="string" , nullable=true, length=255, nullable=true)
     */
    private $colorfooter;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $diffusions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg",cascade={"persist"})
     */
    private $typeformation;   
    
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
     * Set indexEntityType
     *
     * @param string $indexEntityType
     *
     * @return ContentPage
     */
    public function setIndexEntityType($indexEntityType)
    {
        $this->indexEntityType = $indexEntityType;

        return $this;
    }

    /**
     * Get indexEntityType
     *
     * @return string
     */
    public function getIndexEntityType()
    {
        return $this->indexEntityType;
    }

    /**
     * Set indexEntityId
     *
     * @param integer $indexEntityId
     *
     * @return ContentPage
     */
    public function setIndexEntityId($indexEntityId)
    {
        $this->indexEntityId = $indexEntityId;

        return $this;
    }

    /**
     * Get indexEntityId
     *
     * @return integer
     */
    public function getIndexEntityId()
    {
        return $this->indexEntityId;
    }


     /**
     * Set parent 
     *
     * @param \App\Entity\ContentPage $parent
     *
     * @return parent
     */
    public function setParent(\App\Entity\ContentPage $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \App\Entity\ContentPage
     */
    public function getParent()
    {
        return $this->parent;
    }


    /**
     * Set contentseo
     *
     * @param \App\Entity\contentseo $contentseo
     *
     * @return ContentPage
     */
    public function setContentseo(\App\Entity\ContentSeo $contentseo = null) {
        $this->contentseo = $contentseo;

        return $this;
    }

    /**
     * Get contentseo
     *
     * @return \App\Entity\Seo
     */
    public function getContentseo() {
        return $this->contentseo;
    }



     /**
     * Set contentslider
     *
     * @param \App\Entity\ContentSlider $contentslider
     *
     * @return contentslider
     */
    public function setContentslider(\App\Entity\ContentSlider $contentslider = null)
    {
        $this->contentslider = $contentslider;

        return $this;
    }

    /**
     * Get contentslider
     *
     * @return \App\Entity\ContentSlider
     */
    public function getContentslider()
    {
        return $this->contentslider;
    }




     /**
     * Set contenttemplate
     *
     * @param \App\Entity\Masterlistelg $contenttemplate
     *
     * @return contenttemplate
     */
    public function setContenttemplate(\App\Entity\Masterlistelg $contenttemplate = null)
    {
        $this->contenttemplate = $contenttemplate;

        return $this;
    }

    /**
     * Get contenttemplate
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getContenttemplate()
    {
        return $this->contenttemplate;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return ContentPage
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
     * Set color
     *
     * @param string $color
     *
     * @return ContentPage
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }




    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return ContentPage
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }




    /**
     * Set intitulePlus
     *
     * @param string $intitulePlus
     *
     * @return ContentPage
     */
    public function setIntitulePlus($intitulePlus)
    {
        $this->intitulePlus = $intitulePlus;

        return $this;
    }

    /**
     * Get intitulePlus
     *
     * @return string
     */
    public function getIntitulePlus()
    {
        return $this->intitulePlus;
    }


    /**
     * Set type
     *
     * @param string $type
     *
     * @return ContentPage
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set titlepage
     *
     * @param string $titlepage
     *
     * @return ContentPage
     */
    public function setTitlepage($titlepage)
    {
        $this->titlepage = $titlepage;

        return $this;
    }

    /**
     * Get titlepage
     *
     * @return string
     */
    public function getTitlepage()
    {
        return $this->titlepage;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return ContentPage
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return ContentPage
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set shortdescription
     *
     * @param string $shortdescription
     *
     * @return ContentPage
     */
    public function setShortdescription($shortdescription)
    {
        $this->shortdescription = $shortdescription;

        return $this;
    }

    /**
     * Get shortdescription
     *
     * @return string
     */
    public function getShortdescription()
    {
        return $this->shortdescription;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return ContentPage
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
     * Set rang
     *
     * @param integer $rang
     *
     * @return ContentPage
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

    /**
     * Set layout
     *
     * @param integer $layout
     *
     * @return ContentPage
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return int
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return ContentPage
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return bool
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     *
     * @return ContentPage
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return bool
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return ContentPage
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
     * @return ContentPage
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
     * @return ContentPage
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
     * Get Child
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChild()
    {
        return $this->child;
    }




      public function getPagesections()
    {
        return $this->pagesections;
    }



      public function getMenuContentPage()
    {
        return $this->menucontentpage;
    }




  public function addPagesection(PageSection $pagesection)
  {
    $this->pagesections[] = $pagesection;

    return $this;
  }

  public function clearPagesections()
  {
    $this->pagesections->clear();
  }


    public function removePagesection(PageSection $pagesection)
    {
        if ($this->pagesections->contains($pagesection)) {
            $this->pagesections->removeElement($pagesection);
            $pagesection->setPage(null);
        }

        return $this;
    }

        public function getSections()
    {
        return array_map(
            function ($pagesection) {
                return $pagesection->getPagesection();
            },
            $this->pagesections->toArray()
        );
    }
 


    /**
     * Add child
     *
     * @param \App\Entity\ContentPage $child
     *
     * @return ContentPage
     */
    public function addChild(\App\Entity\ContentPage $child)
    {
        $this->child[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \App\Entity\ContentPage $child
     */
    public function removeChild(\App\Entity\ContentPage $child)
    {
        $this->child->removeElement($child);
    }

    /**
     * Set typepage
     *
     * @param \App\Entity\Masterlistelg $typepage
     *
     * @return ContentPage
     */
    public function setTypepage(\App\Entity\Masterlistelg $typepage = null)
    {
        $this->typepage = $typepage;

        return $this;
    }

    /**
     * Get typepage
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypepage()
    {
        return $this->typepage;
    }

    /**
     * Set typeformation
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return ContentPage
     */
    public function setTypeformation(\App\Entity\Masterlistelg $typeformation = null)
    {
        $this->typeformation = $typeformation;

        return $this;
    }

    /**
     * Get typeformation
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeformation()
    {
        return $this->typeformation;
    }

    
    /**
     * Set colorheader
     *
     * @param string $colorheader
     *
     * @return ContentPage
     */
    public function setColorheader($colorheader)
    {
        $this->colorheader = $colorheader;

        return $this;
    }

    /**
     * Get colorheader
     *
     * @return string
     */
    public function getColorheader()
    {
        return $this->colorheader;
    }


    /**
     * Set colorcontent
     *
     * @param string $colorcontent
     *
     * @return ContentPage
     */
    public function setColorcontent($colorcontent)
    {
        $this->colorcontent = $colorcontent;

        return $this;
    }

    /**
     * Get colorcontent
     *
     * @return string
     */
    public function getColorcontent()
    {
        return $this->colorcontent;
    }

    /**
     * Set colorleft
     *
     * @param string $colorleft
     *
     * @return ContentPage
     */
    public function setColorleft($colorleft)
    {
        $this->colorleft = $colorleft;

        return $this;
    }

    /**
     * Get colorleft
     *
     * @return string
     */
    public function getColorleft()
    {
        return $this->colorleft;
    }


    /**
     * Set colorfooter
     *
     * @param string $colorfooter
     *
     * @return ContentPage
     */
    public function setColorfooter($colorfooter)
    {
        $this->colorfooter = $colorfooter;

        return $this;
    }

    /**
     * Get colorheader
     *
     * @return string
     */
    public function getColorfooter()
    {
        return $this->colorfooter;
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
     * Add menucontentpage
     *
     * @param \App\Entity\MenuContentPage $menucontentpage
     *
     * @return ContentPage
     */
    public function addMenucontentpage(\App\Entity\MenuContentPage $menucontentpage)
    {
        $this->menucontentpage[] = $menucontentpage;

        return $this;
    }

    /**
     * Remove menucontentpage
     *
     * @param \App\Entity\MenuContentPage $menucontentpage
     */
    public function removeMenucontentpage(\App\Entity\MenuContentPage $menucontentpage)
    {
        $this->menucontentpage->removeElement($menucontentpage);
    }
}
