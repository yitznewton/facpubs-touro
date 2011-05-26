<?php

/**
 * Publication form.
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PublicationForm extends BasePublicationForm
{
  public function configure()
  {
    unset(
      $this['citation_stripped'],
      $this['created_at'],
      $this['updated_at'],
      $this['deleted_at']
    );

    $this->widgetSchema['citation'] = new sfWidgetFormTextareaTinyMCE( array(
      'width'  => 450,
      'height' => 150,
      'theme'  => 'advanced',
      'config' => '
        plugins: "paste",
        theme_advanced_buttons1: "bold,italic,separator,undo,redo,separator,cleanup,separator,link,unlink",
        theme_advanced_buttons2: "",
        theme_advanced_buttons3: "",
        theme_advanced_path: false
      ',
    ));

    $this->widgetSchema['subjects_list']->setLabel('Subjects');
    $this->widgetSchema['subjects_list']->setOption('expanded', true);
    $this->widgetSchema['subjects_list']->setOption('order_by', array('name', 'asc'));

    $this->widgetSchema['publication_type_id']->setOption('expanded', true);
    $this->widgetSchema['publication_type_id']->setOption('order_by', array('name', 'asc'));

    $this->widgetSchema['facultys_list']->setLabel('Faculty');
    $this->widgetSchema['facultys_list']->setOption('method', 'getReversedName');
    $this->widgetSchema['facultys_list']->setOption('order_by', array('last_name asc, first_name asc', ''));

    sfProjectConfiguration::getActive()->loadHelpers('Url');

    $this->validatorSchema['citation'] = new sfValidatorString( array(
      'required' => true,
    ));

    $this->validatorSchema['publication_date'] = new sfValidatorRegex( array(
      'pattern' => '/^[12][0-9]{3}$/',
    ), array(
      'invalid' => 'Please enter a year.',
    ));
  }
}
