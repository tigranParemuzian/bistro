<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IngredientUnit
 *
 * @ORM\Table(name="ingredient_unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IngredientUnitRepository")
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 */
class IngredientUnit
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     */
    private $name;

    /**
     * @var string slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     */
    private $slug;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProductIngredient", mappedBy="ingredientUnit")
     */
    private $ingredient;


    public function __toString()
    {
        return $this->id ? $this->name : 'New unit';
        // TODO: Implement __toString() method.
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
     * Set name
     *
     * @param string $name
     * @return IngredientUnit
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return IngredientUnit
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ingredient
     *
     * @param \AppBundle\Entity\ProductIngredient $ingredient
     * @return IngredientUnit
     */
    public function addIngredient(\AppBundle\Entity\ProductIngredient $ingredient)
    {
        $this->ingredient[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \AppBundle\Entity\ProductIngredient $ingredient
     */
    public function removeIngredient(\AppBundle\Entity\ProductIngredient $ingredient)
    {
        $this->ingredient->removeElement($ingredient);
    }

    /**
     * Get ingredient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }
}
