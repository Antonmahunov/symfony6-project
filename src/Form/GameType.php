<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GameType extends AbstractType
{
    private TeamRepository $teamRepository;
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matchLeagueId', NumberType::class, [
                'constraints' => new NotBlank()
            ])
            ->add('homeTeamGoal', NumberType::class, [
                'constraints' => new NotBlank()
            ])
            ->add('awayTeamGoal', NumberType::class, [
                'constraints' => new NotBlank()
            ])
            ->add('homeTeam', EntityType::class, [
                'placeholder' => 'enter team name',
                'class' => Team::class,
                'constraints' => new NotBlank()
            ])
            ->add('awayTeam', EntityType::class, [
                'placeholder' => 'enter team name',
                'class' => Team::class,
                'constraints' => new NotBlank()
            ])
            ->add('submit', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
