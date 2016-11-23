<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ServiceBundle\Entity\Machine;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\TypeRepository")
 */
class Type {

    public function __toString() {
        return $this->name;
    }

    /**
     * @ORM\OneToMany(targetEntity="Machine", mappedBy="type")
     */
    private $machines;

    public function __construct() {
        $this->machines = new ArrayCollection();
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
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Type
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add machines
     *
     * @param \ServiceBundle\Entity\Machine $machines
     * @return Type
     */
    public function addMachine(\ServiceBundle\Entity\Machine $machines) {
        $this->machines[] = $machines;

        return $this;
    }

    /**
     * Remove machines
     *
     * @param \ServiceBundle\Entity\Machine $machines
     */
    public function removeMachine(\ServiceBundle\Entity\Machine $machines) {
        $this->machines->removeElement($machines);
    }

    /**
     * Get machines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMachines() {
        return $this->machines;
    }

}
