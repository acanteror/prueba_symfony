<?php

namespace AppBundle\Manager;

use AppBundle\Entity\City;
use Doctrine\ORM\EntityManagerInterface;

class CityManager {

    /** @var  \AppBundle\Repository\CityRepository*/
    private $repository;

    /** @var  EntityManagerInterface */
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository("AppBundle:City");
        $this->entityManager = $entityManager;
    }

    public function add(City $new){
        $this->entityManager->persist($new);
    }

    public function update(City $new){
        $this->entityManager->persist($new);
    }

    public function findById($id){
        return $this->repository->findById($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function applyChanges(){
        $this->entityManager->flush();
    }

}