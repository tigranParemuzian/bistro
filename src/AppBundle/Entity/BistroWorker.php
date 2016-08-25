<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BistroWorker
 *
 * @ORM\Table(name="bistro_worker")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BistroWorkerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class BistroWorker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var
     *
     * @Assert\NotBlank(message="Bistro can`t be null")
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Bistro", inversedBy="workers")
     * @ORM\JoinColumn(name="bistro_id", referencedColumnName="id")
     */
    private $bistro;

    /**
     * @var
     *
     * @Assert\NotBlank(message="Worker can`t be null")
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="bistros")
     * @ORM\JoinColumn(name="worker_id", referencedColumnName="id")
     */
    private $worker;


    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
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
     * Set created
     *
     * @param \DateTime $created
     * @return BistroWorker
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
     * @return BistroWorker
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
     * Set bistro
     *
     * @param \AppBundle\Entity\Bistro $bistro
     * @return BistroWorker
     */
    public function setBistro(\AppBundle\Entity\Bistro $bistro = null)
    {
        $this->bistro = $bistro;

        return $this;
    }

    /**
     * Get bistro
     *
     * @return \AppBundle\Entity\Bistro 
     */
    public function getBistro()
    {
        return $this->bistro;
    }

    /**
     * Set worker
     *
     * @param \AppBundle\Entity\User $worker
     * @return BistroWorker
     */
    public function setWorker(\AppBundle\Entity\User $worker = null)
    {
        $this->worker = $worker;

        return $this;
    }

    /**
     * Get worker
     *
     * @return \AppBundle\Entity\User
     */
    public function getWorker()
    {
        return $this->worker;
    }
}
