<?php

namespace Flagbit\Math;

/**
 * Decimal class for PHP
 *
 * Provides a (relatively) safe way to handle fixed precision values in
 * your application.
 *
 * The API is roghly based on the Java BigDecimal API.
 */
class Decimal
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $scale;

    /**
     * @param mixed $value
     * @param int  $scale
     */
    public function __construct($value, $scale)
    {
        $this->scale = (int) $scale;

        if (is_float($value)) {
            $value = number_format($value, $this->scale);
        }

        $this->value = (string) $value;
    }

    /**
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param Decimal $augend
     *
     * @return Decimal
     */
    public function add(Decimal $augend)
    {
        $scale = max($this->scale, $augend->getScale());
        return new Decimal(bcadd($this, $augend, $scale), $scale);
    }

    /**
     * @param Decimal $divisor
     *
     * @return Decimal
     */
    public function divide(Decimal $divisor)
    {
        $scale = max($this->scale, $divisor->getScale());
        return new Decimal(bcdiv($this, $divisor, $scale), $scale);
    }

    /**
     * @param Decimal $multiplicand
     *
     * @return Decimal
     */
    public function multiply(Decimal $multiplicand)
    {
        $scale = max($this->scale, $multiplicand->getScale());
        return new Decimal(bcmul($this, $multiplicand, $scale), $scale);
    }

    /**
     * @param Decimal $subtrahend
     *
     * @return Decimal
     */
    public function subtract(Decimal $subtrahend)
    {
        $scale = max($this->scale, $subtrahend->getScale());
        return new Decimal(bcsub($this, $subtrahend, $scale), $scale);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
