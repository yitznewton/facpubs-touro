<?php

/**
 * Faculty filter form base class.
 *
 * @package    facpubs2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFacultyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'last_name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'              => new sfWidgetFormFilterInput(),
      'deleted_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'publications_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Publication')),
      'schools_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'School')),
    ));

    $this->setValidators(array(
      'last_name'         => new sfValidatorPass(array('required' => false)),
      'first_name'        => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'              => new sfValidatorPass(array('required' => false)),
      'deleted_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'publications_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Publication', 'required' => false)),
      'schools_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'School', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('faculty_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPublicationsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.FacultyPublication FacultyPublication')
      ->andWhereIn('FacultyPublication.publication_id', $values)
    ;
  }

  public function addSchoolsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('FacultySchool.school_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Faculty';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'last_name'         => 'Text',
      'first_name'        => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'slug'              => 'Text',
      'deleted_at'        => 'Date',
      'publications_list' => 'ManyKey',
      'schools_list'      => 'ManyKey',
    );
  }
}
