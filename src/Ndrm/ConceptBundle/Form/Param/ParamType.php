<?php

namespace Ndrm\ConceptBundle\Form\Param;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * 
 */
class ParamType extends AbstractType {

    protected $builder;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('conceptCategory')
                ->add('inputType'
                        , EntityType::class
                        , ["class" => \Ndrm\ConceptBundle\Entity\Param\Input\Type::class
                    , "choice_label" => "title"])
                ->add('name', TextType::class)
                ->add('title', TextType::class)
                ->add('description', TextareaType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ndrm\ConceptBundle\Entity\Param\Param'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'ndrm_conceptbundle_param_param';
    }

}
