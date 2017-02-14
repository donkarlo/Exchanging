<?php

namespace Ndrm\ConceptBundle\Repository\Instance;

use Ndrm\ConceptBundle\Entity\Instance;
use \Doctrine\ORM\EntityRepository;
use Ndrm\ConceptBundle\Entity\Category\Category;
use \Doctrine\Common\Collections\ArrayCollection;
use \Ndrm\ConceptBundle\Entity\Param\Param as ConceptParam;
use Ndrm\ConceptBundle\Entity\Instance\ParamValue;

class ParamValueRepository extends EntityRepository {

    /**
     * 
     * @param Instance $instanceEntity
     */
    public function getParamValuesByInstance(Instance $instanceEntity) {
        
    }

    /**
     * 
     * @param Category $conceptCategory
     */
    public function createParamValuesByConceptCategoryParams(Category $conceptCategory) {
        $conceptCategoryParamRepository = $this->getEntityManager()->getRepository(ConceptParam::class);
        $conceptParamEntities = $conceptCategoryParamRepository->findByCatWithInputTypeTitle($conceptCategory->getId());
        $paramValueEntities = new ArrayCollection();
        foreach ($conceptParamEntities as $conceptParamEntity) {
            $paramValueEntity = new ParamValue();
            $paramValueEntity->setParam($conceptParamEntity);
            $paramValueEntities->add($paramValueEntity);
        }
        return $paramValueEntities;
    }

}
