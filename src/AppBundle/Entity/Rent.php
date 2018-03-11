<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RentRepository")
 * @ORM\Table(name="rents")
 */
class Rent
{

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    protected $cost;

    /**
     * @var client
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="rents")
     * @ORM\JoinColumn(name="client_id",referencedColumnName="id")
     */
    private $client;

    /**
     * @var vehicle
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicle", inversedBy="rents")
     * @ORM\JoinColumn(name="vehicle_id",referencedColumnName="id")
     */
    private $vehicle;

    /**
     * @var date
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateInit;

    /**
     * @var date
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $complete;

    /**
     * @var city
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City", inversedBy="rents")
     * @ORM\JoinColumn(name="city_id",referencedColumnName="id")
     */
    private $city;

    function __construct(){
        $this->complete = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return \AppBundle\Entity\client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \AppBundle\Entity\client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return \AppBundle\Entity\vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param \AppBundle\Entity\vehicle $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return \AppBundle\Entity\city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param \AppBundle\Entity\city $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Date
     */
    public function getDateInit()
    {
        return $this->dateInit;
    }

    /**
     * @param \Symfony\Component\Validator\Constraints\Date $dateInit
     */
    public function setDateInit($dateInit)
    {
        $this->dateInit = $dateInit;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Date
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param \Symfony\Component\Validator\Constraints\Date $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return bool
     */
    public function isComplete()
    {
        return $this->complete;
    }

    /**
     * @param bool $complete
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;
    }



}//class