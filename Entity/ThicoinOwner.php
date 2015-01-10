<?php

namespace FabLab\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ThicoinOwner
 *
 * @ORM\Table(name="thicoin_owner")
 * @ORM\Entity(repositoryClass="FabLab\ManagerBundle\Entity\ThicoinOwnerRepository")
 */
class ThicoinOwner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Thicoin", inversedBy="owners", cascade={"persist"})
     * @ORM\JoinColumn(name="thicoin_id", referencedColumnName="id")
     */
    protected $thicoin;

    /**
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @var datetime $endAt
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=true)
     */
    protected $endAt;

    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setThicoin($thicoin = null)
    {
        $this->thicoin = $thicoin;
    }

    /**
     * {@inheritdoc}
     */
    public function getThicoin()
    {
        return $this->thicoin;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner($owner = null)
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * set is active
     * 
     * @param boolean $isActive
     * @return ThicoinOwner
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * get is active
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndAt(\DateTime $endAt = null)
    {
        $this->endAt = $endAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

}
