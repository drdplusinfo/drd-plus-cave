<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class CartDriving extends AbstractPhysicalSkill
{
    const CART_DRIVING = 'cart_driving';

    /**
     * @return string
     */
    public function getName()
    {
        return self::CART_DRIVING;
    }
}
