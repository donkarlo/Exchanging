<?php

namespace Ndrm\ConceptBundle\Form\Param;

/**
 * 
 */
class ParamByConceptCategoryType extends ParamType {

    function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->remove("conceptCategory");
    }

}
