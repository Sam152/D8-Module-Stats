<?php

namespace stats;

/**
 * An interface for extracting stats from module install data.
 */
interface DataPointInterface {

  /**
   * Get the label of the stat.
   *
   * @return string
   */
  public function getLabel();

  /**
   * Get the data point.
   *
   * @param array $moduleData
   *   The module data.
   * @return string
   *   The data point.
   */
  public function getDataPoint($moduleData);

  /**
   * Gets the total for the data point.
   *
   * @return float
   *   The total.
   */
  public function getTotal();

}
