<?php

/**
 * default actions.
 *
 * @package    facpubs2
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function execute404(sfWebRequest $request)
  {
  }
  
  public function execute500(sfWebRequest $request)
  {
  }
}
