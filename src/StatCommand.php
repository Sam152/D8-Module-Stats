<?php

namespace stats;

use Guzzle\Http\Client;
use stats\Stats\Installs;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * A command to get some module stats.
 */
class StatCommand extends Command {

  /**
   * The list of modules to get.
   *
   * @var array
   */
  protected $moduleList = [];

  /**
   * An HTTP client.
   *
   * @var \Guzzle\Http\Client
   */
  protected $httpClient;

  /**
   * Stats to calculate.
   *
   * @var array
   */
  protected $stats = [];

  /**
   * Downloaded module data.
   *
   * @var array
   */
  protected $moduleData = [];

  /**
   * The name of the command.
   *
   * @var string
   */
  protected $commandName = 'table';

  /**
   * {@inheritdoc}
   */
  public function __construct(Client $httpClient, $moduleList, $dataPoints) {
    parent::__construct($this->commandName);
    $this->moduleList = $moduleList;
    $this->httpClient = $httpClient;
    $this->dataPoints = $dataPoints;
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $table = new Table($output);
    $table->setHeaders($this->getHeader());
    $table->setRows($this->getRows());
    $table->render();
  }

  /**
   * Get the table rows.
   */
  protected function getRows() {
    $rows = [];
    foreach ($this->getModuleData() as $module_name => $moduleData) {
      $row = &$rows[];
      $row[] = $module_name;
      foreach ($this->dataPoints as $stat) {
        $row[] = $stat->getDataPoint($moduleData);
      }
    }

    $total_row = ['Total'];
    foreach ($this->dataPoints as $stat) {
      $total_row[] = $stat->getTotal();
    }
    $rows[] = $total_row;

    return $rows;
  }

  /**
   * Get module data keyed by module name.
   */
  protected function getModuleData() {
    if (empty($this->moduleData)) {
      foreach ($this->moduleList as $module) {
        $this->moduleData[$module] = $this->downloadModuleData($module);
      }
    }
    return $this->moduleData;
  }

  /**
   * Download module data from d.org for a single module
   *
   * @param string $module
   *   The module to get data for.
   *
   * @param array
   *   An array of data points.
   */
  protected function downloadModuleData($module) {
    $response = $this->httpClient->get(sprintf('https://www.drupal.org/project/usage/%s', $module))->send();
    preg_match('/{"label":"8\.x","data":(?<json>.*?)},/', $response->getBody(), $matches);
    return array_reverse(json_decode($matches['json']));
  }

  /**
   * Get the table header.
   */
  protected function getHeader() {
    $header = ['Module'];
    foreach ($this->dataPoints as $stat) {
      $header[] = $stat->getLabel();
    }
    return $header;
  }

}
