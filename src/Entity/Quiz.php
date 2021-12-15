<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 */
class Quiz {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieQuiz", inversedBy="quizs",cascade={"persist"})
     * @ORM\JoinColumn(name="categorie_id", nullable=true, onDelete="CASCADE" )
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupeQuiz", mappedBy="quiz",cascade={"all"})
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CandidatQuiz", mappedBy="quiz")
     */
    private $candidatQuiz;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * 
     * @ORM\Column(name="code", type="string", length=255, nullable=true, unique=false)
     */
    private $code;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="sommaire", type="text",nullable=true)
     */
    private $sommaire;

    /**
     * @var string
     *
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;

    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;
    /**
     * @var int
     *
     * @ORM\Column(name="nbr_questions", type="integer", nullable=true)
     */
    private $nbrQuestions = 0;
    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Quiz
     */
    public function setIntitule($intitule) {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule() {
        return $this->intitule;
    }

    /**
     * Set sommaire
     *
     * @param string $sommaire
     *
     * @return Question
     */
    public function setSommaire($sommaire)
    {
        $this->sommaire = $sommaire;

        return $this;
    }

    /**
     * Get sommaire
     *
     * @return string
     */
    public function getSommaire()
    {
        return $this->sommaire;
    }
    /**
     * Set code
     *
     * @param string $code
     *
     * @return Quiz
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Quiz
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Quiz
     */
    public function setArchive($archive) {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getArchive() {
        return $this->archive;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categorie
     *
     * @param \App\Entity\CategorieQuiz $categorie
     *
     * @return Quiz
     */
    public function setCategorie(\App\Entity\CategorieQuiz $categorie = null) {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \App\Entity\CategorieQuiz
     */
    public function getCategorie() {
        return $this->categorie;
    }

    /**
     * Add groupe
     *
     * @param \App\Entity\GroupeQuiz $groupe
     *
     * @return Quiz
     */
    public function addGroupe(\App\Entity\GroupeQuiz $groupe) {
        $groupe->setQuiz($this);
        $this->groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupe
     *
     * @param \App\Entity\GroupeQuiz $groupe
     */
    public function removeGroupe(\App\Entity\GroupeQuiz $groupe) {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupes() {
        return $this->groupes;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Quiz
     */
    public function setDuree($duree) {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree() {
        return $this->duree;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Quiz
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
    
    /**
     * Set nbrQuestions
     *
     * @param integer $nbrQuestions
     *
     * @return Quiz
     */
    public function setNbrQuestions($nbrQuestions) {
        $this->nbrQuestions = $nbrQuestions;

        return $this;
    }

    /**
     * Get nbrQuestions
     *
     * @return integer
     */
    public function getNbrQuestions() {
        return $this->nbrQuestions;
    }

    /**
     * Add candidatQuiz
     *
     * @param \App\Entity\CandidatQuiz $candidatQuiz
     *
     * @return Quiz
     */
    public function addCandidatQuiz(\App\Entity\CandidatQuiz $candidatQuiz) {
        $this->candidatQuiz[] = $candidatQuiz;

        return $this;
    }

    /**
     * Remove candidatQuiz
     *
     * @param \App\Entity\CandidatQuiz $candidatQuiz
     */
    public function removeCandidatQuiz(\App\Entity\CandidatQuiz $candidatQuiz) {
        $this->candidatQuiz->removeElement($candidatQuiz);
    }

    /**
     * Get candidatQuiz
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidatQuiz() {
        return $this->candidatQuiz;
    }

}
