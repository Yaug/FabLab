<?php
namespace FabLab\ManagerBundle\Listener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use FabLab\ManagerBundle\Model\ThicoinInterface;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Events;
use FabLab\ManagerBundle\Entity\ThicoinOwner;

class ThicoinSubscriber implements EventSubscriber
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function getSubscribedEvents()
    {
        return array(
           Events::onFlush,
	   Events::prePersist,
	   Events::preUpdate 
        );
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em  = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if($entity instanceof ThicoinInterface){
                $changed = $uow->getEntityChangeSet($entity);
                //var_dump($changed);die("in");
                if($changed['currentUser'][1] !== null) {
                    // Create new owning
                    $owner = new ThicoinOwner();
                    $owner->setThicoin($entity);
                    $owner->setOwner($changed['currentUser'][1]);
                    $em->persist($owner);
                    $uow->computeChangeSets();

                }
	    }
  	}
        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if($entity instanceof ThicoinInterface){
		$changed = $uow->getEntityChangeSet($entity);
		if(array_key_exists('currentUser', $changed)) {
		    if($changed['currentUser'][0] !== null) {
		        // Close old owning
                        foreach($entity->getOwners() as $tmpOwner){
                            if($tmpOwner->getIsActive()){
                                $tmpOwner->setIsActive(0);
                                $tmpOwner->setEndAt(new \DateTime());
                                $em->persist($tmpOwner);
                            }
                        }
		    }
                    if($changed['currentUser'][1] !== null) {
                        // Create new owning
                        $owner = new ThicoinOwner();
                        $owner->setThicoin($entity);
                        $owner->setOwner($changed['currentUser'][1]);
                        $em->persist($owner);
                    }
                    $uow->computeChangeSets();
		}
	    }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ( $entity instanceof ThicoinInterface) {
            if($entity->getCode() === null){
                $entity->generateCode();
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ( $entity instanceof ThicoinInterface) {
            if($entity->getCode() === null){
                $entity->generateCode();
            }
            
        }
    }
}
