<?php


namespace App\Shared\Domain;


abstract class DateValueObject
{
    protected $value;
    const DATE_FORMAT_FULL_EN = 'Y-m-d H:i:s';
    const DATE_FORMAT_FULL_HTML_EN = 'Y-m-d\TH:i';
    const DATE_FORMAT_FULL_ES = 'd-m-Y H:i:s';

    abstract protected function __construct(\DateTime $value);

    public static function fromDateTime(\DateTime $dateTime) : static
    {
        $valueObject = new static($dateTime);

        return $valueObject;
    }

    public static function fromTimestamp(string $timestamp) : static
    {
        $date = new \DateTime();
        $date->setTimestamp($timestamp);

        return new static($date);
    }

    public static function fromString(string $dateTime, $format = self::DATE_FORMAT_FULL_EN) : static
    {
        $date = \DateTime::createFromFormat($format, $dateTime);

        return new static($date);
    }

    public static function byDefault() : static
    {
        $date = new \DateTime();
        return new static($date);
    }

    public function toString(string $format = self::DATE_FORMAT_FULL_EN): string
    {
        return $this->value()->format($format);
    }

    public function equals(self $stringValueObject)
    {
        $value = StringValueObject::fromDate($this->value(), self::DATE_FORMAT_FULL_EN);
        $newValue = StringValueObject::fromDate($stringValueObject->value(), self::DATE_FORMAT_FULL_EN);
        return ($value->value() === $newValue->value());
    }

    public function value(): \DateTime
    {
        return $this->value;
    }
}