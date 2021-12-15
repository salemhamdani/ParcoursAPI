<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entrepriseavalider
 *
 * @ORM\Table(name="entrepriseavalider")
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseavaliderRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Entrepriseavalider
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
     * @ORM\Column(name="raisonSocial", type="string", length=255, nullable=true)
     */
    private $raisonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="qualitede", type="string", length=255, nullable=true)
     */
    private $qualitede;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="courriel", type="string", length=255, nullable=true)
     */
    private $courriel;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

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
    public function setRaisonSocial($raisonSocial) {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    /**
     * Get raisonSocial
     *
     * @return string
     */
    public function getRaisonSocial() {
        return $this->raisonSocial;
    }




    /**
     * @return Entrepriseavalider
     */
    public function setQualitede($qualitede) {
        $this->qualitede = $qualitede;

        return $this;
    }

    /**
     * Get qualitede
     *
     * @return string
     */
    public function getQualitede() {
        return $this->qualitede;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }


    /**
     * @return Entrepriseavalider
     */
    public function setTel($tel) {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel() {
        return $this->tel;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setCourriel($courriel) {
        $this->courriel = $courriel;

        return $this;
    }

    /**
     * Get courriel
     *
     * @return string
     */
    public function getCourriel() {
        return $this->courriel;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setSiret($siret) {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret() {
        return $this->siret;
    }

    /**
     * @return Entrepriseavalider
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
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
       