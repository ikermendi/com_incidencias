<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 

class IncidenciasViewMapa extends JView
{
	function display($tpl = null) 
	{
		/*$uid = JFactory::getUser()->id;
		$model =& $this->getModel();
		$this->mensajes = $model->getMensajes($uid);
		$this->comentarios = array();
                $this->uid_sin = $uid;
		if (empty($this->mensajes))
		{
			$this->mensajes = null;	
		} else {
			$count = count($this->mensajes);
			for ($i=0; $i < $count ; $i++) {
				$id_msg = $this->mensajes[$i]->msg_id;
				$this->comentarios[$id_msg] = $model->getComentarios($id_msg);
			}
		}*/
		$this->prueba = "Prueba";
		$this->content = "var neighborhoods = [
		    new google.maps.LatLng(52.511467, 13.447179),
		    new google.maps.LatLng(52.549061, 13.422975),
		    new google.maps.LatLng(52.497622, 13.396110),
		    new google.maps.LatLng(52.517683, 13.394393)
		  ];
			var contentString = ['lulu', 'lala', 'lolo', 'lili'];

			setData(neighborhoods, contentString);";
			
		parent::display($tpl);
	}
}