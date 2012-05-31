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
		$query = "SELECT estado, descripcion, fecha, hora, iddispositivo, idincidencia
				  FROM estadoinci e, incidencia i
				  WHERE e.idestado =i.idestadoinci AND idempleado = '$id'
				  ORDER BY fecha AND estado ASC";
				
		$db->setQuery($query);
		$incidencias = $db->loadObjectList();
		error_log(print_r("Cogido de BD: Incidencias", true));
		error_log(print_r("Incidencias: ".$incidencias, true));
		return $incidencias;
	}
	
	public function cerrarIncidencia($id, $disp) 
	{
		//cerrar incicencia
		$db =& JFactory::getDBO();
		
		$query = "UPDATE incidencia SET idestadoInci = 2 WHERE idincidencia = $id";
		$db->setQuery($query);
		$db->query();
		
		//Si no hay mas incidencias cambiar el estado del sipositivo
		$query = "SELECT * from incidencia WHERE iddispositivo = $disp and idestadoInci = 1";
		$db->setQuery($query);
		$incidencias = $db->loadObjectList();
		
		error_log(print_r($incidencias, true));
		
		if(count($incidencias) == 0) {
			//Cambiamos el estado del dispositivo
			$query = "UPDATE dispositivo SET idestadodisp = 1 WHERE iddispositivo = $disp";
			$db->setQuery($query);
			$db->query();
		}
	}
}