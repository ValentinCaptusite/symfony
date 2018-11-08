<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\User;
use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
                'placeholder' => 'Choose a group',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.label', 'ASC');
                },
                'choice_label' => 'label'])
            ->add('adresse', EntityType::class, array(
                'class' => Adresse::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.adresse', 'ASC');
                },
                'choice_label' => 'adresse',
                'multiple' => true,
            ))
            ->add('save', SubmitType::class, ['label' => 'Add a user']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class' => User::class]);
    }
}