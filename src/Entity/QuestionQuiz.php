<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * QuestionQuiz
 *
 * @ORM\Table(name="question_quiz")
 * @ORM\Entity(repositoryClass="App\Repository\QuestionQuizRepository")
 * 
 */
class QuestionQuiz
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
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionGroupeQuiz", mappedBy="question")
     */
    private $questionGroupe;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeQuestion", inversedBy="questions",cascade={"persist"})
     * @ORM\JoinColumn(name="type_question_id", nullable=true, onDelete="CASCADE" )
     */
    private $type;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauQuiz", inversedBy="questions",cascade={"persist"})
     * @ORM\JoinColumn(name="niveau_id", nullable=true, onDelete="CASCADE" )
     */
    private $niveau;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousThemeQuiz", inversedBy="questions",cascade={"persist"})
     * @ORM\JoinColumn(name="soustheme_id", nullable=true, onDelete="CASCADE" )
     */
    private $soustheme;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ThemeQuiz", inversedBy="questions",cascade={"persist"})
     * @ORM\JoinColumn(name="theme_id", nullable=true, onDelete="CASCADE" )
     */
    private $theme;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReponseMultiple", mappedBy="question",cascade={"all"})
     */
    private $reponsesMultiples;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CandidatReponse", mappedBy="question",cascade={"all"})
     */
    private $candidatReponse;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\ReponseText", cascade={"persist"})
    */
    private $reponseText;

    /**
     * @var string
     * 
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="intitule", type="text")
     */
    private $intitule;
    
   /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $photo;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;
    
    
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
     * @return Question
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
     * Set code
     *
     * @param string $code
     *
     * @return Question
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Question
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
        $this->reponsesMultiples = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reponsesMultiple
     *
     * @param \App\Entity\ReponseMultiple $reponsesMultiple
     *
     * @return Question
     */
    public function addReponsesMultiple(\App\Entity\ReponseMultiple $reponsesMultiple)
    {
        $reponsesMultiple->setQuestion($this);
        $this->reponsesMultiples[] = $reponsesMultiple;

        return $this;
    }

    /**
     * Remove reponsesMultiple
     *
     * @param \App\Entity\ReponseMultiple $reponsesMultiple
     */
    public function removeReponsesMultiple(\App\Entity\ReponseMultiple $reponsesMultiple)
    {
        $this->reponsesMultiples->removeElement($reponsesMultiple);
    }

    /**
     * Get reponsesMultiples
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponsesMultiples()
    {
        return $this->reponsesMultiples;
    }

    /**
     * Set reponseText
     *
     * @param \App\Entity\ReponseText $reponseText
     *
     * @return Question
     */
    public function setReponseText(\App\Entity\ReponseText $reponseText = null)
    {
        $this->reponseText = $reponseText;

        return $this;
    }

    /**
     * Get reponseText
     *
     * @return \App\Entity\ReponseText
     */
    public function getReponseText()
    {
        return $this->reponseText;
    }

    /**
     * Set type
     *
     * @param \App\Entity\TypeQuestion $type
     *
     * @return Question
     */
    public function setType(\App\Entity\TypeQuestion $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\TypeQuestion
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Add candidatReponse
     *
     * @param \App\Entity\CandidatReponse $candidatReponse
     *
     * @return Question
     */
    public function addCandidatReponse(\App\Entity\CandidatReponse $candidatReponse)
    {
        $this->candidatReponse[] = $candidatReponse;

        return $this;
    }

    /**
     * Remove candidatReponse
     *
     * @param \App\Entity\CandidatReponse $candidatReponse
     */
    public function removeCandidatReponse(\App\Entity\CandidatReponse $candidatReponse)
    {
        $this->candidatReponse->removeElement($candidatReponse);
    }

    /**
     * Get candidatReponse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidatReponse()
    {
        return $this->candidatReponse;
    }
    

  

    /**
     * Set niveau
     *
     * @param \App\Entity\NiveauQuiz $niveau
     *
     * @return Question
     */
    public function setNiveau(\App\Entity\NiveauQuiz $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \App\Entity\NiveauQuiz
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Add questionGroupe
     *
     * @param \App\Entity\QuestionGroupeQuiz $questionGroupe
     *
     * @return Question
     */
    public function addQuestionGroupe(\App\Entity\QuestionGroupeQuiz $questionGroupe)
    {
        $this->questionGroupe[] = $questionGroupe;

        return $this;
    }

    /**
     * Remove questionGroupe
     *
     * @param \App\Entity\QuestionGroupeQuiz $questionGroupe
     */
    public function removeQuestionGroupe(\App\Entity\QuestionGroupeQuiz $questionGroupe)
    {
        $this->questionGroupe->removeElement($questionGroupe);
    }

    /**
     * Get questionGroupe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestionGroupe()
    {
        return $this->questionGroupe;
    }

    /**
     * Set photo
     * @param \App\Entity\Upload $photo
     * @return PersonalInformations
     */
    public function setPhoto(\App\Entity\Upload $photo = null)
    {
        $this->photo = $photo;
        $this->photo->setDirectoryUpload($this->getDirectoryUpload());
        return $this;
    }
    
    public function getDirectoryUpload()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo');
    }

    /**
     * Get photo
     *
     * @return \App\Entity\Upload
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set soustheme
     *
     * @param \App\Entity\SousThemeQuiz $soustheme
     *
     * @return Question
     */
    public function setSoustheme(\App\Entity\SousThemeQuiz $soustheme = null)
    {
        $this->soustheme = $soustheme;

        return $this;
    }

    /**
     * Get soustheme
     *
     * @return \App\Entity\SousThemeQuiz
     */
    public function getSoustheme()
    {
        return $this->soustheme;
    }

    /**
     * Set theme
     *
     * @param \App\Entity\ThemeQuiz $theme
     *
     * @return Question
     */
    public function setTheme(\App\Entity\ThemeQuiz $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \App\Entity\ThemeQuiz
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
