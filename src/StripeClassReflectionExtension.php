<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

class StripeClassReflectionExtension implements PropertiesClassReflectionExtension
{

	/** @var array<string, array<string, string>> */
	private $properties = [];


	/**
	 * @param array<string, string> $properties
	 */
	public function __construct(array $properties)
	{
		foreach ($properties as $property => $type) {
			list($className, $propertyName) = explode('::', $property);
			$this->properties[$className][ltrim($propertyName, '$')] = $type;
		}
	}


	public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
	{
		return isset($this->properties[$classReflection->getName()][$propertyName]);
	}


	public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
	{
		$type = $this->getTypeFromString($this->properties[$classReflection->getName()][$propertyName]);
		return new StripePropertyReflection($classReflection, $type);
	}


	private function getTypeFromString(string $typeString): Type
	{
		$types = [];
		$parts = explode('|', $typeString);
		foreach ($parts as $part) {
			switch ($part) {
				case 'null':
					$type = new NullType();
					break;
				case 'int':
					$type = new IntegerType();
					break;
				case 'bool':
					$type = new BooleanType();
					break;
				case 'string':
					$type = new StringType();
					break;
				case 'float':
					$type = new FloatType();
					break;
				default:
					$matches = [];
					if (preg_match('/^array(?:<([^,]+)(?:\s*,\s*([^,]+))?>)?$/', $part, $matches)) {
						// `array` or `array<itemType>` or `array<keyType, itemType>`
						$type = new ArrayType(
							isset($matches[1], $matches[2]) ? $this->getTypeFromString($matches[1]) : (isset($matches[1]) ? new IntegerType() : new MixedType()),
							isset($matches[2]) ? $this->getTypeFromString($matches[2]) : (isset($matches[1]) ? $this->getTypeFromString($matches[1]) : new MixedType()),
						);
					} else {
						$type = new ObjectType($part);
					}
					break;
			}
			$types[] = $type;
		}
		return TypeCombinator::union(...$types);
	}

}
