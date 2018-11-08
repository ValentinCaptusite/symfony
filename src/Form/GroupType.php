<?php

namespace App\Form;

use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('label', TextType::class)
                ->add('save', SubmitType::class, ['label' => 'Add a group']);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class' => Groupe::class]);
    }
}