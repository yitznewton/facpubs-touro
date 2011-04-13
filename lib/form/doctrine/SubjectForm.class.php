<?php

/**
 * Subject form.
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SubjectForm extends BaseSubjectForm
{
  public function configure()
  {
    unset( $this['publications_list'] );
  }
}
