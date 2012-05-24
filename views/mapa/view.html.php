<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 

class IncidenciasViewMapa extends JView
{
	function display($tpl = null) 
	{
		
		/*$this->content = "var neighborhoods = [
		    new google.maps.LatLng(52.511467, 13.447179),
		    new google.maps.LatLng(52.549061, 13.422975),
		    new google.maps.LatLng(52.497622, 13.396110),
		    new google.maps.LatLng(52.517683, 13.394393)
		  ];
			var contentString = ['lulu', 'lala', 'lolo', 'lili'];

			setData(neighborhoods, contentString);";*/
			
		$uid = JFactory::getUser()->id;
		$model =& $this->getModel();
		$this->localidades = $model->getLocalidades($uid);
		$this->dispositivos = $model->getEstadoDispositivos($uid, $this->localidades);
		
		$this->content = "var neighborhoods = [";
		$size = count($this->dispositivos);
		$addtext = '';
		
		for ($i=0; $i < $size ; $i++) { 
			$text = '';
			$dispositivo = $this->dispositivos[$i];
			$text = "new google.maps.LatLng($dispositivo->latitud, $dispositivo->longitud)";
			if($i+1 != $size)
				echo ", ";
			$addtext = $addtext . $text;
		}
		
		$this->content = $this->content . $addtext . "];";
		$this->content = $this->content . "var contentString = [";
		$addtext = '';

		for ($i=0; $i < $size ; $i++) { 
			$text = '';
			$dispositivo = $this->dispositivos[$i];
			$text = "'$dispositivo->idestadoDisp'";
			if($i+1 != $size)
				echo ", ";
			$addtext = $addtext . $text;
		}
		
		$this->content = $this->content . $addtext . "];";
		$this->content = $this->content . "setData(neighborhoods, contentString);";
		
		parent::display($tpl);
	}
}