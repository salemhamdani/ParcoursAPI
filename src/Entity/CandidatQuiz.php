<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CandidatQuiz
 *
 * @ORM\Table(name="candidat_quiz")
 * @ORM\Entity(repositoryClass="App\Repository\CandidatQuizRepository")
 */
class CandidatQuiz
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Quiz", inversedBy="candidatQuiz")
     * @ORM\JoinColumn(name="quiz_id", nullable=true )
     */
    private $quiz;


    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidat", inversedBy="candidatQuiz")
     * @ORM\JoinColumn(name="candidat_id", nullable=true, onDelete="CASCADE" )
     */
    private $candidat;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CandidatReponse", mappedBy="candidatQuiz", cascade={"persist"})
     */
    private $candidatReponse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="resultat", type="integer", nullable=true)
     */
    private $resultat;

        /**
     * @var bool
     *
     * @ORM\Column(name="posted", type="boolean")
     */
    private $posted = false;

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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return CandidatQuiz
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return CandidatQuiz
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set resultat
     *
     * @param integer $resultat
     *
     * @return CandidatQuiz
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return int
     */
    public function getResultat()
    {
        return $this->resultat;
    }



    /**
     * Set quiz
     *
     * @param \App\Entity\Quiz $quiz
     *
     * @return CandidatQuiz
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
     * Set candidat
     *
     * @param \App\Entity\Candidat $candidat
     *
     * @return CandidatQuiz
     */
    public function setCandidat(\App\Entity\Candidat $candidat = null)
    {
        $this->candidat = $candidat;
        

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \App\Entity\Candidat
     */
    public function getCandidat()
    {
        return $this->candidat;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->candidatReponse = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add candidatReponse
     *
     * @param \App\Entity\CandidatReponse $candidatReponse
     *
     * @return CandidatQuiz
     */
    public function addCandidatReponse(\App\Entity\CandidatReponse $candidatReponse)
    {
        $candidatReponse->setCandidatQuiz($this);
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CandidatQuiz
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set posted
     *
     * @param boolean $posted
     *
     * @return CandidatQuiz
     */
    public function setPosted($posted)
    {
        $this->posted = $posted;

        return $this;
    }

    /**
     * Get posted
     *
     * @return boolean
     */
    public function getPosted()
    {
        return $this->posted;
    }




}
