<?php

namespace Ndrm\ConceptBundle\Form\Instance;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ndrm\ConceptBundle\Repository\Param\Input\TypeRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use \Doctrine\ORM\EntityManager;

/**
 * Intended to load all parameters of a value
 * instance_param_values
 */
class ParamValueType extends AbstractType {

    /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     * This service injection was set in services.yml
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /*
         * we have written the whole code here in an event because it was called as a collection in instancetype
         */
        $builder->addEventListener(FormEvents::PRE_SET_DATA
                , function (FormEvent $event) {
            $instanceParamValueEntity = $event->getData();
            $form = $event->getForm();
            $conceptParam = $instanceParamValueEntity->getParam();
            $inputType = $conceptParam->getInputType();
            $inputTypeRepo = $this->em->getRepository(get_class($inputType));
            $fieldType = $inputTypeRepo->getLangSpecificInputIdentity($inputType->getTitle()
                    , "SYMFONY_FORM_TYPE"
                    , "NAMESPACED_CLASS_NAME");
            $form->add("value"
                    , $fieldType
                    , array("label" => $conceptParam->getTitle()));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => \Ndrm\ConceptBundle\Entity\Instance\ParamValue::class
        ));
    }

}
