<?php

namespace App\Form\Type;

use App\Model\BowlingFrame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BowlingFrameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roll1', IntegerType::class, [
                'label' => 'Roll 1',
                'attr' => ['min' => 0, 'max' => 10],
            ])
            ->add('roll2', IntegerType::class, [
                'label' => 'Roll 2',
                'attr' => ['min' => 0, 'max' => 10],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BowlingFrame::class,
        ]);
    }
}
