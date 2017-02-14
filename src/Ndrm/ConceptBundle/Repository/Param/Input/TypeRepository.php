<?php

namespace Ndrm\ConceptBundle\Repository\Param\Input;

use Doctrine\ORM\EntityRepository;

class TypeRepository extends EntityRepository {

    /**
     * 
     * @param mixed $lang
     * @param mixed $identityType
     * @param mixed $type
     * @return string
     */
    public function getLangSpecificInputIdentity($type, $lang, $identityType) {
        if ($lang instanceof \Ndrm\ConceptBundle\Entity\Param\Input\Lang) {
            $lang = strtoupper($lang->getMonitoring());
        }
        $lang = strtoupper($lang);
        $identityType = strtoupper($identityType);

        if ($type instanceof Ndrm\ConceptBundle\Entity\Param\Input\Type) {
            $type = $type->getTitle();
        }
        $type = strtoupper($type);
//        dump(["type" => $type, "lang" => $lang, "id" => $identityType]);
        $langSpecifiedInputIdentity = "";
        if ($lang == "SYMFONY_FORM_TYPE") {
            if ($identityType == "NAMESPACED_CLASS_NAME") {
                if (in_array($type, ["TEXT_AREA", "TEXTAREA"])) {
                    $langSpecifiedInputIdentity = \Symfony\Component\Form\Extension\Core\Type\TextareaType::class;
                } elseif (in_array($type, ["TEXT", "TEXT_INPUT", "TEXTINPUT"])) {
                    $langSpecifiedInputIdentity = \Symfony\Component\Form\Extension\Core\Type\TextType::class;
                } elseif (in_array($type, ["FILE"])) {
                    $langSpecifiedInputIdentity = \Symfony\Component\Form\Extension\Core\Type\FileType::class;
                }
            }
        }
        return $langSpecifiedInputIdentity;
    }

}
