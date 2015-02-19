<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Generic\EnumType;

class IntelligenceEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'intelligence';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param int $intelligence
     * @return Intelligence
     */
    protected function convertToEnum($intelligence)
    {
        return Intelligence::get($intelligence);
    }
}
