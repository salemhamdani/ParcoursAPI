<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * liste
 *
 * @ORM\Table(name="masterlistes")
 * @ORM\Entity(repositoryClass="App\Repository\MasterlisteRepository")
 */
class Masterliste
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->masterlistelgs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(type="string", length=20, unique=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=100)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=true)
     */
    private $designation;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\Masterlistelg", mappedBy="masterliste", orphanRemoval=true, cascade={"all"})
	*/
	private $masterlistelgs;

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
     * Set module
     *
     * @param string $module
     * @return masterliste
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return masterliste
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return masterliste
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add masterlistelg
     *
     * @param \App\Entity\Masterlistelg $masterlistelg
     *
     * @return Masterliste
     */
    public function addMasterlistelg(\App\Entity\Masterlistelg $masterlistelg)
    {
        $this->masterlistelgs[] = $masterlistelg;
		$masterlistelg->setMasterliste($this);
        return $this;
    }

    /**
     * Remove masterlistelg
     *
     * @param \App\Entity\Masterlistelg $masterlistelg
     */
    public function removeMasterlistelg(\App\Entity\Masterlistelg $masterlistelg)
    {
        $this->masterlistelgs->removeElement($masterlistelg);
    }

    /**
     * Get masterlistelgs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMasterlistelgs()
    {
        return $this->masterlistelgs;
    }
}
