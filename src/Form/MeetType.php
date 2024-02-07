<?php

namespace App\Form;

use App\Entity\League;
use App\Entity\Matchday;
use App\Entity\Meet;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('hostGoals')
            ->add('guestGoals')
            ->add('term')
            ->add('position')
            ->add('created')
            ->add('updated')
            ->add('league', EntityType::class, [
                'class' => League::class,
'choice_label' => 'id',
            ])
            ->add('matchday', EntityType::class, [
                'class' => Matchday::class,
'choice_label' => 'id',
            ])
            ->add('hostTeam', EntityType::class, [
                'class' => Team::class,
'choice_label' => 'id',
            ])
            ->add('guestTeam', EntityType::class, [
                'class' => Team::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meet::class,
        ]);
    }
}
