<?php

/**
 * School filter form base class.
 *
 * @package    facpubs2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSchoolFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'          => new sfWidgetFormFilterInput(),
      'facultys_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Faculty')),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'slug'          => new sfValidatorPass(array('required' => false)),
      'facultys_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Faculty', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('school_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addFacultysListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.FacultySchool FacultySchool')
      ->andWhereIn('FacultySchool.faculty_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'School';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'slug'          => 'Text',
      'facultys_list' => 'ManyKey',
    );
  }
}
