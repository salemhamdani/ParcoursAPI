<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormateurModule
 *
 * @ORM\Table(name="formateur_module")
 * @ORM\Entity(repositoryClass="App\Repository\FormateurModuleRepository")
 */
class FormateurModule {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="formateurModules")
     * @ORM\JoinColumn(name="formateur_id", nullable=true, onDelete="CASCADE" )
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="formateurModule")
     * @ORM\JoinColumn(name="module_id", nullable=true, onDelete="CASCADE" )
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif", type="string", length=100, nullable=true)
     */
    private $tarif;

    /**
    * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
    */
    private $noteautoeval;

    /**
    * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
    */
    private $note;

    /**
    * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
    */
    private $noteparsession;


    /**
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return FormateurModule
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null) {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \App\Entity\Formateur
     */
    public function getFormateur() {
        return $this->formateur;
    }

    /**
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return FormateurModule
     */
    public function setModule(\App\Entity\Module $module = null) {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return FormateurModule
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set noteautoeval.
     *
     * @param string|null $noteautoeval
     *
     * @return FormateurModule
     */
    public function setNoteautoeval($noteautoeval = null)
    {
        $this->noteautoeval = $noteautoeval;

        return $this;
    }

    /**
     * Get noteautoeval.
     *
     * @return string|null
     */
    public function getNoteautoeval()
    {
        return $this->noteautoeval;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return FormateurModule
     */
    public function setNote($note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set noteparsession.
     *
     * @param string|null $noteparsession
     *
     * @return FormateurModule
     */
    public function setNoteparsession($noteparsession = null)
    {
        $this->noteparsession = $noteparsession;

        return $this;
    }

    /**
     * Get noteparsession.
     *
     * @return string|null
     */
    public function getNoteparsession()
    {
        return $this->noteparsession;
    }
}
