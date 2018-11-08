<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 07/11/2018
 * Time: 10:03
 */

namespace App\Form;

use App\Entity\User;
use App\Entity\Adresse;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('adresse', TextType::class)
            /*->add('user', EntityType::class, [
                'class' => User::class,
                'placeholder' => 'Choose a user',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.firstname', 'ASC');
                },
                'choice_label' => 'firstname'])*/
            ->add('save', SubmitType::class, ['label' => 'Add a adresse']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(['data_class' => Adresse::class]);
    }
}