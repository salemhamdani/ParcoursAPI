<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NiveauQuiz
 *
 * @ORM\Table(name="quiz_question_niveau")
 * @ORM\Entity(repositoryClass="App\Repository\NiveauQuizRepository")
 * @ORM\HasLifecycleCallbacks
 */
class NiveauQuiz
{
    /**
     * @ORM\PrePersist
     */
    public function ajout()
    {
        $this->dateinscription = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
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
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionQuiz", mappedBy="niveau",cascade={"persist"})
     */
    private $questions;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=250)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;

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
     * @return Niveau
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
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return Niveau
     */
    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get dateinscription
     *
     * @return \DateTime
     */
    public function getDateinscription()
    {
        return $this->dateinscription;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return Niveau
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Niveau
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
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question
     *
     * @param \App\Entity\QuestionQuiz $question
     *
     * @return Niveau
     */
    public function addQuestion(\App\Entity\QuestionQuiz $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \App\Entity\QuestionQuiz $question
     */
    public function removeQuestion(\App\Entity\QuestionQuiz $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
