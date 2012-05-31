<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 

class IncidenciasViewListaDisp extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
		$disp = JRequest::getCmd('disp', '1');
		$model =& $this->getModel();
		$this->listaIncidencias = $model->getListaIncidencias($disp);
		parent::display($tpl);
	}

}