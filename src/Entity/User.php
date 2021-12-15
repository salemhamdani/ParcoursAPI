<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
	"formateur" = "App\Entity\Formateur",
	"employe" = "App\Entity\Employe",
	"personne" = "App\Entity\Personne",
	"user" = "App\Entity\User"})
 * 
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Group", inversedBy="users")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="cascade")}
     * )
     */
    protected $groups;


    /**
     * @var string
     *
     * @ORM\Column(name="access_space", type="string", length=200, nullable=true)
     */
    private $accessSpace;

    //pour EasyAdmin
    public function getExpiresAt() {
        return $this->expiresAt;
    }

    public function getCredentialsExpireAt() {
        return $this->credentialsExpireAt;
    }

    public function __construct() {
        parent::__construct();
        // your own logic
    }

    /**
     * Set accessSpace
     *
     * @param string $accessSpace
     *
     * @return User
     */
    public function setAccessSpace($accessSpace) {
        $this->accessSpace = $accessSpace;

        return $this;
    }

    /**
     * Get accessSpace
     *
     * @return string
     */
    public function getAccessSpace() {
        return $this->accessSpace;
    }

       /**
     * Set type
     *
     * @param string $type
     *
     * @return User
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
}
