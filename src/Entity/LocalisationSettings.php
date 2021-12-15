<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocalisationSettings
 *
 * @ORM\Table(name="localisation_settings")
 * @ORM\Entity()
 */
class LocalisationSettings {

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
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=65, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=65, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=65, nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=65, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=65, nullable=true)
     */
    private $codePostal;

    /**
     * @var float
     *
     * @ORM\Column(name="lattitude", type="float", nullable=true)
     */
    private $lattitude;

    /**
     * @var int
     *
     * @ORM\Column(name="zoom", type="integer", nullable=true)
     */
    private $zoom;

    /**
     * @var float
     *
     * @ORM\Column(name="longtitude", type="float", nullable=true)
     */
    private $longtitude;

    /**
     * @var bool
     *
     * @ORM\Column(name="annexe", type="boolean")
     */
    private $annexe;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=65, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="streetNumber", type="string", length=65, nullable=true)
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

   /**
     * @var string
     *
     * @ORM\Column(name="transport", type="text")
     */
    private $transport;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return LocalisationSettings
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
     * Set ville
     *
     * @param string $ville
     *
     * @return LocalisationSettings
     */
    public function setVille($ville) {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return LocalisationSettings
     */
    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal() {
        return $this->codePostal;
    }

    /**
     * Set zoom
     *
     * @param integer $zoom
     *
     * @return LocalisationSettings
     */
    public function setZoom($zoom) {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get zoom
     *
     * @return integer
     */
    public function getZoom() {
        return $this->zoom;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return LocalisationSettings
     */
    public function setPays($pays) {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays() {
        return $this->pays;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return LocalisationSettings
     */
    public function setEtat($etat) {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat() {
        return $this->etat;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return LocalisationSettings
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     *
     * @return LocalisationSettings
     */
    public function setStreetNumber($streetNumber) {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string
     */
    public function getStreetNumber() {
        return $this->streetNumber;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return LocalisationSettings
     */
    public function setStreet($street) {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set lattitude
     *
     * @param float $lattitude
     *
     * @return LocalisationSettings
     */
    public function setLattitude($lattitude) {
        $this->lattitude = $lattitude;

        return $this;
    }

    /**
     * Get lattitude
     *
     * @return float
     */
    public function getLattitude() {
        return $this->lattitude;
    }

    /**
     * Set longtitude
     *
     * @param float $longtitude
     *
     * @return LocalisationSettings
     */
    public function setLongtitude($longtitude) {
        $this->longtitude = $longtitude;

        return $this;
    }

    /**
     * Get longtitude
     *
     * @return float
     */
    public function getLongtitude() {
        return $this->longtitude;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return LocalisationSettings
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set transport
     *
     * @param string $transport
     *
     * @return LocalisationSettings
     */
    public function setTransport($transport) {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return string
     */
    public function getTransport() {
        return $this->transport;
    }


    /**
     * Set annexe
     *
     * @param boolean $annexe
     *
     * @return Blog
     */
    public function setAnnexe($annexe)
    {
        $this->annexe = $annexe;

        return $this;
    }

    /**
     * Get annexe
     *
     * @return bool
     */
    public function getAnnexe()
    {
        return $this->annexe;
    }


}
