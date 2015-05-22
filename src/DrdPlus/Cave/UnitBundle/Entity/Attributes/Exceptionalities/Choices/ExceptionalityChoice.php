<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

/* abstract */ class ExceptionalityChoice extends SelfTypedStrictStringEnum
{
    const EXCEPTIONALITY_CHOICE = 'exceptionality_choice';

    /**
     * @return ExceptionalityChoice
     */
    public static function getIt()
    {
        return static::getEnum(static::getChoice());
    }

    /**
     * @return string
     */
    /* abstract */ public static function getChoice()
    {
        if (static::class === __CLASS__) {
            throw new \LogicException(
                'The base exceptionality choice class ' . __CLASS__ . ' has no choice. It is just a base for others.'
            );
        }

        return static::getTypeName();
    }

    /**
     * @param string $choice
     *
     * @return ExceptionalityChoice
     */
    protected static function createByValue($choice)
    {
        $exceptionality = parent::createByValue($choice);
        /** @var $exceptionality ExceptionalityChoice */
        if ($exceptionality::getChoice() !== $choice) {
            throw new \LogicException(
                'Given exceptionality choice ' . var_export($choice, true) .
                ' results into exceptionality ' . get_class($exceptionality) . ' with choice ' . var_export($exceptionality::getChoice(), true) . '.'
            );
        }

        return $exceptionality;
    }

    /**
     * @param string $choice
     *
     * @return string
     */
    protected static function getEnumClass($choice)
    {
        $specificExceptionalityClass = parent::getEnumClass($choice);
        if ($specificExceptionalityClass === __CLASS__) {
            throw new \LogicException(
                "Given exceptionality choice {$choice} is not paired with specific exceptionality class"
            );
        }

        return $specificExceptionalityClass;
    }

    /**
     * @return bool
     */
    public static function registerSelfChoice()
    {
        return static::addSubTypeEnum(
            static::class,
            '~^' . static::getChoice() . '$~'
        );
    }
}
