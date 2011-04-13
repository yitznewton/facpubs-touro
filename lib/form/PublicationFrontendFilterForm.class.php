<?php

class PublicationFrontendFilterForm extends sfFormSymfony
{
  public function configure()
  {
    $this->setWidgets(array(
      'q'       => new sfWidgetFormInputText(array('label' => 'Words')),
      'year'    => new sfWidgetFormInputText(),
      'subject' => new sfWidgetFormDoctrineChoice(array(
        'multiple'  => false,
        'model'     => 'Subject',
        'order_by'  => array('name', 'asc'),
        'add_empty' => true,
      )),
      'type'        => new sfWidgetFormDoctrineChoice(array(
        'model'     => 'PublicationType',
        'add_empty' => true,
        'order_by'  => array('name', 'asc'),
      )),
    ));

    $this->setValidators(array(
      'q'       => new sfValidatorPass(array('required' => false)),
      'year'    => new sfValidatorPass(array('required' => false)),
      'type'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'PublicationType', 'column' => 'id')),
      'subject' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Subject', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('%s');
    $this->widgetSchema->setIdFormat('filter-field-%s');
    $this->widgetSchema->setFormFormatterName('list');

    $this->validatorSchema->setOption('allow_extra_fields', true);

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->disableLocalCSRFProtection();
  }
}
