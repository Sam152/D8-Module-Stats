<?php

namespace stats\Stats;

use stats\DataPointInterface;

class MonthGrowth implements DataPointInterface {

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return 'Growth (month)';
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    if ($moduleData[4][1]) {
      return round(((($moduleData[0][1] - $moduleData[4][1]) / $moduleData[4][1]) * 100), 1) . '%';
    }
    return 'N/A';
  }

}
