<?php

namespace stats\Stats;

use stats\DataPointInterface;

class Installs implements DataPointInterface {

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return 'Installs';
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    return $moduleData[0][1];
  }

}
