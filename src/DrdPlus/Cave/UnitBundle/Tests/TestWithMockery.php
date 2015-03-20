<?php
namespace DrdPlus\Cave\UnitBundle\Tests;

class TestWithMockery extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        \Mockery::close();
    }
}
