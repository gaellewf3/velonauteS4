<?php

namespace App\Form;

use App\Entity\Paiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_carte', ChoiceType::class, [
                'choices' => [
                    'Visa' => 'visa',
                    'Mastercard' => 'mastercard',
                    'Amex' => 'amex',
                ],
            ])
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('numero_carte', NumberType::class, [
                'attr' => ['class' => 'numero-carte']
            ])
            ->add('code_securite', NumberType::class, [
                'attr' => ['class' => 'code-securite'],
                'label' => 'Code'
            ])
            ->add('expiration_mois', NumberType::class, [
                'attr' => ['class' => 'expiration-mois']
            ])
            ->add('expiration_annee', NumberType::class, [
                'attr' => ['class' => 'expiration-annee']
            ])
            ->add('Payer', SubmitType::class, [
                'attr' => ['class' => 'button is-primary is-fullwidth']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}
