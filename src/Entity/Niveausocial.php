<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveausocial
 *
 * @ORM\Table(name="niveausocial")
 * @ORM\Entity(repositoryClass="App\Repository\NiveausocialRepository")
 */
class Niveausocial
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
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var bool
     *
     * @ORM\Column(name="isprospect", type="boolean")
     */
    private $isprospect;

    /**
     * @var string
     *
     * @ORM\Column(name="telFixe", type="string", length=255)
     */
    private $telFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="telMobile", type="string", length=255)
     */
    private $telMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="complementaires", type="text", nullable=true)
     */
    private $complementaires;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metierOccupe", type="string", length=255, nullable=true)
     */
    private $metierOccupe;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="heuresCPF", type="string", length=255)
     */
    private $heuresCPF;

    /**
     * @var \stdClass|null
     *
     * @ORM\Column(name="dossier", type="object", nullable=true)
     */
    private $dossier;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    private $civilite;


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
     * Set archive.
     *
     * @param bool $archive
     *
     * @return Niveausocial
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive.
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set isprospect.
     *
     * @param bool $isprospect
     *
     * @return Niveausocial
     */
    public function setIsprospect($isprospect)
    {
        $this->isprospect = $isprospect;

        return $this;
    }

    /**
     * Get isprospect.
     *
     * @return bool
     */
    public function getIsprospect()
    {
        return $this->isprospect;
    }

    /**
     * Set telFixe.
     *
     * @param string $telFixe
     *
     * @return Niveausocial
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telFixe.
     *
     * @return string
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set telMobile.
     *
     * @param string $telMobile
     *
     * @return Niveausocial
     */
    public function setTelMobile($telMobile)
    {
        $this->telMobile = $telMobile;

        return $this;
    }

    /**
     * Get telMobile.
     *
     * @return string
     */
    public function getTelMobile()
    {
        return $this->telMobile;
    }

    /**
     * Set nationalite.
     *
     * @param string $nationalite
     *
     * @return Niveausocial
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite.
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set commentaire.
     *
     * @param string|null $commentaire
     *
     * @return Niveausocial
     */
    public function setCommentaire($commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string|null
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set complementaires.
     *
     * @param string|null $complementaires
     *
     * @return Niveausocial
     */
    public function setComplementaires($complementaires = null)
    {
        $this->complementaires = $complementaires;

        return $this;
    }

    /**
     * Get complementaires.
     *
     * @return string|null
     */
    public function getComplementaires()
    {
        return $this->complementaires;
    }

    /**
     * Set metierOccupe.
     *
     * @param string|null $metierOccupe
     *
     * @return Niveausocial
     */
    public function setMetierOccupe($metierOccupe = null)
    {
        $this->metierOccupe = $metierOccupe;

        return $this;
    }

    /**
     * Get metierOccupe.
     *
     * @return string|null
     */
    public function getMetierOccupe()
    {
        return $this->metierOccupe;
    }

    /**
     * Set statut.
     *
     * @param string $statut
     *
     * @return Niveausocial
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set reference.
     *
     * @param string $reference
     *
     * @return Niveausocial
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set heuresCPF.
     *
     * @param string $heuresCPF
     *
     * @return Niveausocial
     */
    public function setHeuresCPF($heuresCPF)
    {
        $this->heuresCPF = $heuresCPF;

        return $this;
    }

    /**
     * Get heuresCPF.
     *
     * @return string
     */
    public function getHeuresCPF()
    {
        return $this->heuresCPF;
    }

    /**
     * Set dossier.
     *
     * @param \stdClass|null $dossier
     *
     * @return Niveausocial
     */
    public function setDossier($dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier.
     *
     * @return \stdClass|null
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set civilite.
     *
     * @param string $civilite
     *
     * @return Niveausocial
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite.
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }
}
