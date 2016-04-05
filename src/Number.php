<?php

namespace stats;

/**
 * Help with numbers.
 */
class Number {

  /**
   * Format a number.
   *
   * @param $number
   *   The number.
   * @param string $suffix
   *   The suffix.
   * @return string
   *   A formatted number.
   */
  public static function format($number, $suffix = '') {
    return number_format($number) . $suffix;
  }

}
