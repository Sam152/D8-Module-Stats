<?php

namespace stats\DataPoints;

use stats\DataPointInterface;
use stats\Number;

/**
 * Get percentage growth.
 */
class Growth implements DataPointInterface {

  /**
   * The label for the column.
   *
   * @var string
   */
  protected $label;

  /**
   * How many weeks to go back.
   *
   * @var int
   */
  protected $week;

  public function __construct($label, $week) {
    $this->label = $label;
    $this->week = $week;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return "Growth {$this->label}";
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    if (empty($moduleData[$this->week][1])) {
      return 'N/A';
    }
    return Number::format(((($moduleData[0][1] - $moduleData[$this->week][1]) / $moduleData[$this->week][1]) * 100), '%');
  }

}
