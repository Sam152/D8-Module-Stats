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
    return round(((($moduleData[0][1] - $moduleData[4][1]) / $moduleData[4][1]) * 100), 1) . '%';
  }

}
