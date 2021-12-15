<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentSlider
 *
 * @ORM\Table(name="content_slider")
 * @ORM\Entity(repositoryClass="App\Repository\ContentSliderRepository")
 */
class ContentSlider
{
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;

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
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @ORM\OneToMany(targetEntity="ContentSlide", mappedBy="contentslider", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $contentslides;


    /**
     * @ORM\OneToMany(targetEntity="ContentPage", mappedBy="contentslider", cascade={"persist"})
     */
    private $contentpages;



    /**
     * @var File
     *
     */
     private $file;


    private $files;
    private $filesedit;


    /**
     * Constructor
     */
    public function __construct() {

        $this->archive = false;
        $this->creationdate = new \DateTime();
    }


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
     * Set title
     *
     * @param string $title
     *
     * @return ContentSlider
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
     * Set rang
     *
     * @param integer $rang
     *
     * @return ContentSlider
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
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return ContentSlider
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
     * @return ContentSlider
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
     * @return ContentSlider
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


        public function getContentSlides()
    {
        return $this->contentslides;
    }

  public function addContentSlide(ContentSlide $contentslide)
  {
    $this->contentslides[] = $contentslide;

    return $this;
  }

  public function clearContentSlides()
  {
    $this->contentslides->clear();
  }


    public function removeContentSlide(ContentSlide $contentslide)
    {
        if ($this->contentslides->contains($contentslide)) {
            $this->contentslides->removeElement($contentslide);
            $contentslide->setContentslider(null);
        }

        return $this;
    }


    
    

    /**
    * Set image Files
    *
    * @param String $files
    *
    * @return ContentSlider
    */
    public function setFiles($files = NULL)
    {
    $this->files = $files;

    return $this;
    }

    /**
    * Get image Files
    *
    * @return string
    */
    public function getFiles()
    {
    return $this->files;
    }
    

    /**
    * Set image Filesedit
    *
    * @param String $filesedit
    *
    * @return ContentSlider
    */
    public function setFilesedit($filesedit = NULL)
    {
    $this->filesedit = $filesedit;

    return $this;
    }

    /**
    * Get image Filesedit
    *
    * @return string
    */
    public function getFilesedit()
    {
    return $this->filesedit;
    }



    /**
     * Add contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     *
     * @return ContentSlider
     */
    public function addPage(\App\Entity\ContentPage $contentpage) {
        $this->contentpages[] = $contentpage;

        return $this;
    }

    /**
     * Remove contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     */
    public function removePage(\App\Entity\ContentPage $contentpage) {
        $this->contentpages->removeElement($contentpage);
    }

    /**
     * Get contentpages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentpages() {
        return $this->contentpages;
    }


    /**
     * Add contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     *
     * @return ContentSlider
     */
    public function addContentpage(\App\Entity\ContentPage $contentpage)
    {
        $this->contentpages[] = $contentpage;

        return $this;
    }

    /**
     * Remove contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     */
    public function removeContentpage(\App\Entity\ContentPage $contentpage)
    {
        $this->contentpages->removeElement($contentpage);
    }
}
