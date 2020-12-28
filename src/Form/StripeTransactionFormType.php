<?php

namespace App\Form;

use App\Entity\StripeTransaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StripeTransactionFormType extends AbstractType

 //accéder aux données à partir de ce tableau : pour des petites modif
 //ajout >> use Symfony\Component\Form\Extension\Core\Type\TextType;
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer_id', TextType::class)
            ->add('product', TextType::class )
            ->add('amount', NumberType::class )
            ->add('currency', TextType::class)
            ->add('status', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
   // le formulaire sera pré-rempli :

        $resolver->setDefaults([
            'data_class' => StripeTransaction::class,
        ]);
    }
}
