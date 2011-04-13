<?php

/**
 * School form.
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SchoolForm extends BaseSchoolForm
{
  public function configure()
  {
    $this->widgetSchema['facultys_list']->setLabel('Faculty');
    $this->widgetSchema['facultys_list']->setOption('method', 'getReversedName');
    $this->widgetSchema['facultys_list']->setOption('order_by', array('last_name asc, first_name asc', ''));

    sfProjectConfiguration::getActive()->loadHelpers('Url');

    $this->widgetSchema['facultys_list'] = new ynWidgetAjaxAutocomplete(
      array(
        'label'           => 'Faculty',
        'noscript_widget' => $this->widgetSchema['facultys_list'],
        'source'          => url_for( 'ynwidgetajax/faculty' ),
        'item_route'      => url_for( 'faculty/edit?id=999999' ),
        'aux_url'         => url_for( 'faculty/new' ),
        'aux_link_text'   => 'Create a new faculty',
      )
    );
  }
}
