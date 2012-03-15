<?php
require_once dirname(__FILE__).'/../../bootstrap/unit.php';

class DoctrineUnitTestCase extends sfPHPUnitBaseTestCase
{
  public static function setUpBeforeClass()
  {
    new sfDatabaseManager(
      ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true));
  }

  public function setUp()
  {
    $doctrineCreateTables = new sfDoctrineCreateModelTables(
      ProjectConfiguration::getActive()->getEventDispatcher(),
      new sfAnsiColorFormatter());

    $doctrineLoad = new sfDoctrineDataLoadTask(
      ProjectConfiguration::getActive()->getEventDispatcher(),
      new sfAnsiColorFormatter());

    $doctrineLoad->run(array('test/fixtures'), array("--env=test"));
  }
}

