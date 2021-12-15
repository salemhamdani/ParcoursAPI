<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Motclegraphique
 *
 * @ORM\Table(name="motclegraphique")
 * @ORM\Entity(repositoryClass="App\Repository\MotclegraphiqueRepository")
 */
class Motclegraphique
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
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;
    

    /**
     * @var string
     *
     * @ORM\Column(name="view", type="string", length=255, nullable=true)
     */
    private $view;
    

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    private $color;
    

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=255, nullable=true)
     */
    private $size;
    

    /**
     * @var string
     *
     * @ORM\Column(name="rapport", type="string", length=255, nullable=true)
     */
    private $rapport;
    

    /**
     * @var string
     *
     * @ORM\Column(name="police", type="string", length=255, nullable=true)
     */
    private $police;
    

    /**
     * @var bold
     *
     * @ORM\Column(name="bold", type="string", length=255, nullable=true)
     */
    private $bold;
   
   
     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $motcle;


    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;
    /**
     * @var int
     *
     * @ORM\Column(name="xpos", type="integer")
     */
    private $xpos = 0;
    /**
     * @var int
     *
     * @ORM\Column(name="page", type="integer")
     */
    private $page = 1;
    /**
     * @var int
     *
     * @ORM\Column(name="ypos", type="integer")
     */
    private $ypos = 0;



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
     * Set type
     *
     * @param string $type
     *
     * @return Motclegraphique
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set view
     *
     * @param string $view
     *
     * @return Motclegraphique
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Motclegraphique
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
	
	
   
    /**
     * Set xpos
     *
     * @param integer $xpos
     *
     * @return Motclegraphique
     */
    public function setXpos($xpos)
    {
        $this->xpos = $xpos;

        return $this;
    }

    /**
     * Get xpos
     *
     * @return integer
     */
    public function getXpos()
    {
        return $this->xpos;
    }

    /**
     * Set page
     *
     * @param integer $page
     *
     * @return Motclegraphique
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set ypos
     *
     * @param integer $ypos
     *
     * @return Motclegraphique
     */
    public function setYpos($ypos)
    {
        $this->ypos = $ypos;

        return $this;
    }

    /**
     * Get ypos
     *
     * @return integer
     */
    public function getYpos()
    {
        return $this->ypos;
    }

    /**
     * Set rapport
     *
     * @param integer $rapport
     *
     * @return Motclegraphique
     */
    public function setRapport($rapport)
    {
        $this->rapport = $rapport;

        return $this;
    }

    /**
     * Get rapport
     *
     * @return integer
     */
    public function getRapport()
    {
        return $this->rapport;
    }

    /**
     * Set police
     *
     * @param integer $police
     *
     * @return Motclegraphique
     */
    public function setPolice($police)
    {
        $this->police = $police;

        return $this;
    }

    /**
     * Get police
     *
     * @return integer
     */
    public function getPolice()
    {
        return $this->police;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return Motclegraphique
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }
 
    /**
     * Set color
     *
     * @param integer $color
     *
     * @return Motclegraphique
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return integer
     */
    public function getColor()
    {
        return $this->color;
    }
 
    /**
     * Set bold
     *
     * @param integer $bold
     *
     * @return Motclegraphique
     */
    public function setBold($bold)
    {
        $this->bold = $bold;

        return $this;
    }

    /**
     * Get bold
     *
     * @return integer
     */
    public function getBold()
    {
        return $this->bold;
    }


    /**
     * Set motcle
     *
     * @param \App\Entity\Masterlistelg $motcle
     *
     * @return Motclegraphique
     */
    public function setMotcle(\App\Entity\Masterlistelg $motcle = null)
    {
        $this->motcle = $motcle;

        return $this;
    }

    /**
     * Get motcle
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getMotcle()
    {
        return $this->motcle;
    }
   
}
