<?php


namespace App\Form;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\Validator\Constraints\File;

class Impression3dFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Noma',TextType::class)
            ->add('date',DateType::class)
            ->add('Nom',TextType::class,['attr'=>['label'=>"Nom du print"]])
            ->add('Temps',IntegerType::class)
            ->add('Matiere',ChoiceType::class,[
                'choices' =>[
                    'PLA'=> 'PLA',
                    'PETG'=> 'PETG',
                    'ABS'=> 'ABS',
                    'FLEX'=> 'FLEX'
                ]
            ])
            ->add('Prix',IntegerType::class)
            ->add('Heure',ChoiceType::class,[
                'choices' =>[
                    '8h'=> 8,
                    '10h'=> 10,
                    '12h'=> 12,
                    '14h'=> 14,
                    '16h' =>16,
                    '18h'=>18,

                ]])
            ->add('PrintFile', FileType::class, [
                'label' => 'Gcode File',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => true])

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                /*'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'maxSize' => '10M'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid file',
                    ])]])*/

            ->add('submit',SubmitType::class);

    }

}