<?php

namespace Ndrm\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ndrm\LocationBundle\Entity\Location;

/**
 * Description of Node
 *
 * @author root
 */
class LocationType extends AbstractType {

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("title", TextType::class, array("label" => "عنوان"))
                ->add("submit", SubmitType::class, array())
                ->setMethod("POST")
        ;
    }

    /**
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Location::class,
        ));
    }

}
