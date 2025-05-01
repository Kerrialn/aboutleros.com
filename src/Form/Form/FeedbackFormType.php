<?php

namespace App\Form\Form;

use App\Entity\Feedback;
use App\Enum\AccommodationTypeEnum;
use App\Enum\TravelMotivationEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class FeedbackFormType extends AbstractType
{
    public function __construct(
        private readonly TranslatorInterface $translator
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translator->trans('full-name'),
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('full-name'),
                ],
            ])
            ->add('durationOfStayInDays', NumberType::class, [
                'label' => $this->translator->trans('duration-of-stay'),
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('duration-of-stay'),
                ],
            ])
            ->add('accommodationTypeEnum', EnumType::class, [
                'class' => AccommodationTypeEnum::class,
                'choice_label' => 'value',
                'label' => $this->translator->trans('accommodation'),
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('accommodation'),
                ],
                'autocomplete' => true,
            ])
            ->add('travelMotivation', EnumType::class, [
                'class' => TravelMotivationEnum::class,
                'choice_label' => 'value',
                'label' => $this->translator->trans('travel-motivation'),
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('travel-motivation'),
                ],
                'autocomplete' => true,
            ])
            ->add('satisfactionRating', RangeType::class, [
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'data-range-target' => "input",
                    'data-action' => "input->range#updateValue",
                ],
            ])
            ->add('likelihoodOfRecommending', RangeType::class, [
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'data-range-target' => "input",
                    'data-action' => "input->range#updateValue",
                ],
            ])
            ->add('likelihoodToReturn', RangeType::class, [
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'data-range-target' => "input",
                    'data-action' => "input->range#updateValue",
                ],
            ])
            ->add('improvementSuggestions', TextareaType::class, [
                'label' => $this->translator->trans('improvement-suggestions'),
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('improvement-suggestions'),
                ],
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
