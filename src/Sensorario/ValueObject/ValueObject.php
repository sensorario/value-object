<?php

/**
 * Value Object base class.
 * This class aims to be a base class for all kind of Value Objects.
 *
 * @author Simone Gentili
 */

/**
 * @todo complete this dock bloc comment
 * @author Simone Gentili
 */
namespace Sensorario\ValueObject;

use RuntimeException;

/**
 * A Value Object implementation in php.
 */
abstract class ValueObject
{
    /**
     * $properties array the properties of the concept whole.
     */
    protected $properties = [];

    /**
     * Automatically manage getters with magic methods.
     * For each property called propertyX, is possible to call a method propertyX() tha returns that property.
     * And is possible to override this method, simply creating it: __call is called only when a REAL method does not
     * exists.
     *
     * @param string $functionName function name
     * @param array  $arguments    arguments passed to that function
     * {@example test/unit/Sensorario/ValueObject/ValueObjectTest.php 50 61}
     */
    public function __call($functionName, $arguments)
    {
        return $this->properties[
            $key = strtolower($functionName)
        ];
    }

    /**
     * The constructor.
     * The keyworkd __construct does not tell to developers what this method does.
     * Enforcing developers to use a more speaking API, it could be better the creation of new instance throw public
     * static methods.
     *
     * @param array $properties all the properties of the Value Object
     */
    protected function __construct(array $properties)
    {
        $this->properties = $properties;

        $this->ensureMandatoryProperties();
        $this->ensureAllowedProperties();
    }

    /**
     * Mandatory properties.
     * All mandatory properties must be defined. In contrary, an exception is thrown.
     *
     * @todo create a MissingMandatoryException class
     * @throws RuntimeException if mandatory parameter is not configured
     */
    protected function ensureMandatoryProperties()
    {
        foreach ($this->mandatory() as $key) {
            if (!isset($this->properties[$key])) {
                throw new RuntimeException(
                    "Property $key is mandatory but not set"
                );
            }
        }
    }

    /**
     * Allowed properties.
     * If a not allowed keyword is used, an exception is thrown.
     *
     * @todo create a NotallowedParameterException class
     * @throws RuntimeException if not allowed parameter is set
     */
    protected function ensureAllowedProperties()
    {
        $allowed = array_merge(
            $this->allowed(),
            $this->mandatory()
        );

        foreach ($this->properties as $key => $property) {
            if (!in_array($key, $allowed)) {
                throw new RuntimeException(
                    "Key $key is not allowed"
                );
            }
        }
    }

    /**
     * Generic constructor.
     * This method aims to generate all Value Objects.
     *
     * @param array $properties the list of properties to be used to create new instance of current value object.
     *
     * @return ValueObject new ValueObject instance
     */
    public static function box(array $properties)
    {
        return new static(
            $properties
        );
    }

    /**
     * Mandatory properties.
     * This method returns the array corresponding to the list of all mandatory properties.
     *
     * @return array the array of mandatory properties
     */
    protected static function mandatory()
    {
        return [];
    }

    /**
     * Allowed properties.
     * This method returns the array corresponding to the list of all allowed properties.
     *
     * @return array the array of allowed properties
     */
    protected static function allowed()
    {
        return [];
    }
}
