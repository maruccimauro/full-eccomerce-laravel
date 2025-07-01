<?php

namespace App\Enums;

trait EnumApp
{
  /**
   * Devuelve todas las constantes definidas.
   */
  public static function allConstants(): array
  {
    $reflection = new \ReflectionClass(static::class);
    return $reflection->getConstants();
  }

  /**
   * Devuelve todos los valores como array de strings.
   */
  public static function allValuesAsArray(): array
  {
    return array_values(self::allConstants());
  }

  /**
   * Devuelve todos los valores como string separado por comas.
   */
  public static function allValuesAsString(): string
  {
    return implode(',', self::allValuesAsArray());
  }

  /**
   * Devuelve true si el valor es válido.
   */
  public static function isValidValue(string $value): bool
  {
    return in_array($value, self::allValuesAsArray(), true);
  }

  /**
   * Devuelve los valores excepto los pasados (como array).
   */
  public static function exceptValuesAsArray(string ...$excluded): array
  {
    return array_values(array_filter(
      self::allValuesAsArray(),
      fn($value) => !in_array($value, $excluded, true)
    ));
  }

  /**
   * Devuelve los valores excepto los pasados (como string).
   */
  public static function exceptValuesAsString(string ...$excluded): string
  {
    return implode(',', self::exceptValuesAsArray(...$excluded));
  }

  /**
   * Devuelve solo los valores pasados (como array).
   */
  public static function onlyValuesAsArray(string ...$only): array
  {
    return array_values(array_filter(
      self::allValuesAsArray(),
      fn($value) => in_array($value, $only, true)
    ));
  }

  /**
   * Devuelve solo los valores pasados (como string).
   */
  public static function onlyValuesAsString(string ...$only): string
  {
    return implode(',', self::onlyValuesAsArray(...$only));
  }

  public static function inRule(): string
  {
    return 'in:' . self::allValuesAsString();
  }
}
