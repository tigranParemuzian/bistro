<?php

namespace AppBundle\Entity;

use AppBundle\Traits\File;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    use File;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;


    /**
     * @var
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BistroWorker", mappedBy="worker")
     */
    private $bistros;

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

    public function __toString()
    {
        if($this->id) {
            if(in_array('ROLE_KITCHENER' ,$this->getRoles())) {
                $resolte = 'Kitchener ' . $this->getUsername();
            } elseif(in_array('ROLE_CASHIER' ,$this->getRoles())) {
                $resolte = 'Cashier ' . $this->getUsername();
            } else {
                $resolte = $this->getUsername();
            }
        } else {
            $resolte = 'new user';
        }

        return $resolte;

    }

    public function __construct()
    {
        $this->bistros = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
        // your own logic
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Worker
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Worker
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
     * @return Worker
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
     * Add bistros
     *
     * @param \AppBundle\Entity\BistroWorker $bistros
     * @return User
     */
    public function addBistro(\AppBundle\Entity\BistroWorker $bistros)
    {
        $this->bistros[] = $bistros;

        return $this;
    }

    /**
     * Remove bistros
     *
     * @param \AppBundle\Entity\BistroWorker $bistros
     */
    public function removeBistro(\AppBundle\Entity\BistroWorker $bistros)
    {
        $this->bistros->removeElement($bistros);
    }

    /**
     * Get bistros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBistros()
    {
        return $this->bistros;
    }

}
