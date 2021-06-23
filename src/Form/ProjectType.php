<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Student;
use App\Entity\Tag;
use App\Entity\Teacher;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('deadline')
            ->add('budget')
            ->add('students', EntityType::class, [
                'class' => Student::class,
                'choice_label' => function(Student $student) {
                    return "{$student->getFirstname()} {$student->getLastname()}";
                },
            'multiple' => true,
            'expanded' => true
            ])
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                'choice_label' => function(Client $client) {
                    return "{$client->getFirstname()} {$client->getLastname()}";
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
            ->add('teacher', EntityType::class, [
                'class' => Teacher::class,
                'choice_label' => function(Teacher $teacher) {
                    return "{$teacher->getFirstname()} {$teacher->getLastname()}";
                },
            // 'multiple' => true,
            'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
