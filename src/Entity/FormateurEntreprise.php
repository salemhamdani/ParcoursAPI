<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormateurEntreprise
 *
 * @ORM\Table(name="formateur_entreprise")
 * @ORM\Entity(repositoryClass="App\Repository\FormateurEntrepriseRepository")
 */
class FormateurEntreprise {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="formateurEntreprises")
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="formateurEntreprises")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations", cascade={"persist"})
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $receptiondocs;

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
     * Set formateur.
     *
     * @param \App\Entity\Formateur|null $formateur
     *
     * @return FormateurEntreprise
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur.
     *
     * @return \App\Entity\Formateur|null
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Set entreprise.
     *
     * @param \App\Entity\Entreprise|null $entreprise
     *
     * @return FormateurEntreprise
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise.
     *
     * @return \App\Entity\Entreprise|null
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set contact.
     *
     * @param \App\Entity\PersonalInformations|null $contact
     *
     * @return FormateurEntreprise
     */
    public function setContact(\App\Entity\PersonalInformations $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return \App\Entity\PersonalInformations|null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set receptiondocs.
     *
     * @param \App\Entity\Masterlistelg|null $receptiondocs
     *
     * @return FormateurEntreprise
     */
    public function setReceptiondocs(\App\Entity\Masterlistelg $receptiondocs = null)
    {
        $this->receptiondocs = $receptiondocs;

        return $this;
    }

    /**
     * Get receptiondocs.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getReceptiondocs()
    {
        return $this->receptiondocs;
    }
}
