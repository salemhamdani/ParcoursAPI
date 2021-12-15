<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File ;

 
/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
{
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->creationdate = new \DateTime();
        $this->publicationdate = new \DateTime();
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
     * @ORM\OneToMany(targetEntity="App\Entity\Image_blog", mappedBy="blog", cascade={"merge", "persist"}, orphanRemoval=true)
     */
    private $images;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg",cascade={"persist"})
     */
    private $category;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user")
     */
    private $user;

      /**
     * @ORM\Column(name="image", type="string", nullable=true)
     */
     private $image;

    /**
     * @var File
     *
     */
     private $file;


    private $files;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="shortdescription", type="text")
     */
    private $shortdescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicationdate", type="datetime", nullable=true)
     */
    private $publicationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="datetime", nullable=true)
     */
    private $updatedate;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang=0;


    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;
     
    /**
     * @var string
     *
     * @ORM\Column(name="altimage", type="string", length=255, nullable=true)
     */
    private $altimage;

    /**
     * @var string
     *
     * @ORM\Column(name="seotitle", type="string", length=255, nullable=true)
     */
    private $seotitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="text", nullable=true)
     */
    private $seodescription;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $diffusions;



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
     * @return Blog
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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Blog
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set title
     *
     * @param string $path
     *
     * @return Blog
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
     * Set image
     *
     * @param string $image
     *
     * @return Blog
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }





    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     *
     * @return Blog
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Blog
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set shortdescription
     *
     * @param string $shortdescription
     *
     * @return Blog
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Blog
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
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Blog
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
     * Set publicationdate
     *
     * @param \DateTime $publicationdate
     *
     * @return Blog
     */
    public function setPublicationdate($publicationdate)
    {
        $this->publicationdate = $publicationdate;

        return $this;
    }

    /**
     * Get publicationdate
     *
     * @return \DateTime
     */
    public function getPublicationdate()
    {
        return $this->publicationdate;
    }

    /**
     * Set updatedate
     *
     * @param \DateTime $updatedate
     *
     * @return Blog
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
     * Set rang
     *
     * @param integer $rang
     *
     * @return Blog
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
     * Set category
     *
     * @param \App\Entity\Masterlistelg $category
     *
     * @return Category
     */
    public function setCategory(\App\Entity\Masterlistelg $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return User
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
    * Set image Files
    *
    * @param String $files
    *
    * @return Blog
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


  public function clearImages()
  {
    $this->images->clear();
  }



     /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }




    /**
     * Add image
     *
     * @param \App\Entity\Image_blog $image
     *
     * @return Blog
     */
    public function addImage(\App\Entity\Image_blog $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \App\Entity\Image_blog $image
     */
    public function removeImage(\App\Entity\Image_blog $image)
    {
        $this->images->removeElement($image);
    }



    /**
     * Set link
     *
     * @param string $link
     *
     * @return Blog
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
     * Set seodescription
     *
     * @param string $seodescription
     *
     * @return Blog
     */
    public function setSeodescription($seodescription)
    {
        $this->seodescription = $seodescription;

        return $this;
    }

    /**
     * Get seodescription
     *
     * @return string
     */
    public function getSeodescription()
    {
        return $this->seodescription;
    }

    /**
     * Set seotitle
     *
     * @param string $seotitle
     *
     * @return Blog
     */
    public function setSeotitle($seotitle)
    {
        $this->seotitle = $seotitle;

        return $this;
    }

    /**
     * Get seotitle
     *
     * @return string
     */
    public function getSeotitle()
    {
        return $this->seotitle;
    }

    /**
     * Set altimage
     *
     * @param string $altimage
     *
     * @return Blog
     */
    public function setAltimage($altimage)
    {
        $this->altimage = $altimage;

        return $this;
    }

    /**
     * Get altimage
     *
     * @return string
     */
    public function getAltimage()
    {
        return $this->altimage;
    }


    /**
     * Add diffusion
     *
     * @param \App\Entity\Masterlistelg $evaluation
     *
     * @return Blog
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
    
}
