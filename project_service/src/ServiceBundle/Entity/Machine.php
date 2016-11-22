<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ServiceBundle\Entity\Brand;
use ServiceBundle\Entity\Client;
use ServiceBundle\Entity\Repair_status;
use ServiceBundle\Entity\Type;


/**
 * Machine
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\MachineRepository")
 */
class Machine
{
    
    /**
     * @ORM\OneToMany(targetEntity="Brand", mappedBy="machine")
     */
    private $brands;
        
    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="machine")
     */
    private $clients;
    
    /**
     * @ORM\OneToMany(targetEntity="Type", mappedBy="machine")
     */
    private $types;
    
    /**
     * @ORM\OneToMany(targetEntity="Repair_status", mappedBy="machine")
     */
    private $repairStatuses;
    
    public function __construct() {
        $this->brands = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->repairStatuses = new ArrayCollection();
        $this->types = new ArrayCollection();
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
     * @ORM\Column(name="complaint_number", type="string", length=45, unique=true)
     */
    private $complaintNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertion_date", type="datetime")
     */
    private $insertionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="complaint_description", type="string", length=255)
     */
    private $complaintDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="repair_description", type="string", length=255, nullable=true)
     */
    private $repairDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="repair_date", type="datetime", nullable=true)
     */
    private $repairDate;

    /**
     * @var string
     *
     * @ORM\Column(name="machine_description", type="string", length=255, nullable=true)
     */
    private $machineDescription;


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
     * Set complaintNumber
     *
     * @param string $complaintNumber
     * @return Machine
     */
    public function setComplaintNumber($complaintNumber)
    {
        $this->complaintNumber = $complaintNumber;

        return $this;
    }

    /**
     * Get complaintNumber
     *
     * @return string 
     */
    public function getComplaintNumber()
    {
        return $this->complaintNumber;
    }

    /**
     * Set insertionDate
     *
     * @param \DateTime $insertionDate
     * @return Machine
     */
    public function setInsertionDate($insertionDate)
    {
        $this->insertionDate = $insertionDate;

        return $this;
    }

    /**
     * Get insertionDate
     *
     * @return \DateTime 
     */
    public function getInsertionDate()
    {
        return $this->insertionDate;
    }

    /**
     * Set complaintDescription
     *
     * @param string $complaintDescription
     * @return Machine
     */
    public function setComplaintDescription($complaintDescription)
    {
        $this->complaintDescription = $complaintDescription;

        return $this;
    }

    /**
     * Get complaintDescription
     *
     * @return string 
     */
    public function getComplaintDescription()
    {
        return $this->complaintDescription;
    }

    /**
     * Set repairDescription
     *
     * @param string $repairDescription
     * @return Machine
     */
    public function setRepairDescription($repairDescription)
    {
        $this->repairDescription = $repairDescription;

        return $this;
    }

    /**
     * Get repairDescription
     *
     * @return string 
     */
    public function getRepairDescription()
    {
        return $this->repairDescription;
    }

    /**
     * Set repairDate
     *
     * @param \DateTime $repairDate
     * @return Machine
     */
    public function setRepairDate($repairDate)
    {
        $this->repairDate = $repairDate;

        return $this;
    }

    /**
     * Get repairDate
     *
     * @return \DateTime 
     */
    public function getRepairDate()
    {
        return $this->repairDate;
    }

    /**
     * Set machineDescription
     *
     * @param string $machineDescription
     * @return Machine
     */
    public function setMachineDescription($machineDescription)
    {
        $this->machineDescription = $machineDescription;

        return $this;
    }

    /**
     * Get machineDescription
     *
     * @return string 
     */
    public function getMachineDescription()
    {
        return $this->machineDescription;
    }

    /**
     * Add brands
     *
     * @param \ServiceBundle\Entity\Brand $brands
     * @return Machine
     */
    public function addBrand(\ServiceBundle\Entity\Brand $brands)
    {
        $this->brands[] = $brands;

        return $this;
    }

    /**
     * Remove brands
     *
     * @param \ServiceBundle\Entity\Brand $brands
     */
    public function removeBrand(\ServiceBundle\Entity\Brand $brands)
    {
        $this->brands->removeElement($brands);
    }

    /**
     * Get brands
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * Add clients
     *
     * @param \ServiceBundle\Entity\Client $clients
     * @return Machine
     */
    public function addClient(\ServiceBundle\Entity\Client $clients)
    {
        $this->clients[] = $clients;

        return $this;
    }

    /**
     * Remove clients
     *
     * @param \ServiceBundle\Entity\Client $clients
     */
    public function removeClient(\ServiceBundle\Entity\Client $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add types
     *
     * @param \ServiceBundle\Entity\Type $types
     * @return Machine
     */
    public function addType(\ServiceBundle\Entity\Type $types)
    {
        $this->types[] = $types;

        return $this;
    }

    /**
     * Remove types
     *
     * @param \ServiceBundle\Entity\Type $types
     */
    public function removeType(\ServiceBundle\Entity\Type $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add repairStatuses
     *
     * @param \ServiceBundle\Entity\Repair_status $repairStatuses
     * @return Machine
     */
    public function addRepairStatus(\ServiceBundle\Entity\Repair_status $repairStatuses)
    {
        $this->repairStatuses[] = $repairStatuses;

        return $this;
    }

    /**
     * Remove repairStatuses
     *
     * @param \ServiceBundle\Entity\Repair_status $repairStatuses
     */
    public function removeRepairStatus(\ServiceBundle\Entity\Repair_status $repairStatuses)
    {
        $this->repairStatuses->removeElement($repairStatuses);
    }

    /**
     * Get repairStatuses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRepairStatuses()
    {
        return $this->repairStatuses;
    }
}
