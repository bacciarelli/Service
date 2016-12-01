<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ServiceBundle\Entity\Machine;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Repair_status
 *
 * @ORM\Table(name="repair_status")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\Repair_statusRepository")
 * @UniqueEntity("name")
 */
class Repair_status {

    public function __toString() {
        return $this->name;
    }

    /**
     * @ORM\OneToMany(targetEntity="Machine", mappedBy="repair_status")
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
     * @Assert\Length(
     * min=2,
     * max=100
     * )
     * @ORM\Column(name="name", type="string", length=60, unique=true)
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
     * @return Repair_status
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
     * @return Repair_status
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
