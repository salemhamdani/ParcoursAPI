<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogue
 *
 * @ORM\Table(name="catalogue")
 * @ORM\Entity(repositoryClass="App\Repository\CatalogueRepository")
 */
class Catalogue
{     /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="frontoffice", type="boolean")
     */
    private $frontoffice;

    /**
     * @var bool
     *
     * @ORM\Column(name="edit", type="boolean")
     */
    private $edit;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="backoffice", type="boolean")
     */
    private $backoffice;


    /**
     * @var string
     *
     * @ORM\Column(name="dataform", type="text")
     */
    private $dataform;




    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user")
     */
    private $user;

    
    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Pdfcatalogue", cascade={"persist"})
     * @ORM\JoinColumn(name="pdffileseforme")
     */
    private $pdffileseforme;

    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Pdfcatalogue", cascade={"persist"})
     * @ORM\JoinColumn(name="pdfcontact")
     */
    private $pdfcontact;

    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Pdfcatalogue", cascade={"persist"})
     * @ORM\JoinColumn(name="pdffinacerformation")
     */
    private $pdffinacerformation;

    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Pdfcatalogue", cascade={"persist"})
     * @ORM\JoinColumn(name="pdfcontact")
     */
    private $pdffinal;
    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Pdfcatalogue", cascade={"persist"})
     * @ORM\JoinColumn(name="pdfgarde")
     */
    private $pdfgarde;
  


    /**
     * @var File
     *
     */
     private $fileseforme;

    /**
     * @var File
     *
     */
     private $filefinacerformation;

    /**
     * @var File
     *
     */
     private $filegarde;

    /**
     * @var File
     *
     */
     private $filefinal;

    /**
     * @var File
     *
     */
     private $filecontact;



    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", cascade={"persist"})
     * @ORM\JoinColumn(name="profil")
     */
    private $profil;



    /**
     * @var \stdClass
     *

     * @ORM\ManyToOne(targetEntity="App\Entity\ModeFormation", cascade={"persist"})
     * @ORM\JoinColumn(name="modeformation")
     */
    private $modeformation;


     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeformation;

     
    /**
     * @return File|null
     */
    public function getFileseforme()
    {
        return $this->fileseforme;
    }

    /**
     * @param File $fileseforme
     *
     * @return Pdffinacer_formation
     */
    public function setFileseforme($fileseforme)
    {
        $this->fileseforme = $fileseforme;

        return $this;
    }
     
    /**
     * @return File|null
     */
    public function getFilefinacerformation()
    {
        return $this->filefinacerformation;
    }

    /**
     * @param File $filefinacerformation
     *
     * @return Pdffinacer_formation
     */
    public function setFilefinacerformation($filefinacerformation)
    {
        $this->filefinacerformation = $filefinacerformation;

        return $this;
    }
     
    /**
     * @return File|null
     */
    public function getFilegarde()
    {
        return $this->filegarde;
    }

    /**
     * @param File $filegarde
     *
     * @return Pdffinacer_formation
     */
    public function setFilegarde($filegarde)
    {
        $this->filegarde = $filegarde;

        return $this;
    }
     
    /**
     * @return File|null
     */
    public function getFilefinal()
    {
        return $this->filefinal;
    }

    /**
     * @param File $filefinal
     *
     * @return Pdffinacer_formation
     */
    public function setFilefinal($filefinal)
    {
        $this->filefinal = $filefinal;

        return $this;
    }
     
    /**
     * @return File|null
     */
    public function getFilecontact()
    {
        return $this->filecontact;
    }

    /** 
    
     * @param File $filefinacerformation
     *
     * @return Pdfcontact
     */
    public function setFilecontact($filecontact)
    {
        $this->filecontact  = $filecontact;

        return $this;
    }


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
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return User
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }




    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Catalogue
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }





    /**
     * Set description
     *
     * @param string $description
     *
     * @return Catalogue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set label
     *
     * @param string $label
     *
     * @return Catalogue
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }


    /**
     * Set dataform
     *
     * @param string $dataform
     *
     * @return Catalogue
     */
    public function setDataform($dataform)
    {
        $this->dataform = $dataform;

        return $this;
    }

    /**
     * Get dataform
     *
     * @return string
     */
    public function getDataform()
    {
        return $this->dataform;
    }



    /**
     * Set pdfcontact
     *
     * @param \App\Entity\Pdfcatalogue $pdfcontact
     *
     * @return Pdfcontact
     */
    public function setPdfcontact(\App\Entity\Pdfcatalogue $pdfcontact = null)
    {
        $this->pdfcontact = $pdfcontact;

        return $this;
    }

    /**
     * Get pdfcontact
     *
     * @return \App\Entity\Pdfcatalogue
     */
    public function getPdfcontact()
    {
        return $this->pdfcontact;
    }


    /**
     * Set pdffinacerformation
     *
     * @param \App\Entity\Pdfcatalogue $pdffinacerformation
     *
     * @return Pdffinacerformation
     */
    public function setPdffinacerformation(\App\Entity\Pdfcatalogue $pdffinacerformation = null)
    {
        $this->pdffinacerformation = $pdffinacerformation;

        return $this;
    }

    /**
     * Get pdffinacerformation
     *
     * @return \App\Entity\Pdfcatalogue
     */
    public function getPdffinacerformation()
    {
        return $this->pdffinacerformation;
    }


    /**
     * Set pdffileseforme
     *
     * @param \App\Entity\Pdfcatalogue $pdffileseforme
     *
     * @return Pdffileseforme
     */
    public function setPdffileseforme(\App\Entity\Pdfcatalogue $pdffileseforme = null)
    {
        $this->pdffileseforme = $pdffileseforme;

        return $this;
    }

    /**
     * Get pdffileseforme
     *
     * @return \App\Entity\Pdfcatalogue
     */
    public function getPdffileseforme()
    {
        return $this->pdffileseforme;
    }


    /**
     * Set pdffinal
     *
     * @param \App\Entity\Pdfcatalogue $pdffinal
     *
     * @return pdfcontact
     */
    public function setPdffinal(\App\Entity\Pdfcatalogue $pdffinal = null)
    {
        $this->pdffinal = $pdffinal;

        return $this;
    }

    /**
     * Get pdffinal
     *
     * @return \App\Entity\Pdfcatalogue
     */
    public function getPdffinal()
    {
        return $this->pdffinal;
    }



    /**
     * Set pdfgarde
     *
     * @param \App\Entity\Pdfcatalogue $pdfgarde
     *
     * @return pdfcontact
     */
    public function setPdfgarde(\App\Entity\Pdfcatalogue $pdfgarde = null)
    {
        $this->pdfgarde = $pdfgarde;

        return $this;
    }

    /**
     * Get pdfgarde
     *
     * @return \App\Entity\Pdfcatalogue
     */
    public function getPdfgarde()
    {
        return $this->pdfgarde;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Catalogue
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }




      /**
     * Set edit
     *
     * @param boolean $edit
     *
     * @return Catalogue
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;

        return $this;
    }

    /**
     * Get edit
     *
     * @return bool
     */
    public function getEdit()
    {
        return $this->edit;
    }

      /**
     * Set backoffice
     *
     * @param boolean $backoffice
     *
     * @return Catalogue
     */
    public function setBackoffice($backoffice)
    {
        $this->backoffice = $backoffice;

        return $this;
    }

    /**
     * Get backoffice
     *
     * @return bool
     */
    public function getBackoffice()
    {
        return $this->backoffice;
    }

    /**
     * Set frontoffice
     *
     * @param boolean $frontoffice
     *
     * @return Catalogue
     */
    public function setFrontoffice($frontoffice)
    {
        $this->frontoffice = $frontoffice;

        return $this;
    }

    /**
     * Get frontoffice
     *
     * @return bool
     */
    public function getFrontoffice()
    {
        return $this->frontoffice;
    }



 /**
     * Set typeformation
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return Parcours
     */
    public function setTypeformation(\App\Entity\Masterlistelg $typeformation = null)
    {
        $this->typeformation = $typeformation;

        return $this;
    }

    /**
     * Get typeformation
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeformation()
    {
        return $this->typeformation;
    }



    /**
     * Set modeformation
     *
     * @param \App\Entity\ModeFormation $modeformation
     *
     * @return Catalogue
     */
    public function setModeformation(\App\Entity\ModeFormation $modeformation = null)
    {
        $this->modeformation = $modeformation;

        return $this;
    }

    /**
     * Get modeformation
     *
     * @return \App\Entity\ModeFormation
     */
    public function getModeformation()
    {
        return $this->modeformation;
    }




    /**
     * Set profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return Catalogue
     */
    public function setProfil(\App\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \App\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }

}
