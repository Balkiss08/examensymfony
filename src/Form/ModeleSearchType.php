<?php

namespace App\Form;

use App\Entity\ModeleSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Modele;

class ModeleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('modele',EntityType::class,['class' => Modele::class,
        'choice_label' => 'nom' ,
        'label' => 'Modèle' ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ModeleSearch::class,
        ]);
    }
}
