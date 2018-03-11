<?php

use Doctrine\Common\Persistence\ObjectManager;
use LandingBundle\Repository\TypeVehicleRepository;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\Common\DataFixtures\FixtureInterface;
use LandingBundle\Entity\TypeVehicle;
use LandingBundle\Entity\Vehicle;
use LandingBundle\Entity\Preference;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DataFixtureLoader implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $cityNamesArray = ['Madrid', 'Barcelona', 'Valencia', 'Bilbao', 'Sevilla', 'Málaga'];
        $vehicleNamesArray = ['Corsa', 'Astra', 'Mokka', 'Crossland'];

        foreach ($cityNamesArray as $indexCityName => $cityName) {
            $city = '$city'.$indexCityName;
            $city = new \AppBundle\Entity\City();
            $city->setName($cityName);
            $manager->persist($city);

            $costPerDay = 30;

            foreach ($vehicleNamesArray as $index => $name) {
                $vehicle = '$vehicle'.$index;
                $vehicle = new \AppBundle\Entity\Vehicle();
                $vehicle->setName($name);
                $vehicle->setCostPerDay($costPerDay);
                $costPerDay += 10;
                $vehicle->setCity($city);
                $manager->persist($vehicle);
            }
        }

        for ($i = 1; $i <= count($cityNamesArray); $i++) {

        }


        $manager->flush();

    }

}