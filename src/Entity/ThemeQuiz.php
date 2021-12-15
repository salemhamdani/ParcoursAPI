<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ThemeQuiz
 *
 * @ORM\Table(name="quiz_question_theme")
 * @ORM\Entity(repositoryClass="App\Repository\ThemeQuizRepository")
 * @UniqueEntity(fields={"intitule"}, message="Ce thème existe déjà.")
 * @ORM\HasLifecycleCallbacks
 */
class ThemeQuiz {

    /**
     * @ORM\PrePersist
     */
    public function ajout() {
        $this->dateinscription = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification() {
        $this->datemodification = new \DateTime();
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
     * @ORM\OneToMany(targetEntity="App\Entity\SousThemeQuiz", mappedBy="theme",cascade={"all"})
     */
    private $sousthemes;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=250)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;


    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=7)
     * @Assert\Length(min=4, minMessage="La couleur doit être au format hexadécimal, et faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="La couleur est obligatoire, et doit être au format hexadécimal.")
     */
    private $couleur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinscription", type="datetime")
     */
    private $dateinscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    
	/**
	* @ORM\OneToMany(targetEntity="App\Entity\QuestionQuiz", mappedBy="theme")
	*/
	private $questions;

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
     * @return Theme
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
     * Set couleur
     *
     * @param string $intitule
     *
     * @return Theme
     */
    public function setCouleur($couleur) {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur() {
        return $this->couleur;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre() {
        return $this->ordre;
    }

    /**
     * Set ordre
     *
     * @param int $ordre
     *
     * @return Theme
     */
    public function setOrdre($ordre) {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Theme
     */
    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire() {
        return $this->commentaire;
    }

    /**
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return Theme
     */
    public function setDateinscription($dateinscription) {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get dateinscription
     *
     * @return \DateTime
     */
    public function getDateinscription() {
        return $this->dateinscription;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return Theme
     */
    public function setDatemodification($datemodification) {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification() {
        return $this->datemodification;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Theme
     */
    public function setArchive($archive) {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return bool
     */
    public function getArchive() {
        return $this->archive;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousthemes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add soustheme
     *
     * @param \App\Entity\SousThemeQuiz $soustheme
     *
     * @return Theme
     */
    public function addSoustheme(\App\Entity\SousThemeQuiz $soustheme)
    {
        $this->sousthemes[] = $soustheme;

        return $this;
    }

    /**
     * Remove soustheme
     *
     * @param \App\Entity\SousThemeQuiz $soustheme
     */
    public function removeSoustheme(\App\Entity\SousThemeQuiz $soustheme)
    {
        $this->sousthemes->removeElement($soustheme);
    }

    /**
     * Get sousthemes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousthemes()
    {
        return $this->sousthemes;
    }

    /**
     * Add question.
     *
     * @param \App\Entity\QuestionQuiz $question
     *
     * @return ThemeQuiz
     */
    public function addQuestion(\App\Entity\QuestionQuiz $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question.
     *
     * @param \App\Entity\QuestionQuiz $question
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeQuestion(\App\Entity\QuestionQuiz $question)
    {
        return $this->questions->removeElement($question);
    }

    /**
     * Get questions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
