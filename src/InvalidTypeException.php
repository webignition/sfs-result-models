<?php

namespace webignition\SfsResultModels;

class InvalidTypeException extends \Exception
{
    const MESSAGE= 'Invalid type "%s"';

    private $type;

    public function __construct(string $type)
    {
        parent::__construct(sprintf(self::MESSAGE, $type));

        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
