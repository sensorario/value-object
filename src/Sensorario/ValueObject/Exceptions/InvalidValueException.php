<?php

/**
 * This file is part of sensorario/value-object repository
 *
 * (c) Simone Gentili <sensorario@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sensorario\ValueObject\Exceptions;

use Exception;

/**
 * This expception is thrown when code try to assign a not allowed value to a propery
 */
final class InvalidValueException extends Exception { }