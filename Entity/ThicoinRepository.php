<?php

namespace FabLab\ManagerBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ThicoinRepository extends EntityRepository
{
    /**
     * Retrieve last thicoins using a set of parameters
     * 
     * @param array $params
     * @return array
     */
    public function getLast(Array $params)
    {        
        $qb = $this->createQueryBuilder("t");
        
        // Add a limit
        if(!empty($params['limit'])){
            $qb->setMaxResults($params['limit']);
        }
        
        $qb->orderBy('t.createdAt', 'DESC');$q = $qb->getQuery();
        
        try {
            return $q->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
