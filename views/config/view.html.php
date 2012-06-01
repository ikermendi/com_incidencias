<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 

class IncidenciasViewConfig extends JView
{
	function display($tpl = null) 
	{
		
		$disp = JRequest::getCmd('disp', '-1');
		$id = JFactory::getUser()->id;
		$model =& $this->getModel();
		$this->disp = $model->getDisp($id, $disp);
		parent::display($tpl);
	}
}