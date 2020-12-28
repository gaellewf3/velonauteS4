<?php

namespace App\Form;

use App\Entity\Itineraire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ItineraireFormType extends AbstractType

 //accéder aux données à partir de ce tableau : pour des petites modif
 //ajout >> use Symfony\Component\Form\Extension\Core\Type\TextType;
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', TextType::class)
            ->add('region', TextType::class )
            ->add('nom', TextType::class )
            ->add('description', TextType::class)
            ->add('informations', TextType::class)
            ->add('updated_at', DateTimeType::class)            
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => '...',
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,
                // 'imagine_pattern' => '...',
                'asset_helper' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
   // le formulaire sera pré-rempli :

        $resolver->setDefaults([
            'data_class' => Itineraire::class,
        ]);
    }
}
