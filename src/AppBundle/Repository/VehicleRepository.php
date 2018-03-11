<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Rent;
use Doctrine\ORM\EntityRepository;

class VehicleRepository extends EntityRepository
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

    public function findByCityId($id)
    {
        $sql = $this->createQueryBuilder('c');
        $sql
            ->andWhere('c.city = :id')
            ->setParameter('id', $id);

        $query = $sql->getQuery();
        return $query->getResult();
    }

    public function findAvailableVehiclesByCityAndDates(Rent $rent)
    {
        $sql = $this->createQueryBuilder('c');
        $sql
            ->andWhere('c.city = :city')
            ->andWhere('r.dateInit < :dateInit ')
            ->andWhere('r.dateInit > :dateEnd ')
            ->andWhere('r.dateEnd < :dateInit ')
            ->andWhere('r.dateEnd > :dateEnd ')
            ->setParameter('city', $rent->getCity())
            ->setParameter('dateInit', $rent->getDateInit())
            ->setParameter('dateEnd', $rent->getDateEnd())
            ->innerJoin('c.rents','r')
            ;

        $query = $sql->getQuery();
        return $query->getResult();
    }

    public function findAll()
    {
        $sql = $this->createQueryBuilder('c');

        $query = $sql->getQuery();
        return $query->getResult();
    }

}//class