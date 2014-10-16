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

            array(-0.1, 1, '-0.1'),
            array(-0.00001, 5, '-0.00001'),
            array(-0.000000001, 9, '-0.000000001'),

            array('0.003', 3, '0.003'),
            array('-0.003', 3, '-0.003'),
        );
    }

    /**
     * @dataProvider provideConstructToString
     */
    public function testConstructToString($decimal, $scale, $result)
    {
        $this->assertEquals($result, (string) new Decimal($decimal, $scale));
    }

    public function provideAdd()
    {
        return array(
            array(10, 0, 0.00001, 5, '10.00001'),
            array(0.5, 1, 0.1, 1, '0.6'),
            array(0.86, 2, -0.065, 3, '0.795'),
        );
    }

    /**
     * @dataProvider provideAdd
     */

    public function testAdd($addend, $addendScale, $augend, $augendScale, $sum)
    {
        $addend = new Decimal($addend, $addendScale);
        $this->assertEquals($sum, (string) $addend->add(new Decimal($augend, $augendScale)));
    }

    public function provideDivide()
    {
        return array(
            array(10, 0, 0.00001, 5, '1000000'),
            array(0.5, 1, 0.1, 1, '5'),
        );
    }

    /**
     * @dataProvider provideDivide
     */
    public function testDivide($dividend, $dividendScale, $divisor, $divisorScale, $quotient)
    {
        $dividend = new Decimal($dividend, $dividendScale);
        $this->assertEquals($quotient, (string) $dividend->divide(new Decimal($divisor, $divisorScale)));
    }

    public function provideMultiply()
    {
        return array(
            array(0.44, 2, 0.5, 1, '0.22'),
            array(0.44, 2, 5, 0, '2.20'),
        );
    }

    /**
     * @dataProvider provideMultiply
     */
    public function testMultiply($multiplier, $multiplierScale, $multiplicand, $multiplicandScale, $product)
    {
        $multiplier = new Decimal($multiplier, $multiplierScale);
        $this->assertEquals($product, (string) $multiplier->multiply(new Decimal($multiplicand, $multiplicandScale)));
    }

    public function provideSubtract()
    {
        return array(
            array(1.1, 1, 0.7, 1, '0.4'),
        );
    }

    /**
     * @dataProvider provideSubtract
     */

    public function testSubtract($minuend, $minuendScale, $subtrahend, $subtrahendScale, $difference)
    {
        $minuend = new Decimal($minuend, $minuendScale);
        $this->assertEquals($difference, (string) $minuend->subtract(new Decimal($subtrahend, $subtrahendScale)));
    }
}
