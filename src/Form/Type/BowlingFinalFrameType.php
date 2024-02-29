<?php

namespace App\Form\Type;

use App\Model\BowlingFinalFrame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BowlingFinalFrameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roll3', IntegerType::class, [
                'label' => 'Roll 3',
                'attr' => ['min' => 0, 'max' => 10],
            ])
        ;
    }

    public function getParent()
    {
        return BowlingFrameType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BowlingFinalFrame::class,
        ]);
    }
}
