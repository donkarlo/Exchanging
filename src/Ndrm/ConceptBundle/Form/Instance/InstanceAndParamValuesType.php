<?php

namespace Ndrm\ConceptBundle\Form\Instance;

use Ndrm\ConceptBundle\Form\Instance\InstanceType;
use Ndrm\ConceptBundle\Form\Instance\ParamValuesType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * 
 */
class InstanceAndParamValuesType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        if (isset($options["conceptCategory"])) {
            $conceptCategory = $options["conceptCategory"];
        }
        $builder->add('instance', InstanceType::class)
                ->add("paramvalues", ParamValuesType::class)
                ->add("submit", SubmitType::class)
        ;
    }

}
