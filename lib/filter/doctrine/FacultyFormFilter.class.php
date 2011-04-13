<?php

/**
 * Faculty filter form.
 *
 * @package    facpubs2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FacultyFormFilter extends BaseFacultyFormFilter
{
  public function configure()
  {
    $this->widgetSchema['schools_list']->setOption('order_by', array('name', 'asc'));
  }
}
