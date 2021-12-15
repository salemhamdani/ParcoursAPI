<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tuteuravalider
 *
 * @ORM\Table(name="tuteuravalider")
 * @ORM\Entity(repositoryClass="App\Repository\TuteuravaliderRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Tuteuravalider
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
     * @ORM\Column(name="nomtutulaire", type="string", length=255, nullable=true)
     */
    private $nomtutulaire;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomtutulaire", type="string", length=255, nullable=true)
     */
    private $prenomtutulaire;

    /**
     * @var string
     *
     * @ORM\Column(name="fonctiontutulaire", type="string", length=255, nullable=true)
     */
    private $fonctiontutulaire;

    /**
     * @var string
     *
     * @ORM\Column(name="teltutulaire", type="string", length=255, nullable=true)
     */
    private $teltutulaire;

    /**
     * @var string
     *
     * @ORM\Column(name="emailtutulaire", type="string", length=255, nullable=true)
     */
    private $emailtutulaire;

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
     * @return Entrepriseavalider
     */
    public function setNomtutulaire($nomtutulaire) {
        $this->nomtutulaire = $nomtutulaire;

        return $this;
    }

    /**
     * Get nomtutulaire
     *
     * @return string
     */
    public function getNomtutulaire() {
        return $this->nomtutulaire;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setPrenomtutulaire($prenomtutulaire) {
        $this->prenomtutulaire = $prenomtutulaire;

        return $this;
    }

    /**
     * Get prenomtutulaire
     *
     * @return string
     */
    public function getPrenomtutulaire() {
        return $this->prenomtutulaire;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setFonctiontutulaire($fonctiontutulaire) {
        $this->fonctiontutulaire = $fonctiontutulaire;

        return $this;
    }

    /**
     * Get fonctiontutulaire
     *
     * @return string
     */
    public function getFonctiontutulaire() {
        return $this->fonctiontutulaire;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setTeltutulaire($teltutulaire) {
        $this->teltutulaire = $teltutulaire;

        return $this;
    }

    /**
     * Get teltutulaire
     *
     * @return string
     */
    public function getTeltutulaire() {
        return $this->teltutulaire;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setEmailtutulaire($emailtutulaire) {
        $this->emailtutulaire = $emailtutulaire;

        return $this;
    }

    /**
     * Get emailtutulaire
     *
     * @return string
     */
    public function getEmailtutulaire() {
        return $this->emailtutulaire;
    }




}
       