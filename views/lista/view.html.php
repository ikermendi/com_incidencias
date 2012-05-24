<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 

class IncidenciasViewLista extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
		$uid = JFactory::getUser()->id;
		$model =& $this->getModel();
		$this->listaIncidencias = $model->getListaIncidencias($uid);
				
		
		// Display the view
		parent::display($tpl);
	}

}