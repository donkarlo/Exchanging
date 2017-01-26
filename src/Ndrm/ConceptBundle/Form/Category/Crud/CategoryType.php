<?php

namespace Ndrm\ConceptBundle\Form\Category\Crud;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Ndrm\ConceptBundle\Entity\Category\Category;

/**
 * Description of Node
 *
 * @author root
 */
class CategoryType extends AbstractType {

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("title", TextType::class, array("label"=>"عنوان"))
//                ->add("description", TextareaType::class, array())
//                ->add("categoryId", HiddenType::class, array())
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
            'data_class' => Category::class,
        ));
    }

}
