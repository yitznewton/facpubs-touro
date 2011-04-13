<?php

require_once dirname(__FILE__).'/../lib/facultyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/facultyGeneratorHelper.class.php';

/**
 * faculty actions.
 *
 * @package    facpubs2
 * @subpackage faculty
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facultyActions extends autoFacultyActions
{
  public function executeEdit(sfWebRequest $request)
  {
    parent::executeEdit( $request );

    $this->publications = $this->faculty->getPublicationsOrderByCitation();
  }
}
