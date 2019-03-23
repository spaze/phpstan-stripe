<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Reflection\Stripe;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\Php\UniversalObjectCrateProperty;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

class RequestProperty implements PropertiesClassReflectionExtension
{

	/** @var string[][] */
	private $properties = [];


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
		return new UniversalObjectCrateProperty($classReflection, $this->getTypeFromString($this->properties[$classReflection->getName()][$propertyName]));
	}


	private function getTypeFromString(string $typeString): Type
	{
		$types = [];
		$parts = explode('|', $typeString);
		foreach ($parts as $part) {
			switch ($part) {
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
				case 'array':
					$type = new ArrayType(new MixedType(), new MixedType());
					break;
				default:
					$matches = [];
					if (preg_match('/^(.*)::class$/', $part, $matches)) {
						$type = new ObjectType($matches[1]);
					} else {
						throw new ShouldNotHappenException("Unknown type {$part}");
					}
					break;
			}
			$types[] = $type;
		}
		return TypeCombinator::union(...$types);
	}

}
