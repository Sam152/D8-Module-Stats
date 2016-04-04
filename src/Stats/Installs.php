<?php

namespace stats\Stats;

use stats\DataPointInterface;

class Installs implements DataPointInterface {

  protected $week = 0;

  function __construct($week = NULL) {
    if ($week) {
      $this->week = $week;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return 'Installs' . ($this->week ? " (-{$this->week} week)" : '');
  }

  /**
   * {@inheritdoc}
   */
  public function getDataPoint($moduleData) {
    return $moduleData[$this->week][1];
  }

}
