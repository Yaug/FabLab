<?php

namespace FabLab\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Manager 
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="FabLab\ManagerBundle\Entity\ManagerRepository")
**/
class Manager 
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @ORM\OrderBy("username")
     */
    private $user;

    /**
     * @ORM\Column(type="decimal", name="hours", scale=2)
     * @Assert\NotNull()
     */
    private $hours;

    /**
     * @ORM\Column(type="text", name="info", nullable=true)
     */
    private $info;

    /**
     * @var datetime $targetDate
     *
     * @ORM\Column(type="datetime", name="target_date")
     * @Assert\NotNull()
     */
    private $targetDate;

    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get created at date
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set created at date
     *
     * @param \DateTime $createdAt
     * @return \Rosport\PostBundle\Model\Post
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * get updated at date
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updated at date
     *
     * @param \DateTime $updatedAt
     * @return \Rosport\PostBundle\Model\Post
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User
     * @return Thicoin
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get  user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * set hours
     *
     * @param float $hours
     * @return Manager
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
        return $this;
    }

    /**
     * get hours
     *
     * @return float
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * set info
     *
     * @param string $info
     * @return Manager
     */
    public function setInfo($info)
    {
        $this->info = $info;
        return $this;
    }

    /**
     * get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * get target date
     *
     * @return \DateTime
     */
    public function getTargetDate()
    {
        return $this->targetDate;
    }

    /**
     * Set target date
     *
     * @param \DateTime $targetDate
     * @return \FabLab\ManagerBundle\Entity\Manager
     */
    public function setTargetDate( $targetDate )
    {
        $this->targetDate = $targetDate;
        return $this;
    }

    public function __toString()
    {
        if($this->getId()){
            return $this->getTargetDate()->format("d/m/Y H:i:s").' - '.$this->getUser()->getUsername();
        } else {
            return 'Nouveau faciliteur';
        }
    }
}
