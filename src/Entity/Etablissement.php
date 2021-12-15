<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity(repositoryClass="App\Repository\EtablissementRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Etablissement
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Ce champ est obligatoire.")
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Adresse",  cascade={"persist"})
    */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numecole;

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
     * Set numecole
     *
     * @param string $numecole
     *
     * @return Societe
     */
    public function setNumecole($numecole)
    {
        $this->numecole = $numecole;

        return $this;
    }

    /**
     * Get numecole
     *
     * @return string
     */
    public function getNumecole()
    {
        return $this->numecole;
    }


 
    /**
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return Etablissement
     */
    public function setAdresse(\App\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Etablissement
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Etablissement
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

   
}
