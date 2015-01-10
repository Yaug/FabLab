<?php

namespace FabLab\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;
use FabLab\ManagerBundle\Model\ThicoinInterface;

/**
 * Machines
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity(repositoryClass="FabLab\ManagerBundle\Entity\MachineRepository")
**/
class Machine
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
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotNull()
     */
    protected $name;

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
     * @var datetime $priceMember
     *
     * @ORM\Column(type="integer", name="price_member", nullable=true)
     */
    private $priceMember; 

    /**
     * @var datetime $priceNotMember
     *
     * @ORM\Column(type="integer", name="price_not_member", nullable=true)
     */
    private $priceNotMember;

    /**
     * @var datetime $pricePrivate
     *
     * @ORM\Column(type="integer", name="price_private", nullable=true)
     */
    private $pricePrivate;

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
     *
     * @param string $name
     * @return Machine
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
     * set price member 
     *
     * @param integer $priceMember
     * @return Machine
     */
    public function setPriceMember($priceMember)
    {
	    $this->priceMember = $priceMember;
		return $this;
    }

    /**
     * get price member 
     *
     * @return integer
     */
    public function getPriceMember()
    {
	    return $this->priceMember;
    }

    /**
     * set price not member 
     *
     * @param integer $priceMember
     * @return Machine
     */
    public function setPriceNotMember($priceNotMember)
    {
	    $this->priceNotMember = $priceNotMember;
		return $this;
    }

    /**
     * get price not member 
     *
     * @return integer
     */
    public function getPriceNotMember()
    {
	    return $this->priceNotMember;
    }

    /**
     * set price private 
     *
     * @param integer $pricePrivate
     * @return Machine
     */
    public function setPricePrivate($pricePrivate)
    {
	    $this->pricePrivate = $pricePrivate;
		return $this;
    }

    /**
     * get price private 
     *
     * @return integer
     */
    public function getPricePrivate()
    {
	    return $this->pricePrivate;
    }

    public function __toString()
    {
        if($this->getId() !== null) {
            return $this->getName();
        } else {
            return 'new machine';
        }
    }
}

