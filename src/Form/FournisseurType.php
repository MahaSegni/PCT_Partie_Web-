<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomf',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('mail',EmailType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('telephone',TextType::class, array('attr' => array('class' => 'form-control','style' => 'margin-right:5px')))
            ->add('Enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-info')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
