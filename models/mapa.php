<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');

class IncidenciasModelMapa extends JModel
{
	public function getEstadoDispositivos($uid, $localidades)
	{
		$db =& JFactory::getDBO();
		$text = '';
		
		foreach ($localidades as $localidad) {
			$text = " idlocalidad = " . $localidad->idlocalidad;
		}
		
		$query = "select * from dispositivo where" . $text;
		$db->setQuery((string)$query);
		$dispositivos = $db->loadObjectList();
		return $dispositivos;
	}
	
	public function getLocalidades($uid)
	{
		$db =& JFactory::getDBO();
		$query = "select l.localidad, l.idlocalidad from localidad l inner join ciudad c on l.idciudad = c.idciudad  inner join sede s on s.idciudad = c.idciudad inner join empleado e on s.idsede = e.idsede where e.idempleado = ". $uid;
		$db->setQuery((string)$query);
		$localidades = $db->loadObjectList();
		return $localidades;
	}
}