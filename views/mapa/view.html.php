<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 

class IncidenciasViewMapa extends JView
{
	function display($tpl = null) 
	{
			
		$uid = JFactory::getUser()->id;
		$model =& $this->getModel();
		$this->localidades = $model->getLocalidades($uid);
		$this->dispositivos = $model->getDispositivos($uid, $this->localidades);
		
		$this->content = "var neighborhoods = [";
		$size = count($this->dispositivos);
		$addtext = '';
	
		for ($i=0; $i < $size ; $i++) { 
			$text = '';
			$dispositivo = $this->dispositivos[$i];
			$text = "new google.maps.LatLng($dispositivo->latitud, $dispositivo->longitud)";
			if($i+1 != $size)
				$text = $text . ", ";
			$addtext = $addtext . $text;
		}
		
		$this->content = $this->content . $addtext . "];";
		$this->content = $this->content . "var contentString = [";
		$addtext = '';

		for ($i=0; $i < $size ; $i++) { 
			$text = '';
			$dispositivo = $this->dispositivos[$i];
			$text = "'<h3><a href=index.php?option=com_incidencias&view=listadisp&disp=$dispositivo->iddispositivo>Dispositivo: " . $dispositivo->iddispositivo . "</a></h3>";
			$text = $text . "Latitud: " . $dispositivo->latitud . "<br>Longitud: " . $dispositivo->longitud . "'";
			if($i+1 != $size)
				$text = $text . ", ";
			$addtext = $addtext . $text;
		}
		
		$this->content = $this->content . $addtext . "];";
		$this->content = $this->content . "var estado = [";
		
		$addtext = '';
		for ($i=0; $i < $size ; $i++) { 
			$text = '';
			$dispositivo = $this->dispositivos[$i];
			$text = $dispositivo->idestadoDisp;
			if($i+1 != $size)
				$text = $text . ", ";
			$addtext = $addtext . $text;
		}
		
		$this->content = $this->content . $addtext . "];";
		$this->content = $this->content . "setData(neighborhoods, contentString, estado);";
		
		parent::display($tpl);
	}
}