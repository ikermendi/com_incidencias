<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');

class IncidenciasModelConfig extends JModel
{
	public function getDisp($id, $id_disp) 
	{
		$db =& JFactory::getDBO();
		$query = "select d.* from dispositivo d inner join localidad l on l.idlocalidad = d.idlocalidad inner join ciudad c on c.idciudad=l.idciudad inner join sede s on s.idciudad=c.idciudad inner join empleado e on e.idsede=s.idsede where d.iddispositivo=$id_disp and e.idempleado=$id";
				
		$db->setQuery($query);
		$disp = $db->loadObject();
		
		return $disp;
	}
	
	public function cambiarDatos($disp, $time, $serverip)
	{
		
		$db =& JFactory::getDBO();
		
		$query = "UPDATE dispositivo SET tiempo_espera = $time, ip_ws = $serverip WHERE iddispositivo = $disp";
		$db->setQuery($query);
		$db->query();
	}
	
}