<?php

namespace App\Form;

use App\Entity\Season;
use App\Entity\Statistic;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('match2')
            ->add('match4')
            ->add('totalPoints')
            ->add('position')
            ->add('numOfQue')
            ->add('created')
            ->add('updated')
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('season', EntityType::class, [
                'class' => Season::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statistic::class,
        ]);
    }
}
