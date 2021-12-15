<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu {

    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;
    

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=65, nullable=true)
     */
    private $label;

    /**
     * @var string
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="name", type="string", length=65, nullable=true, unique=true)
     */
    private $name;

      /**
     * @ORM\OneToMany(targetEntity="App\Entity\MenuContentPage", mappedBy="menu", cascade={"persist"})
     */
    private $menucontentpage;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate;

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
    private $rang=1;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $categorie;

    /**
     @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $type;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $diffusions;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Menu
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct() {

        $this->archive = false;
        $this->creationdate = new \DateTime();
        $this->diffusions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Menu
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
     * Set label
     *
     * @param string $label
     *
     * @return Menu
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }



  // Notez le pluriel, on récupère une liste de catégories ici !
  public function getContentpages()
  {
    return $this->contentpages;
  }
  /**
     * Set categorie
     *
     * @param \App\Entity\Masterlistelg $categorie
     *
     * @return Template
     */
    public function setCategorie(\App\Entity\Masterlistelg $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Menu
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
     * Add diffusion
     *
     * @param \App\Entity\Masterlistelg $evaluation
     *
     * @return Menu
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



    /**
     * Add menucontentpage
     *
     * @param \App\Entity\MenuContentPage $menucontentpage
     *
     * @return Menu
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

    /**
     * Get menucontentpage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenucontentpage()
    {
        return $this->menucontentpage;
    }
}
