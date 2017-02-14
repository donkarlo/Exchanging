<?php

namespace Ndrm\ConceptBundle\Form\Instance;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Ndrm\ConceptBundle\Form\Instance\ParamValueType;

/**
 * Intended to load all parameters if a value
 * actually feeding instance_param_values
 */
class ParamValuesType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('paramValues', CollectionType::class, [
            'entry_type' => ParamValueType::class
            , 'entry_options' => array()
        ]);
    }

}
