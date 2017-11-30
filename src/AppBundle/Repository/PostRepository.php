<?php

declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PostRepository extends EntityRepository
{
    public function getLoaderQuery(): Query
    {
        return $this->createQueryBuilder("p")
            ->select("p", "u")
            ->leftJoin("p.author", "u")
            ->getQuery();
    }
}
