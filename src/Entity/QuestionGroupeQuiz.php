<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionGroupeQuiz
 *
 * @ORM\Table(name="question_groupe")
 * @ORM\Entity(repositoryClass="App\Repository\QuestionGroupeQuizRepository")
 */
class QuestionGroupeQuiz
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
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupeQuiz", inversedBy="questionGroupe" , cascade={"persist"})
     * @ORM\JoinColumn(name="groupe_id",referencedColumnName="id", nullable=true, onDelete="CASCADE" )
     */
    private $groupe;
    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionQuiz", inversedBy="questionGroupe" , cascade={"persist"})
     * @ORM\JoinColumn(name="question_id",referencedColumnName="id", nullable=true, onDelete="CASCADE" )
     */
    private $question;

    
     /**
     * @var int
     * 
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;
    
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return QuestionGroupe
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
     * Set groupe
     *
     * @param \App\Entity\Groupe $groupe
     *
     * @return QuestionGroupe
     */
    public function setGroupe(\App\Entity\GroupeQuiz $groupe = null)
    {
        $this->groupe = $groupe;
        $groupe->addQuestionGroupe($this);

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \App\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set question
     *
     * @param \App\Entity\QuestionQuiz $question
     *
     * @return QuestionGroupe
     */
    public function setQuestion(\App\Entity\QuestionQuiz $question = null)
    {
        $this->question = $question;
        $question->addQuestionGroupe($this);

        return $this;
    }

    /**
     * Get question
     *
     * @return \App\Entity\QuestionQuiz
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
