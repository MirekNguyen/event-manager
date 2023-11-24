<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }
    public function createQueryBuilderByFormFilter(array $filters): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('event');
        $criteria = Criteria::create();

        $nameFilter = $filters['nameFilter'];
        $startDateFilter = $filters['start_date'];
        $endDateFilter = $filters['end_date'];
        $categoryFilter = $filters['category'];

        if ($nameFilter) {
            $criteria->andWhere(Criteria::expr()->contains('name', $filters['nameFilter']));
        }
        if ($startDateFilter) {
            $criteria->andWhere(Criteria::expr()->gte('start_date', $filters['start_date']));
        }
        if ($endDateFilter) {
            $criteria->andWhere(Criteria::expr()->lte('end_date', $filters['end_date']));
        }
        if ($categoryFilter) {
            $queryBuilder
            ->innerjoin('event.category', 'category')
            ->andWhere('category.id=:category_id')
            ->setParameter('category_id', $categoryFilter->getId());
        }
        $queryBuilder->addCriteria($criteria);
        # ->orderBy('event.end_date', 'DESC')
        return $queryBuilder;
    }
    public function getParticipantsFromResult(array $event_array): int
    {
        $participants = 0;
        foreach ($event_array as $event) {
            $participants += $event['event_participants'];
        }
        return $participants;
    }

//    /**
//     * @return Event[] Returns an array of Event objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Event
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
