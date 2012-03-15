<?php
require_once dirname(__FILE__).'/DoctrineUnitTestCase.php';

class unit_PublicationTest extends DoctrineUnitTestCase
{
  public function testSetCitation_English_StripsCorrectly()
  {
    $publication = new Publication();
    $publication->setCitation('<p>Hello there</p>');

    $this->assertEquals('hello there',
      $publication->getCitationStripped());
  }

  public function testSetCitation_Russian_StripsCorrectly()
  {
    $publication = new Publication();
    $publication->setCitation('<p>Hello времени </p>');

    $this->assertEquals('hello времени',
      $publication->getCitationStripped());
  }
}

