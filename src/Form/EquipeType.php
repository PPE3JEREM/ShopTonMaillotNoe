<?php

namespace App\Form;

use App\Entity\Sport;
use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('image')
            ->add('sport', EntityType::class,[
                'class'=>Sport::class,
                'choice_label'=>'libelle',
                'label'=>"sport de l'équipe"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }

    public function __toString(){
        return $this->champ; // Remplacer champ par une propriété "string" de l'entité
    }
}
