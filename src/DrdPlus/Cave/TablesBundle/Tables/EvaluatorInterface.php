<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

interface EvaluatorInterface
{

    /**
     * @param int $maxRollToGetValue
     *
     * @return int
     */
    public function evaluate($maxRollToGetValue);
}
