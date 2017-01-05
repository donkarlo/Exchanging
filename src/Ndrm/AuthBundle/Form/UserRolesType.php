<?php

namespace Ndrm\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * 
 */
class UserRoleType extends AbstractType {

    /**
     * 
     */
    public function __construct(User $user) {
        
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $userRolesEntity = $this->getData();

        $em = $this->getDoctrine()->getManager();
        $existingUserRoles = $user->getRoles();
        $existingDbRoles = $em->getRepository('NdrmAuthBundle:Role')
                ->findAll();
        $roleCounter = 0;
        foreach ($existingDbRoles as $existingDbRole) {
            $roleCounterFieldName = 'role_' . "{$existingDbRole}";
            $builder->add($roleCounterFieldName
                    , CheckboxType::class
                    , array('label' => $existingDbRole->getRole()));

            if (in_array($existingDbRole->getId(), $existingUserRoles)) {
                $builder->get($roleCounterFieldName)->attr(array('checked' => 'checked'));
            }

            $roleCounter++;
        }
        $builder->add('save', SubmitType::class, array('label' => 'Save'));
/////////////////////////////////////

        $roles = $existingDbRoles = $em->getRepository('NdrmAuthBundle:Role')
                ->findAll();
        $builder
                ->add('name')
                ->add('roles', ChoiceType::class, [
                    'choices' => $roles,
                    'multiple' => true,
                    'expanded' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Ndrm\AuthBundle\Entity\UserRoles::class
        ));
    }

}
