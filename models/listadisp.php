<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');

class IncidenciasModelListaDisp extends JModel
{
	public function getListaIncidencias($disp) 
	{
		$db =& JFactory::getDBO();
		$query = "SELECT estado, descripcion, fecha, hora, iddispositivo, idincidencia
				  FROM estadoinci e, incidencia i
				  WHERE e.idestado =i.idestadoinci AND i.iddispositivo = $disp
				  ORDER BY fecha AND estado ASC";
				
		$db->setQuery($query);
		$incidencias = $db->loadObjectList();
		return $incidencias;
	}
}