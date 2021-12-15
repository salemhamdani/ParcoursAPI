<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GroupeQuiz
 *
 * @ORM\Table(name="quiz_groupe")
 * @ORM\Entity(repositoryClass="App\Repository\GroupeQuizRepository")
 * 
 */
class GroupeQuiz
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Quiz", inversedBy="groupes")
    */
    private $quiz;
    
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionGroupeQuiz", mappedBy="groupe")
     */
    private $questionGroupe;
    
    
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
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;
    
    /**
     * @var int
     * 
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;
    
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
     * @return Groupe
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
     * @return Groupe
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
     * @return Groupe
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
     * Set quiz
     *
     * @param \App\Entity\Quiz $quiz
     *
     * @return Groupe
     */
    public function setQuiz(\App\Entity\Quiz $quiz = null)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return \App\Entity\Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
    

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Groupe
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questionGroupe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questionGroupe
     *
     * @param \App\Entity\QuestionGroupeQuiz $questionGroupe
     *
     * @return Groupe
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
}
