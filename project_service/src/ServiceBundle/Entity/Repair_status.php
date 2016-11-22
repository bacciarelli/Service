<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ServiceBundle\Entity\Machine;

/**
 * Repair_status
 *
 * @ORM\Table(name="repair_status")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\Repair_statusRepository")
 */
class Repair_status
{
    
    /**
     * @ORM\ManyToOne(targetEntity="Machine", inversedBy="repair_statuses")
     */
    private $machine;
    
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
     * @ORM\Column(name="name", type="string", length=60, unique=true)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     * @return Repair_status
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set machine
     *
     * @param \ServiceBundle\Entity\Machine $machine
     * @return Repair_status
     */
    public function setMachine(\ServiceBundle\Entity\Machine $machine = null)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return \ServiceBundle\Entity\Machine 
     */
    public function getMachine()
    {
        return $this->machine;
    }
}
