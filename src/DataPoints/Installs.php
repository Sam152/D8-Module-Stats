<?php

namespace stats\DataPoints;

use stats\DataPointInterface;
use stats\Number;

/**
 * Get installs from a specific week.
 */
class Installs implements DataPointInterface {

  protected $total = 0;

  /**
   * Which week to grab installs from.
   *
   * @var int
   */
  protected $week;

  function __construct($label, $week) {
    $this->week = $week;
    $this->label = $label;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return "Installs {$this->label}";
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    $this->total += $moduleData[$this->week][1];
    return Number::format($moduleData[$this->week][1]);
  }

  /**
   * {@inheritdoc}
   */
  public function getTotal() {
    return Number::format($this->total);
  }

}
