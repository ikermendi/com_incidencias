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
		// Formato SocialrecView<vName>
		$view = $this->getView($vName, $vType);
		error_log("display->view: ".print_r($view,true));

		// Añadir el modelo a la vista
		if ($model = $this->getModel($vName))
			$view->setModel($model, true);

		// A que vista queremos ir
		switch ($vName)
		{
			//Si no tenemos ningun task no hay que poner esto
			//Lo dejo como ejemplo
			case 'video':
				error_log(print_r("Entrando en $vName", true));
				self::video();
				break;
			default:
				break;
		}
		
		$view->display();
		
		return $this;
	}
	
	//Lo dejo como ejemplo
	private function video()
	{
		$task = JRequest::getCmd('task', '');
		$uid =& JFactory::getUser()->id;
		if($task == 'compartir')
		{
			$idVideo = JRequest::getCmd('id');
			$model =& $this->getModel("tablon");
			$result = $model->compartirVideo($idVideo, $uid);
			$type = "message";
			if(!$result)
			{
				$msg = JText::_( 'No se ha podido compartir el video en el muro');
				$type = "error";
			}
			else
				$msg = JText::_( 'Compartido en tu muro!');
			$link = JRoute::_("index.php/component/socialrec/?view=video&id=$idVideo&Itemid=455", false);
			$this->setRedirect($link, $msg, $type);
		}
	}
}

