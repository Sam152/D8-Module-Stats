<?php

namespace stats\DataPoints;

use stats\DataPointInterface;
use stats\Number;

/**
 * Get new installs since the previous week.
 */
class NewInstalls implements DataPointInterface {

  protected $total = 0;

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return "New installs";
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    $installs = $moduleData[0][1] - $moduleData[1][1];
    $this->total += $installs;
    $prefix = $installs > 0 ? '+' : '';
    return $prefix . Number::format($installs);
  }

  /**
   * {@inheritdoc}
   */
  public function getTotal() {
    return Number::format($this->total);
  }

}
