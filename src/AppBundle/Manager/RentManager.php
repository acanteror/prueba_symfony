<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Rent;
use Doctrine\ORM\EntityManagerInterface;

class RentManager {

    /** @var  \AppBundle\Repository\RentRepository*/
    private $repository;

    /** @var  EntityManagerInterface */
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository("AppBundle:Rent");
        $this->entityManager = $entityManager;
    }

    public function add(Rent $new){
        $this->entityManager->persist($new);
    }

    public function update(Rent $new){
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