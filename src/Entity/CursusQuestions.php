<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursusQuestions
 *
 * @ORM\Table(name="cursus_questions")
 * @ORM\Entity(repositoryClass="App\Repository\CursusQuestionsRepository")
 */
class CursusQuestions
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
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var bool
     *
     * @ORM\Column(name="evaluation", type="boolean", nullable=true)
     */
    private $evaluation;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $type;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $categorie;

    /**
     * @var int
     *
     * @ORM\Column(name="ordretitre", type="integer", nullable=true)
     */
    private $ordretitre;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CursusSelection", mappedBy="cursus", orphanRemoval=true, cascade={"all"})
    */
    private $selection;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $diffusions;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule.
     *
     * @param string $intitule
     *
     * @return CursusQuestions
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule.
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set evaluation.
     *
     * @param bool $evaluation
     *
     * @return CursusQuestions
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation.
     *
     * @return bool
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set ordretitre.
     *
     * @param int $ordretitre
     *
     * @return CursusQuestions
     */
    public function setOrdretitre($ordretitre)
    {
        $this->ordretitre = $ordretitre;

        return $this;
    }

    /**
     * Get ordretitre.
     *
     * @return int
     */
    public function getOrdretitre()
    {
        return $this->ordretitre;
    }


    /**
     * Set categorie.
     *
     * @param \App\Entity\Masterlistelg|null $categorie
     *
     * @return CursusQuestions
     */
    public function setCategorie(\App\Entity\Masterlistelg $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set type.
     *
     * @param \App\Entity\Masterlistelg|null $type
     *
     * @return CursusQuestions
     */
    public function setType(\App\Entity\Masterlistelg $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add diffusion
     *
     * @param \App\Entity\Masterlistelg $diffusion
     *
     * @return CursusQuestions
     */
    public function addDiffusion(\App\Entity\Masterlistelg $diffusion)
    {
        $this->diffusions[] = $diffusion;

        return $this;
    }

    /**
     * Remove diffusion
     *
     * @param \App\Entity\Masterlistelg $diffusion
     */
    public function removeDiffusion(\App\Entity\Masterlistelg $diffusion)
    {
        $this->diffusions->removeElement($diffusion);
    }

    /**
     * Get diffusions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiffusions()
    {
        return $this->diffusions;
    }
    
}
