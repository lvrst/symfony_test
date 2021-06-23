<?php

namespace App\Form;

use App\Entity\Teacher;
use App\Entity\SchoolYear;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('schoolYears', EntityType::class, [
                'class' => SchoolYear::class,
                'choice_label' => function(SchoolYear $schoolYear) {
                    return "{$schoolYear->getName()}";
                },
            'multiple' => true,
            'expanded' => true
            ])
            ->add('projects', EntityType::class, [
                'class' => Project::class,
                'choice_label' => function(Project $project) {
                    return "{$project->getName()}";
                },
            'multiple' => true,
            'expanded' => true
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => function(Tag $tag) {
                    return "{$tag->getName()}";
                },
            'multiple' => true,
            'expanded' => true
            ])
            ->add('user', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'username',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
