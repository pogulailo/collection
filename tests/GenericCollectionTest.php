<?php

namespace Pogulailo\Collection\Tests;

use ArrayObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Pogulailo\Collection\GenericCollection;
use stdClass;

/**
 * @covers \Pogulailo\Collection\GenericCollection
 */
class GenericCollectionTest extends TestCase
{
    /**
     * @return void
     */
    public function testReturnsCorrectType(): void
    {
        $collection = new GenericCollection(ArrayObject::class);
        $this->assertSame(ArrayObject::class, $collection->getType());
    }

    /**
     * @return void
     */
    public function testEmptyTypeProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->matchesRegularExpression('/cannot be empty/');
        new GenericCollection('');
    }

    /**
     * @return void
     */
    public function testInstantiateWithRightType(): void
    {
        $elements = [new ArrayObject(), new ArrayObject()];
        $collection = new GenericCollection(ArrayObject::class, ...$elements);

        foreach ($elements as $key => $value) {
            $this->assertSame($value, $collection[$key]);
        }
    }

    /**
     * @return void
     */
    public function testInstantiateWithWrongType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->matchesRegularExpression('/values must be of type/');

        new GenericCollection(ArrayObject::class, new stdClass());
    }

    /**
     * @return void
     */
    public function testAppendWithRightType(): void
    {
        $element = new ArrayObject();

        $collection = new GenericCollection(ArrayObject::class);
        $collection->append($element);

        $this->assertSame($element, $collection[0]);
    }

    /**
     * @return void
     */
    public function testAppendWithWrongType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->matchesRegularExpression('/values must be of type/');

        $collection = new GenericCollection(ArrayObject::class);
        $collection->append(new stdClass());
    }

    /**
     * @return void
     */
    public function testOffsetSetWithRightType(): void
    {
        $element = new ArrayObject();

        $collection = new GenericCollection(ArrayObject::class);
        $collection[0] = $element;

        $this->assertSame($element, $collection[0]);
    }

    /**
     * @return void
     */
    public function testOffsetSetWithWrongType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->matchesRegularExpression('/values must be of type/');

        $collection = new GenericCollection(ArrayObject::class);
        $collection[0] = new stdClass();
    }
}
