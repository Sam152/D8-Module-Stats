<?php

namespace stats;

class TopCommand extends StatCommand {

  protected $commandName = 'top';

  /**
   * {@inheritdoc}
   */
  protected function getRows() {
    $rows = parent::getRows();
    $data = $this->getModuleData();
    $sorted_rows = [];
    foreach ($rows as $delta => $row) {
      $installs = $data[$row[0]][0][1];
      // Add the rank.
      array_unshift($row, $delta+1);
      $sorted_rows[$installs] = $row;
    }
    ksort($sorted_rows);
    $sorted_rows = array_reverse($sorted_rows);
    return $sorted_rows;
  }

  /**
   * {@inheritdoc}
   */
  protected function getHeader() {
    return array_merge(['Rank'], parent::getHeader());
  }

}
