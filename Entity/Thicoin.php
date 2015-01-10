<?php

namespace FabLab\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;
use FabLab\ManagerBundle\Model\ThicoinInterface;

/**
 * Thicoin 
 *
 * @ORM\Table(name="thicoin")
 * @ORM\Entity(repositoryClass="FabLab\ManagerBundle\Entity\ThicoinRepository")
**/
class Thicoin implements ThicoinInterface
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    protected $code;
    
    /**
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=true)
     */
    protected $info;

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
     * @var datetime $endAt
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean")
     */
    private $isDeleted;
    

    /**
     * @var \FabLab\ManagerBundle\Entity\ThicoinOwner
     *
     * @ORM\OneToMany(targetEntity="ThicoinOwner", mappedBy="thicoin", orphanRemoval=true, cascade={"persist"})
     */
    private $owners;

    /**
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @ORM\OrderBy("username")
     */
    private $currentUser;
    
    public function __construct()
    {
        $this->isDeleted = false;        
        $this->owners = new \Doctrine\Common\Collections\ArrayCollection;
    }

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
     * Set code 
     * 
     * @param string $code
     * return Thicoin
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    
    /**
     * get code
     * 
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    
    /**
     * Set info 
     * 
     * @param string $info
     * return Thicoin
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
     * get end at date
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set end at date
     *
     * @param \DateTime $endAt
     * @return \Rosport\PostBundle\Model\Post
     */
    public function setEndAt( $endAt)
    {
        $this->endAt = $endAt;
        return $this;
    }
    
    /**
     * Set id deleted
     * 
     * @param boolean $isDeleted
     * @return Thicoin
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }
    
    /**
     * get Is deleted
     * @return type
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwners($owners)
    {
        $this->owners = new ArrayCollection();

        if(!empty($owners)){
            foreach ($owners as $owner) {
                $this->addOwner($owner);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOwners()
    {
        return $this->owners;
    }

    /**
     * {@inheritdoc}
     */
    public function addOwner(ThicoinOwner $owner)
    {
        $owner->setThicoin($this);

        $this->owners[] = $owner;
    }

    /**
     * Remove remote
     */
    public function removeOwner($owner)
    {
        $this->owners->removeElement($owner);

        return $this;
    }

    /**
     * Set current user
     *
     * @param \Application\Sonata\UserBundle\Entity\User
     * @return Thicoin
     */
    public function setCurrentUser($user)
    {
        $this->currentUser = $user;

        return $this;
    }

    /**
     * Get current user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }
    
    public function generateCode()
    {
        $length = 255;
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i = 0; $i < $length; $i++){
            $token .= $codeAlphabet[$this->cryptoRandSecure(0, strlen($codeAlphabet))];
        }
        $this->setCode($token);
    }
    
    private function cryptoRandSecure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    
    public function __toString()
    {
        if($this->getId()){
            return 'Thicoin #'.$this->getId();
        } else {
            return 'New Thicoin';
        }
    }
}
