<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ServiceBundle\Entity\Brand;
use ServiceBundle\Entity\Type;
use ServiceBundle\Entity\ModelMachine;

/**
 * Part
 *
 * @ORM\Table(name="part")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\PartRepository")
 */
class Part {

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="parts")
     */
    private $brand;
    
    /**
     * @ORM\ManyToOne(targetEntity="ModelMachine", inversedBy="parts")
     */
    private $modelMachine;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="parts")
     */
    private $type;
    
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

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
     * @return Part
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
     * Set quantity
     *
     * @param integer $quantity
     * @return Part
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity() {
        return $this->quantity;
    }


    /**
     * Set brand
     *
     * @param \ServiceBundle\Entity\Brand $brand
     * @return Part
     */
    public function setBrand(\ServiceBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \ServiceBundle\Entity\Brand 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set modelMachine
     *
     * @param \ServiceBundle\Entity\ModelMachine $modelMachine
     * @return Part
     */
    public function setModelMachine(\ServiceBundle\Entity\ModelMachine $modelMachine = null)
    {
        $this->modelMachine = $modelMachine;

        return $this;
    }

    /**
     * Get modelMachine
     *
     * @return \ServiceBundle\Entity\ModelMachine 
     */
    public function getModelMachine()
    {
        return $this->modelMachine;
    }

    /**
     * Set type
     *
     * @param \ServiceBundle\Entity\Type $type
     * @return Part
     */
    public function setType(\ServiceBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \ServiceBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }
}
