<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TypeQuestion
 *
 * @ORM\Table(name="type_question")
 * @ORM\Entity(repositoryClass="App\Repository\TypeQuestionRepository")
 * @UniqueEntity(
 *     fields={"code"},
 *     message="ce code est existant"
 * )
 */
class TypeQuestion
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
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionQuiz", mappedBy="type",cascade={"all"})
     */
    private $questions;

    /**
     * @var string
     *
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="intitule", type="string", length=255, unique=true)
     */
    private $intitule;
    
    /**
     * @var string
     * 
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;


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
     * @return TypeQuestion
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
     * @return TypeQuestion
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

    /**
     * Set code
     *
     * @param string $code
     *
     * @return TypeQuestion
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
}
