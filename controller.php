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
			case 'config':
				self::config();
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
	
	private function config()
	{
		$task = JRequest::getCmd('action', '');
		$model =& $this->getModel("config");
		if($task == 'safe')
		{
			$time = JRequest::getCmd('time');
			$id_disp = JRequest::getCmd('disp');
			$serverip = JRequest::getCmd('serverip');
			
			$id = JFactory::getUser()->id;
			$disp = $model->getDisp($id, $disp);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://$disp->ip/idek/nodocentral.php?time=$time&serverip=$serverip");
			curl_exec($ch);
			curl_close($ch);
			
			$model->cambiarDatos($id_disp, $time, $serverip);
			$msg = JText::_( 'Datos cambiados');
			$link = JRoute::_("index.php?option=com_incidencias&view=config&disp=$disp", false);
			$this->setRedirect($link, $msg);
		}
	}
}

