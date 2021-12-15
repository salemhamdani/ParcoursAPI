<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 14/11/2016
 * Time: 15:15
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 * @ORM\Table(name="fos_group")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="groups", cascade={"persist"})
     * 
     */
    protected $users;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    /**
     * Get enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set enabled
     *
     * @param boolean $archive
     *
     * @return enabled
     */
    public function setEnabled($boolean)
    {
        $this->enabled = (bool) $boolean;
        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString() {
        return $this->getName();
    }

    /**
     * Add user
     *
     * @param \App\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\App\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \App\Entity\User $user
     */
    public function removeUser(\App\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Remove users
     */
    public function removeAllUsers()
    {
        $users = $this->getUsers();
        foreach ($users as $user){
            $user->removeGroup($this);
        }
    }


    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __construct()
    {

    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
