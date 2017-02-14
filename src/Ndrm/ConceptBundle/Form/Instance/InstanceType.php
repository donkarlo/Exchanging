<?php

namespace Ndrm\ConceptBundle\Form\Instance;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Ndrm\ConceptBundle\Form\Instance\ParamValueType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * 
 */
class InstanceType extends AbstractType {

    protected $builder;

    /**
     * {@inheritdoc}
     * @notice don't add submit to this form
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        ///@todo what about date updated?
        $builder
                ->add('title', TextType::class)
                ->add('description', TextareaType::class)
                ->add("paramValues"
                        , CollectionType::class
                        , array('entry_type' => ParamValueType::class)
                )
                ->add("submit", SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => \Ndrm\ConceptBundle\Entity\Instance::class
        ));
    }

}
