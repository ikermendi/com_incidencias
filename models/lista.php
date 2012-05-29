<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');

class IncidenciasModelLista extends JModel
{
	public function getListaIncidencias($id) 
	{
		$db =& JFactory::getDBO();
		$query = "SELECT estado, descripcion, fecha, hora, iddispositivo
				  FROM estadoinci e, incidencia i
				  WHERE e.idestado =i.idestadoinci AND idempleado = '$id'
				  ORDER BY fecha AND estado ASC";
				
		$db->setQuery($query);
		$incidencias = $db->loadObjectList();
		error_log(print_r("Cogido de BD: Incidencias", true));
		error_log(print_r("Incidencias: ".$incidencias, true));
		return $incidencias;
	}
}