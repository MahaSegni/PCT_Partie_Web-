<?php

namespace App\Form;

use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('uv')
            ->add('taux')
            ->add('tva')
            ->add('xug', ChoiceType::class, [
                'choices' => [
                    'Q' => 'Q',
                    'D' => 'D',
                    'NULL' => '',

                ]])
            ->add('Enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-info')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
