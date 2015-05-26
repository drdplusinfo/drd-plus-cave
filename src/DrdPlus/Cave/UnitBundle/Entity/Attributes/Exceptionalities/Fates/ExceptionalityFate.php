<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

/* abstract */ class ExceptionalityFate extends SelfTypedStrictStringEnum
{
    const EXCEPTIONALITY_FATE = 'exceptionality_fate';

    /**
     * @return ExceptionalityFate
     */
    public static function getIt()
    {
        return static::getEnum(static::getFateName());
    }

    /**
     * @return string
     */
    public static function getFateName()
    {
        if (static::class === __CLASS__) {
            throw new \LogicException(
                'The base exceptionality class ' . __CLASS__ . ' has no fate. It is just a base for others.'
            );
        }

        return static::getTypeName();
    }

    /**
     * @param string $fateName
     *
     * @return ExceptionalityFate
     */
    protected static function createByValue($fateName)
    {
        $exceptionality = parent::createByValue($fateName);
        /** @var $exceptionality ExceptionalityFate */
        if ($exceptionality::getFateName() !== $fateName) {
            throw new \LogicException(
                'Given exceptionality type ' . var_export($fateName, true) .
                ' results into exceptionality ' . get_class($exceptionality) . ' with type ' . var_export($exceptionality::getFateName(), true) . '.'
            );
        }

        return $exceptionality;
    }

    /**
     * @param string $fateName
     *
     * @return string
     */
    protected static function getEnumClass($fateName)
    {
        $specificExceptionalityClass = parent::getEnumClass($fateName);
        if ($specificExceptionalityClass === __CLASS__) {
            throw new \LogicException(
                "Given exceptionality fate {$fateName} is not paired with specific exceptionality class"
            );
        }

        return $specificExceptionalityClass;
    }

    public static function registerSelfKind()
    {
        return static::addSubTypeEnum(
            static::class,
            '~^' . static::getFateName() . '$~'
        );
    }

}
