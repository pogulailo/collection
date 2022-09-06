<?php

declare(strict_types=1);

namespace Pogulailo\Collection;

use ArrayObject;
use InvalidArgumentException;

class GenericCollection extends ArrayObject
{
    private string $type;

    /**
     * @param string $type
     * @param mixed ...$values
     */
    public function __construct(string $type, ...$values)
    {
        if (empty($type)) {
            throw new InvalidArgumentException('Type cannot be empty');
        }

        $this->validateValue($type, ...$values);

        $this->type = $type;
        parent::__construct($values);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function append($value): void
    {
        $this->validateValue($this->type, $value);
        parent::append($value);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->validateValue($this->type, $value);
        parent::offsetSet($key, $value);
    }

    /**
     * @param string $type
     * @param ...$values
     *
     * @return void
     */
    private function validateValue(string $type, ...$values): void
    {
        foreach ($values as $element) {
            if (!$element instanceof $type) {
                throw new InvalidArgumentException('All values must be of type ' . $type);
            }
        }
    }
}
