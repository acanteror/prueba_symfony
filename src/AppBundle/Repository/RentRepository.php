<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RentRepository extends EntityRepository
{

    public function findById($id)
    {
        $sql = $this->createQueryBuilder('c');
        $sql
            ->andWhere('c.id = :id')
            ->setParameter('id', $id);

        $query = $sql->getQuery();
        return $query->getOneOrNullResult();
    }
/**
    public function findByCityId($id)
    {
        $sql = $this->createQueryBuilder('c');
        $sql
            ->innerJoin('c.city','ci')
            ->andWhere('ci.id = :id')
            ->setParameter('id', $id);

        $query = $sql->getQuery();
        return $query->getResult();
    }
**/
    public function findAll()
    {
        $sql = $this->createQueryBuilder('c');

        $query = $sql->getQuery();
        return $query->getResult();
    }

}//class