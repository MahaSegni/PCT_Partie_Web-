<?php

namespace App\Form;

use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomm',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px ')))
            ->add('prix_achat',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('qte',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('remise',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('ug',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('tauxug',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
           ->add('fournisseur')
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
