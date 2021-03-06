<?php

namespace DtlPerson\Entity;

use Doctrine\ORM\Mapping as ORM;
use DtlUser\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="office")
 */
class Office {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="DtlUser\Entity\User", cascade={"persist"})
     * @var User
     */
    protected $user;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUser() {
        return $this->user;
    }

    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }



}
