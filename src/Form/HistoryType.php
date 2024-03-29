<?php

namespace App\Form;

use App\Entity\History;
use App\Entity\Matchday;
use App\Entity\Statistic;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numOfPoints')
            ->add('created')
            ->add('updated')
            ->add('matchday', EntityType::class, [
                'class' => Matchday::class,
'choice_label' => 'id',
            ])
            ->add('statistic', EntityType::class, [
                'class' => Statistic::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => History::class,
        ]);
    }
}
