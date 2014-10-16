<?php

namespace Flagbit\Math\Tests;

use Flagbit\Math\Decimal;

class DecimalTest extends \PHPUnit_Framework_TestCase
{
    public function provideConstructToString()
    {
        return array(
            array(0.1, 1, '0.1'),
            array(0.00001, 5, '0.00001'),
            array(0.000000001, 9, '0.000000001'),
        );
    }

    /**
     * @dataProvider provideConstructToString
     */
    public function testConstructToString($decimal, $scale, $result)
    {
        $this->assertEquals($result, (string) new Decimal($decimal, $scale));
    }

    public function provideDivide()
    {
        return array(
            array(10, 0, 0.00001, 5, '1000000'),
        );
    }

    /**
     * @dataProvider provideDivide
     */
    public function testDivide($dividend, $dividendScale, $divisor, $divisorScale, $result)
    {
        $dividend = new Decimal($dividend, $dividendScale);
        $this->assertEquals($result, (string) $dividend->divide(new Decimal($divisor, $divisorScale)));
    }
}
