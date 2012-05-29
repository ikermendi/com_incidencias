<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class IncidenciasController extends JController
{

	public function display($cachable = false, $urlparams = false)
	{		
		//Conseguir el nombre de la vista desde el parametro del request. Defecto Mapa.
		$vName = JRequest::getCmd('view', 'mapa');
		
		$document = JFactory::getDocument();
		$vType = $document->getType();

		// Conseguir la vista
		// Formato IncidenciasView<vName>
		$view = $this->getView($vName, $vType);

		// Añadir el modelo a la vista
		if ($model = $this->getModel($vName))
			$view->setModel($model, true);
		
		$view->display();
		
		return $this;
	}
}

