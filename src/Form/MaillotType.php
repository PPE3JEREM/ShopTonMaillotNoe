<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Maillot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MaillotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeMaillot')
            ->add('Saison')
            ->add('image')
            ->add('matiere')
            ->add('taille')
            ->add('prix')
            ->add('description')
            ->add('disponibilite', ChoiceType::class,[
                'choices'=>[
                    'En stock'=>1,
                    'Pas disponible'=>0
                ]
            ])
            ->add('stock')
            ->add('equipe', EntityType::class,[
                'class'=>Equipe::class,
                'choice_label'=>'libelle',
                'label'=>"equipe du maillot"
            ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maillot::class,
        ]);
    }
}
