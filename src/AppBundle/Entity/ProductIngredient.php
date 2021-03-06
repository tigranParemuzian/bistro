<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProductIngredient
 *
 * @ORM\Table(name="product_ingredient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductIngredientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductIngredient
{

    const KG = 1;
    const LITER = 2;
    const CM = 3;


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
     * @Assert\NotBlank(message="Ingredient Proportion can`t be null")
     *
     * @ORM\Column(name="ingredient_proportion", type="string")
     */
    private $ingredientProportion;

    /**
     * @var
     * @Assert\NotBlank(message="Ingredient Unit can`t be null")
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\IngredientUnit", inversedBy="ingredient")
     * @ORM\JoinColumn(name="ingredient_unite", referencedColumnName="id")
     */
    private $ingredientUnit;

    /**
     * @var
     * @Assert\NotBlank(message="Product can`t be null")
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="ingredients")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    private $product;

    /**
     * @var
     * @Assert\NotBlank(message="Ingredient can`t be null")
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredient", inversedBy="products")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     */
    private $ingredient;

    /**
     * @var float
     * @Assert\NotBlank()
     * @ORM\Column(name="import_price", type="float")
     */
    private $importPrice;

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
        return $this->id ? $this->ingredient->getName() . ' proportion: ' . $this->ingredientProportion . ' ' . $this->ingredientUnit : 'new ingridient poperty';
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
     * Set ingredientProportion
     *
     * @param string $ingredientProportion
     * @return ProductIngredient
     */
    public function setIngredientProportion($ingredientProportion)
    {
        $this->ingredientProportion = $ingredientProportion;

        return $this;
    }

    /**
     * Get ingredientProportion
     *
     * @return string 
     */
    public function getIngredientProportion()
    {
        return $this->ingredientProportion;
    }

    /**
     * Set importPrice
     *
     * @param float $importPrice
     * @return ProductIngredient
     */
    public function setImportPrice($importPrice)
    {
        $this->importPrice = $importPrice;

        return $this;
    }

    /**
     * Get importPrice
     *
     * @return float 
     */
    public function getImportPrice()
    {
        return $this->importPrice;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ProductIngredient
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
     * @return ProductIngredient
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
     * @return ProductIngredient
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
     * Set ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     * @return ProductIngredient
     */
    public function setIngredient(\AppBundle\Entity\Ingredient $ingredient = null)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \AppBundle\Entity\Ingredient 
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set ingredientUnit
     *
     * @param \AppBundle\Entity\IngredientUnit $ingredientUnit
     * @return ProductIngredient
     */
    public function setIngredientUnit(\AppBundle\Entity\IngredientUnit $ingredientUnit = null)
    {
        $this->ingredientUnit = $ingredientUnit;

        return $this;
    }

    /**
     * Get ingredientUnit
     *
     * @return \AppBundle\Entity\IngredientUnit 
     */
    public function getIngredientUnit()
    {
        return $this->ingredientUnit;
    }
}
