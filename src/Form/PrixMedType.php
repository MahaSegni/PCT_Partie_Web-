<?php

namespace App\Form;

use App\Entity\PrixMed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixMedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tva')
            ->add('taux')
            ->add('medicament')
            ->add('fournisseur')
            ->add('Enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-info')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrixMed::class,
        ]);
    }
}
