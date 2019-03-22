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
		switch (strtolower($typeString)) {
			case 'int':
				return new IntegerType();
			case 'bool':
				return new BooleanType();
			case 'string':
				return new StringType();
			case 'float':
				return new FloatType();
			case 'array':
				return new ArrayType(new MixedType(), new MixedType());
			default:
				$matches = [];
				if (preg_match('/^(.*)::class$/', $typeString, $matches)) {
					return new ObjectType($matches[1]);
				} else {
					throw new ShouldNotHappenException("Unknown type {$typeString}");
				}
		}
	}

}
