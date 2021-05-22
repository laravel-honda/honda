<?php

namespace App\Support\DTO;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use IteratorAggregate;
use ReflectionClass;
use ReflectionProperty;

class DTO implements Jsonable, Arrayable, ArrayAccess, Countable, IteratorAggregate
{
    /** @var array<class-string, ReflectionProperty[]> */
    public static array $propertiesCache = [];

    public function __construct(iterable $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function fromRequest(Request $request): DTO
    {
        $properties = static::getProperties();
        $dto        = new static();

        foreach ($properties as $property) {
            if ($request->has($property->getName())) {
                $dto->{$property->getName()} = $request->get($property->getName());
            }
        }

        return $dto;
    }

    public static function getProperties(): array
    {
        if (array_key_exists(static::class, self::$propertiesCache)) {
            return self::$propertiesCache[static::class];
        }

        $properties                           = (new ReflectionClass(static::class))->getProperties(ReflectionProperty::IS_PUBLIC);
        self::$propertiesCache[static::class] = $properties;

        return $properties;
    }

    public function fill(DTO $dto): static
    {
        $original = $this->toArray();
        $new      = $dto->toArray();
        $merged   = $original;

        foreach ($new as $key => $value) {
            if (empty($key) && !empty($original[$key])) {
                continue;
            }

            $merged[$key] = $value;
        }

        return new static($merged);
    }

    public function toArray(): array
    {
        $properties = self::getProperties();
        $array      = [];

        foreach ($properties as $property) {
            if ($property->isInitialized($this) || $property->hasDefaultValue()) {
                $array[$property->getName()] = $property->getValue($this);
            } else {
                $array[$property->getName()] = match ($property->getType()->getName()) {
                    'string' => '',
                    default  => null
                };
            }
        }

        return $array;
    }

    public function forceFill(DTO $dto): DTO
    {
        $original = $this->toArray();
        $new      = $dto->toArray();
        $merged   = $original;

        foreach ($new as $key => $value) {
            $merged[$key] = $value;
        }

        return new static($merged);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->toArray());
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    public function offsetGet($offset): mixed
    {
        return $this->toArray()[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->{$offset} = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->{$offset});
    }

    public function only(...$properties): static
    {
        return new static(array_filter(
            $this->toArray(),
            static fn ($property) => in_array($property, $properties),
            ARRAY_FILTER_USE_KEY
        ));
    }

    public function except(...$properties): static
    {
        return new static(array_filter(
            $this->toArray(),
            static fn ($property) => !in_array($property, $properties),
            ARRAY_FILTER_USE_KEY
        ));
    }

    public function count(): int
    {
        return count($this->toArray());
    }

    public function toJson($options = 0): bool | string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | $options);
    }
}
