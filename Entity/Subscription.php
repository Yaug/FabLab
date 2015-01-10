<?php

namespace FabLab\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Thicoin 
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="FabLab\ManagerBundle\Entity\SubscriptionRepository")
**/
class Subscription
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", length=255)
     * @Assert\NotBlank()
     */
    protected $price;

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
     * Set name
     * @param string $name
     * @return Subscription
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * get name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set price
     * @param string $price
     * @return Subscription
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
    /**
     * get price
     * 
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    public function __toString()
    {
        $str = $this->getName();
        if(empty($str)){
            if($this->getId()){
                $str = "Cotisation #".$this->getId();
            } else {
                $str = "Nouvelle cotisation";
            }
        }
        return $str;
    }
    
}