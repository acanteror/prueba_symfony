<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 * @ORM\Table(name="cities")
 */
class City
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
     * @var ArrayCollection<Vehicle>
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vehicle",mappedBy="city")
     */
    private $vehicles;

    /**
     * @var ArrayCollection<Rent>
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rent",mappedBy="city")
     */
    private $rents;

    function __construct()
    {
        $this->vehicles = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * @param ArrayCollection $vehicles
     */
    public function setVehicles($vehicles)
    {
        $this->vehicles = $vehicles;
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
}





