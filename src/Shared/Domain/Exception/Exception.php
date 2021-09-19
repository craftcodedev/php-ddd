<?php


namespace App\Shared\Domain\Exception;


class Exception extends \Exception
{
    public $text;
    public $parameters;

    public function __construct($text = "", array $parameters = [], int $code = 0, \Throwable $previous = null)
    {
        $this->text = $text;
        $this->parameters = $parameters;
        $this->message = strtr($this->text, $this->parameters);

        parent::__construct($this->message, $code, $previous);
    }

    public static function create(string $message)
    {
        $exception =  new static($message, []);

        return $exception;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}