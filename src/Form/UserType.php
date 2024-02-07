<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('roles')
            ->add('password')
            ->add('phone')
            ->add('numberOfWins')
            ->add('status')
            ->add('priority')
            ->add('lastActivityAt')
            ->add('rankingPosition')
            ->add('maxPointsPerQueue')
            ->add('minPointsPerQueue')
            ->add('nick')
            ->add('favoritePolandTeam')
            ->add('favoriteForeignTeam')
            ->add('numberOfFirstPlaces')
            ->add('numberOfSecondPlaces')
            ->add('numberOfThirdPlaces')
            ->add('lastWinner')
            ->add('liderOfRanking')
            ->add('created')
            ->add('updated')
            ->add('shortname')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
