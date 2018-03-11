<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

class ClientManager {

    /** @var  \AppBundle\Repository\ClientRepository*/
    private $repository;

    /** @var  EntityManagerInterface */
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository("AppBundle:Client");
        $this->entityManager = $entityManager;
    }

    public function add(Client $new){
        $this->entityManager->persist($new);
    }

    public function update(Client $new){
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

    public function isOver18 (Client $client){
        if (time() < strtotime('+18 years', strtotime($client->getDob()->format('d-m-Y')))) {
            return false;
        } else {
            return true;
        }
    }

}