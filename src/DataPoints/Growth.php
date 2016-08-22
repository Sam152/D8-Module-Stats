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

  protected $total = [];

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
      $this->total[] = 0;
      return 'N/A';
    }
    $data = ((($moduleData[0][1] - $moduleData[$this->week][1]) / $moduleData[$this->week][1]) * 100);
    $this->total[] = $data;
    return Number::format($data, '%');
  }

  /**
   * {@inheritdoc}
   */
  public function getTotal() {
    return Number::format(array_sum($this->total) / count($this->total), '%');
  }

}
