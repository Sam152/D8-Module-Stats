<?php

namespace stats\Stats;

use stats\DataPointInterface;

class WeekGrowth implements DataPointInterface {

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return 'Growth (week)';
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    return ((($moduleData[0][1] - $moduleData[1][1]) / $moduleData[1][1]) * 100) . '%';
  }

}
