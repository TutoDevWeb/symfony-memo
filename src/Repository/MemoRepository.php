<?php

namespace App\Repository;

use App\Entity\Memo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Memo>
 *
 * @method Memo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Memo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Memo[]    findAll()
 * @method Memo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Memo::class);
    }

    public function save(Memo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Memo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find all next memo 
     */
    public function findNextAndTagItDone(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m FROM App\Entity\Memo m WHERE m.done = false ORDER BY m.id ASC'
        );

        // Je récupère tous les résultats
        $memos = $query->getResult();

        // Si il y en a au moins un
        if (count($memos) !== 0) {
            // Je note le premier comme fait.
            $memos[0]->setDone(true);
            $entityManager->flush();
        }

        // Si il n'y a pas de résultats je retourne un tableau vide.
        return $memos;
    }
}
