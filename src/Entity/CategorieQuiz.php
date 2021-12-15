<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CategorieQuiz
 *
 * @ORM\Table(name="quiz_categorie")
 * @ORM\Entity(repositoryClass="App\Repository\CategorieQuizRepository")
 */
class CategorieQuiz
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
     * @ORM\OneToMany(targetEntity="App\Entity\Quiz", mappedBy="categorie",cascade={"persist"})
     */
    private $quizs;

    /**
     * @var string
     *
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;
    
    /**
     * @var string
     *
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;


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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Categorie
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categorie
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Categorie
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
     * Constructor
     */
    public function __construct()
    {
        $this->quizs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add quiz
     *
     * @param \App\Entity\Quiz $quiz
     *
     * @return Categorie
     */
    public function addQuiz(\App\Entity\Quiz $quiz)
    {
        $this->quizs[] = $quiz;

        return $this;
    }

    /**
     * Remove quiz
     *
     * @param \App\Entity\Quiz $quiz
     */
    public function removeQuiz(\App\Entity\Quiz $quiz)
    {
        $this->quizs->removeElement($quiz);
    }

    /**
     * Get quizs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuizs()
    {
        return $this->quizs;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Categorie
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Categorie
     */
    public function setOrdre($ordre) {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre() {
        return $this->ordre;
    }
}
