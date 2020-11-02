<?php

namespace PizzaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_ingredient")
 * @ORM\Entity(repositoryClass="PizzaBundle\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $price;

     /**
     * @ORM\ManyToMany(targetEntity="Pizza", mappedBy="ingredients")
     */
    protected $pizzas;

    public function __construct() {
        $this->pizzas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPizzas()
    {
        return $this->pizzas;
    }

    public function setPizzas($pizzas)
    {
        $this->pizzas = $pizzas;
    }
}

?>