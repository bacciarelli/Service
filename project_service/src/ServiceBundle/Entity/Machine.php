<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ServiceBundle\Entity\Brand;
use ServiceBundle\Entity\Client;
use ServiceBundle\Entity\Repair_status;
use ServiceBundle\Entity\Type;
use ServiceBundle\Entity\ModelMachine;


/**
 * Machine
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\MachineRepository")
 */
class Machine
{
    
    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="machines")
     */
    private $brand;
    
    /**
     * @ORM\ManyToOne(targetEntity="ModelMachine", inversedBy="machines")
     */
    private $modelMachine;
        
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="machines")
     */
    private $client;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="machines")
     */
    private $type;
    
    /**
     * @ORM\OrderBy({"name" = "DESC"})
     * @ORM\ManyToOne(targetEntity="Repair_status", inversedBy="machines")
     */
    private $repairStatus;
    
    
    
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
     * Set brand
     *
     * @param \ServiceBundle\Entity\Brand $brand
     * @return Machine
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
     * Set client
     *
     * @param \ServiceBundle\Entity\Client $client
     * @return Machine
     */
    public function setClient(\ServiceBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \ServiceBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set type
     *
     * @param \ServiceBundle\Entity\Type $type
     * @return Machine
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

    /**
     * Set repairStatus
     *
     * @param \ServiceBundle\Entity\Repair_status $repairStatus
     * @return Machine
     */
    public function setRepairStatus(\ServiceBundle\Entity\Repair_status $repairStatus = null)
    {
        $this->repairStatus = $repairStatus;

        return $this;
    }

    /**
     * Get repairStatus
     *
     * @return \ServiceBundle\Entity\Repair_status 
     */
    public function getRepairStatus()
    {
        return $this->repairStatus;
    }


    /**
     * Set modelMachine
     *
     * @param \ServiceBundle\Entity\ModelMachine $modelMachine
     * @return Machine
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
}
