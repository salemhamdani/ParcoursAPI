<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File ;

 
/**
 * FinanceurAdresse
 *
 * @ORM\Table(name="financeur_adresse")
 * @ORM\Entity(repositoryClass="App\Repository\FinanceurAdresseRepository")
 */
class FinanceurAdresse
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Financeur", inversedBy="financeuradresses", cascade={"persist"})
     */
    private $financeur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist"})
     */
    private $adresse;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeadresse;

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
     * Set financeur
     *
     * @param \App\Entity\Financeur $financeur
     *
     * @return FinanceurAdresse
     */
    public function setFinanceur(\App\Entity\Financeur $financeur = null)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return FinanceurAdresse
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
     * @return FinanceurAdresse
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
}
