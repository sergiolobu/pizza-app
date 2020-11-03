<?php

namespace PizzaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_pizza")
 * @ORM\Entity(repositoryClass="PizzaBundle\Repository\PizzaRepository")
 */
class Pizza 
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
     * @ORM\ManyToMany(targetEntity="Ingredient", inversedBy="ingredients")
     * @ORM\JoinTable(name="pizzas_ingredients")
     */
    protected $ingredients;

    public function __construct() 
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }
}

?>