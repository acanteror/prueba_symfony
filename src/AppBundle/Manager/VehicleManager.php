<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Rent;
use AppBundle\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;

class VehicleManager {

    /** @var  \AppBundle\Repository\VehicleRepository */
    private $repository;

    /** @var  EntityManagerInterface */
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository("AppBundle:Vehicle");
        $this->entityManager = $entityManager;
    }

    public function add(Vehicle $new){
        $this->entityManager->persist($new);
    }

    public function update(Vehicle $new){
        $this->entityManager->persist($new);
    }

    public function findById($id){
        return $this->repository->findById($id);
    }

    public function findByCityId($id){
        return $this->repository->findByCityId($id);
    }

    public function findAvailableVehicles(Rent $rent){
        $vechiclesByCity = $this->findByCityId($rent->getCity());
        /** @var Vehicle $vehicle */
        foreach ($vechiclesByCity as $key => $vehicle){
            $isAvailable = true;
            /** @var Rent $r */
            foreach ($vehicle->getRents() as $r){
                if ($r->isComplete()){
                    if (($r->getDateInit() <= $rent->getDateInit() && $r->getDateEnd() >= $rent->getDateInit())
                        || ($r->getDateInit() <= $rent->getDateEnd() && $r->getDateEnd() >= $rent->getDateEnd())
                        || ($r->getDateInit() <= $rent->getDateInit() && $r->getDateEnd() >= $rent->getDateEnd())
                    ){
                        $isAvailable = false;
                    }
                }
            }
            if (!$isAvailable)
                unset($vechiclesByCity[$key]);
        }
        return $vechiclesByCity;
    }

    public function findAll(){
        return $this->repository->findAll();
    }

    public function applyChanges(){
        $this->entityManager->flush();
    }

}