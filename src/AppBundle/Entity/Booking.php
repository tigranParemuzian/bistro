<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    const IS_NEW = 0;
    const IN_PROGRESS = 1;
    const IS_READY = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="count", type="string", length=255)
     * @Groups({"booking_list"})
     */
    private $count;

    /**
     * @var
     * @Assert\NotBlank(message="Product can`t be null")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_ingredient_id", referencedColumnName="id")
     * @Groups({"booking_product"})
     */
    private $product;

    /**
     * @var
     * @Assert\NotBlank(message="Worker can`t be null")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BistroWorker")
     * @ORM\JoinColumn(name="bistro_worker_id", referencedColumnName="id")
     * @Groups({"booking_worker"})
     */
    private $worker;

    /**
     * @var
     * @Assert\NotBlank(message="Cache can`t be null")
     * @ORM\Column(name="cache", type="integer")
     * @Groups({"booking_list"})
     */
    private $cache;

    /**
     * @var
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"booking_list"})
     */
    private $created;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


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
     * Set count
     *
     * @param string $count
     * @return Booking
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set cache
     *
     * @param integer $cache
     * @return Booking
     */
    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * Get cache
     *
     * @return integer 
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Booking
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Booking
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return Booking
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set worker
     *
     * @param \AppBundle\Entity\BistroWorker $worker
     * @return Booking
     */
    public function setWorker(\AppBundle\Entity\BistroWorker $worker = null)
    {
        $this->worker = $worker;

        return $this;
    }

    /**
     * Get worker
     *
     * @return \AppBundle\Entity\BistroWorker 
     */
    public function getWorker()
    {
        return $this->worker;
    }
}
