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
			
		// A que vista queremos ir
		switch ($vName)
		{
			case 'lista':
				self::lista();
				break;
			default:
				break;
		}
			
		$view->display();
		return $this;
	}
	
	private function lista()
	{
		$task = JRequest::getCmd('task', '');
		$model =& $this->getModel("lista");
		if($task == 'cerrar')
		{
			$id = JRequest::getCmd('id');
			$disp = JRequest::getCmd('disp');
			$model->cerrarIncidencia($id, $disp);
			$msg = JText::_( 'Incidencia cerrada');
			$link = JRoute::_('index.php?option=com_incidencias&view=lista', false);
			$this->setRedirect($link, $msg);
		}
	}
}

