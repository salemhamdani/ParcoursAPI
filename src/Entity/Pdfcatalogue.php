<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pdfgarde
 *
 * @ORM\Table(name="pdfcatalogue")
 * @ORM\Entity(repositoryClass="App\Repository\PdfcatalogueRepository")
 */
class Pdfcatalogue
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
     * @ORM\Column(name="pdf", type="string", length=255)
     */
    private $pdf;

    /**
     * @var File
     *
     */
     private $file;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $categorie;

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
     * Set pdf
     *
     * @param string $pdf
     *
     * @return Pdfcatalogue
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set categorie
     *
     * @param \App\Entity\Masterlistelg $categorie
     *
     * @return Pdfcatalogue
     */
    public function setCategorie(\App\Entity\Masterlistelg $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

}
