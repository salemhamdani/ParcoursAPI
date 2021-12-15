<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */

class Contact
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entreprises = new \Doctrine\Common\Collections\ArrayCollection(); 
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Entreprise", mappedBy="contacts")
    */
    private $entreprises;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise")
    */
    private $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="ligneDirect", type="string", length=255, nullable=true)
     */
    private $ligneDirect;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Personne",cascade={"persist"})
    */
    private $personne;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\PersonalInformations",cascade={"persist"})
    */
    private $personalInformations;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $principal=false;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $cv;

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
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Contact
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Get entreprises
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntreprises()
    {
        return $this->entreprises;
    }

  

    /**
     * Set personalInformations
     *
     * @param \App\Entity\PersonalInformations $personalInformations
     *
     * @return Dossier
     */
    public function setPersonalInformations(\App\Entity\PersonalInformations $personalInformations = null)
    {
        $this->personalInformations = $personalInformations;
        return $this;
    }

    /**
     * Get personalInformations
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getPersonalInformations()
    {
        return $this->personalInformations;
    }


    /**
     * Set ligneDirect
     *
     * @param string $ligneDirect
     *
     * @return Contact
     */
    public function setLigneDirect($ligneDirect)
    {
        $this->ligneDirect = $ligneDirect;

        return $this;
    }

    /**
     * Get ligneDirect
     *
     * @return string
     */
    public function getLigneDirect()
    {
        return $this->ligneDirect;
    }

    

    /**
     * Set personne
     *
     * @param \App\Entity\Personne $personne
     *
     * @return Contact
     */
    public function setPersonne(\App\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \App\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }
    

    /**
     * Set entreprise
     *
     * @param \App\Entity\Entreprise $personne
     *
     * @return Contact
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \App\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }


    /**
     * Set principal
     *
     * @param boolean $principal
     *
     * @return Contact
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get principal
     *
     * @return bool
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Add entreprise.
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return Contact
     */
    public function addEntreprise(\App\Entity\Entreprise $entreprise)
    {
        $this->entreprises[] = $entreprise;

        return $this;
    }

    /**
     * Remove entreprise.
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEntreprise(\App\Entity\Entreprise $entreprise)
    {
        return $this->entreprises->removeElement($entreprise);
    }

    /**
     * Set cv.
     *
     * @param \App\Entity\Upload|null $cv
     *
     * @return Contact
     */
    public function setCv(\App\Entity\Upload $cv = null)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv.
     *
     * @return \App\Entity\Upload|null
     */
    public function getCv()
    {
        return $this->cv;
    }
}
