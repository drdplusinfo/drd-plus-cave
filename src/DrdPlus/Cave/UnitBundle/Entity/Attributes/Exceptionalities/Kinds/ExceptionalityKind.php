<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

class ExceptionalityKind extends SelfTypedStrictStringEnum
{
    const EXCEPTIONALITY_KIND = 'exceptionality_kind';

    /**
     * @return ExceptionalityKind
     */
    public static function getIt()
    {
        return static::getEnum(static::getKind());
    }

    /**
     * @return string
     */
    public static function getKind()
    {
        if (static::class === __CLASS__) {
            throw new \LogicException(
                'The base exceptionality class ' . __CLASS__ . ' has no kind. It is just a base for others.'
            );
        }

        return static::getTypeName();
    }

    /**
     * @param string $kind
     *
     * @return ExceptionalityKind
     */
    protected static function createByValue($kind)
    {
        $exceptionality = parent::createByValue($kind);
        /** @var $exceptionality ExceptionalityKind */
        if ($exceptionality::getKind() !== $kind) {
            throw new \LogicException(
                'Given exceptionality type ' . var_export($kind, true) .
                ' results into exceptionality ' . get_class($exceptionality) . ' with type ' . var_export($exceptionality::getKind(), true) . '.'
            );
        }

        return $exceptionality;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    protected static function getEnumClass($type)
    {
        $specificExceptionalityClass = parent::getEnumClass($type);
        if ($specificExceptionalityClass === __CLASS__) {
            throw new \LogicException(
                "Given exceptionality type {$type} is not paired with specific exceptionality class"
            );
        }

        return $specificExceptionalityClass;
    }

    public static function registerSelfKind()
    {
        return static::addSubTypeEnum(
            static::class,
            '~^' . static::getKind() . '$~'
        );
    }

}
