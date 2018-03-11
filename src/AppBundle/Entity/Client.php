<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 * @ORM\Table(name="clients")
 */
class Client
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
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @ORM\Column(name="dni", type="string", length=255)
     */
    protected $dni;

    /**
     * @var date
     * @ORM\Column(type="date")
     */
    private $dob;

    /**
     * @var ArrayCollection<Rent>
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rent",mappedBy="client")
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
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Date
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param \Symfony\Component\Validator\Constraints\Date $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
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



}//class