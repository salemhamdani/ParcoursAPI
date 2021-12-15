<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CandidatReponse
 *
 * @ORM\Table(name="candidat_reponse")
 * @ORM\Entity(repositoryClass="App\Repository\CandidatReponseRepository")
 */
class CandidatReponse
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
     * @ORM\ManyToOne(targetEntity="App\Entity\CandidatQuiz", inversedBy="candidatReponse")
     * @ORM\JoinColumn(name="candidat_quiz_id", nullable=true, onDelete="CASCADE" )
     */
    private $candidatQuiz;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionQuiz", inversedBy="candidatReponse")
     * @ORM\JoinColumn(name="question_id", nullable=true, onDelete="CASCADE" )
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="reponseText", type="text", nullable=true)
     */
    private $reponseText;

    /**
     * @var int
     *
     * @ORM\Column(name="reponseChoix", type="integer", nullable=true)
     */
    private $reponseChoix;


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
     * Set reponseText
     *
     * @param string $reponseText
     *
     * @return CandidatReponse
     */
    public function setReponseText($reponseText)
    {
        $this->reponseText = $reponseText;

        return $this;
    }

    /**
     * Get reponseText
     *
     * @return string
     */
    public function getReponseText()
    {
        return $this->reponseText;
    }


    /**
     * Set candidatQuiz
     *
     * @param \App\Entity\CandidatQuiz $candidatQuiz
     *
     * @return CandidatReponse
     */
    public function setCandidatQuiz(\App\Entity\CandidatQuiz $candidatQuiz = null)
    {
        $this->candidatQuiz = $candidatQuiz;

        return $this;
    }

    /**
     * Get candidatQuiz
     *
     * @return \App\Entity\CandidatQuiz
     */
    public function getCandidatQuiz()
    {
        return $this->candidatQuiz;
    }

    /**
     * Set question
     *
     * @param \App\Entity\QuestionQuiz $question
     *
     * @return CandidatReponse
     */
    public function setQuestion(\App\Entity\QuestionQuiz $question = null)
    {
        $this->question = $question;

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

    /**
     * Set reponseChoix
     *
     * @param integer $reponseChoix
     *
     * @return CandidatReponse
     */
    public function setReponseChoix($reponseChoix)
    {
        $this->reponseChoix = $reponseChoix;

        return $this;
    }

    /**
     * Get reponseChoix
     *
     * @return integer
     */
    public function getReponseChoix()
    {
        return $this->reponseChoix;
    }
}
