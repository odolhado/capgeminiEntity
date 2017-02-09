<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', HiddenType::class, ['required' => false]);
        $builder->add('name', TextType::class, ['required' => false]);
        $builder->add('surname', TextType::class, ['required' => false]);
        $builder->add('telephone_number', TextType::class, ['required' => false]);
        $builder->add('address', TextType::class, ['required' => false]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'person';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Person::class,
            'empty_data' => function (FormInterface $form) {
                return new Person();
            },
            'allow_extra_fields' => true
        ));
    }
}
