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
    foreach ($rows as $row) {
      $installs = $data[$row[0]][0][1];
      $sorted_rows[$installs] = $row;
    }
    ksort($sorted_rows);
    $sorted_rows = array_reverse($sorted_rows);
    $sorted_rows = array_values($sorted_rows);

    foreach ($sorted_rows as $delta => &$sorted_row) {
      array_unshift($sorted_row, $delta + 1);
    }
    return $sorted_rows;
  }

  /**
   * {@inheritdoc}
   */
  protected function getHeader() {
    return array_merge(['Rank'], parent::getHeader());
  }

}
