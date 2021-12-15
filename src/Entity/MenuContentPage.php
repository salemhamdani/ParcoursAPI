<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MenuContentPage
 *
 * @ORM\Table(name="menu_content_page")
 * @ORM\Entity(repositoryClass="App\Repository\MenuContentPageRepository")
 * 
 */
class MenuContentPage {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContentPage", inversedBy="menucontentpage")
     * @ORM\JoinColumn(name="content_page_id" )
     */
    private $contentpage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="menucontentpage", cascade={"persist"})
     */
    private $menu;

    /**
     * @var int
     * @Assert\NotBlank( message = "Ce champs est obligatoire.")
     * @ORM\Column(name="rang", type="integer", nullable=true)
     */
    private $rang;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreation", type="datetimetz", nullable=true)
     */
    private $dataCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUpdated", type="datetime", nullable=true)
     */
    private $dataUpdated;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     *
     * @return MenuContentPage
     */
    public function setDataCreation($dataCreation) {
        $this->dataCreation = $dataCreation;

        return $this;
    }

    /**
     * Get dataCreation
     *
     * @return \DateTime
     */
    public function getDataCreation() {
        return $this->dataCreation;
    }

    /**
     * Set rang
     *
     * @param integer $rang
     *
     * @return MenuContentPage
     */
    public function setRang($rang) {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return integer
     */
    public function getRang() {
        return $this->rang;
    }

    /**
     * Set contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     *
     * @return MenuContentPage
     */
    public function setContentpage(\App\Entity\ContentPage $contentpage = null) {
        $this->contentpage = $contentpage;

        return $this;
    }

    /**
     * Get contentpage
     *
     * @return \App\Entity\ContentPage
     */
    public function getContentpage() {
        return $this->contentpage;
    }

    /**
     * Set menu
     *
     * @param \App\Entity\Menu $menu
     *
     * @return MenuContentPage
     */
    public function setMenu(\App\Entity\Menu $menu = null) {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \App\Entity\Menu
     */
    public function getMenu() {
        return $this->menu;
    }

    /**
     * Set dataUpdated
     *
     * @param \DateTime $dataUpdated
     *
     * @return MenuContentPage
     */
    public function setDataUpdated($dataUpdated) {
        $this->dataUpdated = $dataUpdated;

        return $this;
    }

    /**
     * Get dataUpdated
     *
     * @return \DateTime
     */
    public function getDataUpdated() {
        return $this->dataUpdated;
    }


}
