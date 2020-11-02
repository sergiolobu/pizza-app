<?php
namespace PizzaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('ingredients',EntityType::class,[
                'class' => 'PizzaBundle:Ingredient',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('price', NumberType::class,[
                'attr' => array(
                    'readonly' => true,
                ),
            ]);  
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PizzaBundle\Entity\Pizza'
        ));
    }
}