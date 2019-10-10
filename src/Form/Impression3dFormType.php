<?php


namespace App\Form;


use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;

class Impression3dFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Noma',TextType::class)
            ->add('date',DateType::class)
            ->add('Nom',TextType::class,['attr'=>['label'=>"Nom du print"]])
            ->add('Temps',IntegerType::class)
            ->add('Matiere',TextType::class)
            ->add('Prix',IntegerType::class)
            ->add('Heure',IntegerType::class)
            ->add('submit',SubmitType::class);

    }

}