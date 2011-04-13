<?php

/**
 * Faculty form.
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FacultyForm extends BaseFacultyForm
{
  public function configure()
  {
    unset(
      $this['publications_list'],
      $this['created_at'],
      $this['updated_at'],
      $this['deleted_at']
    );

    $this->widgetSchema['schools_list']->setOption('label', 'Schools');
    $this->widgetSchema['schools_list']->setOption('order_by', array('name', 'asc'));
  }
}
