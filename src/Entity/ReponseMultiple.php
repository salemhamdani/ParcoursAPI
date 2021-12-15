<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReponseMultiple
 *
 * @ORM\Table(name="reponse_multiple")
 * @ORM\Entity(repositoryClass="App\Repository\ReponseMultipleRepository")
 */
class ReponseMultiple
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
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionQuiz", inversedBy="reponsesMultiples",cascade={"persist"})
     * @ORM\JoinColumn(name="question_id", nullable=true, onDelete="CASCADE" )
     */
    private $question;

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
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=true)
     */
    private $etat = false;


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
     * @return ReponseMultiple
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
     * @return ReponseMultiple
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
     * Set question
     *
     * @param \App\Entity\QuestionQuiz $question
     *
     * @return ReponseMultiple
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
     * Set etat
     *
     * @param boolean $etat
     *
     * @return ReponseMultiple
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return ReponseMultiple
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }
}
