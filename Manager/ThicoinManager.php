<?php

namespace FabLab\ManagerBundle\Manager;

use Doctrine\ORM\EntityManager;
use FabLab\ManagerBundle\Manager\BaseManager;

class ThicoinManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function getLast($params)
    {
        return $this->getRepository()->getLast($params);
    }

    public function getRepository()
    {
        return $this->em->getRepository('FabLabManagerBundle:Thicoin');
    }
}