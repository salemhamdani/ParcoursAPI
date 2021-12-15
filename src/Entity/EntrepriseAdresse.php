<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File ;

 
/**
 * EntrepriseAdresse
 *
 * @ORM\Table(name="entreprise_adresse")
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseAdresseRepository")
 */
class EntrepriseAdresse
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="entrepriseadresses", cascade={"persist"})
     */
    private $entreprise;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist"})
     */
    private $adresse;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeadresse;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

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
     * Set entreprise
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return EntrepriseAdresse
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
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return EntrepriseAdresse
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
     * Set typeadresse
     *
     * @param \App\Entity\Masterlistelg $typeadresse
     *
     * @return EntrepriseAdresse
     */
    public function setTypeadresse(\App\Entity\Masterlistelg $typeadresse = null)
    {
        $this->typeadresse = $typeadresse;

        return $this;
    }

    /**
     * Get typeadresse
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeadresse()
    {
        return $this->typeadresse;
    }

    /**
     * Set siret.
     *
     * @param string|null $siret
     *
     * @return EntrepriseAdresse
     */
    public function setSiret($siret = null)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret.
     *
     * @return string|null
     */
    public function getSiret()
    {
        return $this->siret;
    }
}
