<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehicleRepository")
 * @ORM\Table(name="vehicles")
 */
class Vehicle
{

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="cost_per_day", type="integer", length=255)
     */
    protected $costPerDay;

    /**
     * @var city
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City", inversedBy="vehicles")
     * @ORM\JoinColumn(name="city_id",referencedColumnName="id")
     */
    private $city;

    /**
     * @var ArrayCollection<Rent>
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rent",mappedBy="vehicle")
     */
    private $rents;


    function __construct()
    {
        $this->rents = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return mixed
     */
    public function getCostPerDay()
    {
        return $this->costPerDay;
    }

    /**
     * @param mixed $costPerDay
     */
    public function setCostPerDay($costPerDay)
    {
        $this->costPerDay = $costPerDay;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRents()
    {
        return $this->rents;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $rents
     */
    public function setRents($rents)
    {
        $this->rents = $rents;
    }



    public function __toString()    {
        return $this->name;
    }

}//class