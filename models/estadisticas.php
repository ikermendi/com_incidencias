<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');

class IncidenciasModelEstadisticas extends JModel
{
		
	public function getCiudad($uid)
		{
			$db =& JFactory::getDBO();
			$query = "select c.idciudad, c.ciudad from ciudad c inner join sede s on s.idciudad = c.idciudad inner join empleado e on s.idsede = e.idsede where e.idempleado = ". $uid;
			$db->setQuery((string)$query);
			$localidades = $db->loadObjectList();
			return $localidades;
		}
		
	public function getPasosXLocalidad($idciudad)
	{
		$db =& JFactory::getDBO();
		$query = "select c.ciudad, l.localidad, sum(e.numPasos) AS 'cantidad'  
					from estadistica e, dispositivo d, localidad l, ciudad c
					where e.iddispositivo = d.iddispositivo
					and l.idlocalidad = d.idlocalidad
					and '$idciudad' = l.idciudad
					group by l.idlocalidad";
		$db->setQuery((string)$query);
		$numPasos = $db->loadObjectList();
		return $numPasos;
	}
	
	public function getPasosXLocalidadXDia($idciudad)
	{
		$db =& JFactory::getDBO();
		$query ="select c.ciudad, l.localidad, sum(e.numPasos) AS 'cantidad', e.fecha, day(e.fecha) AS 'eguna'
				from estadistica e, dispositivo d, localidad l, ciudad c
				where e.iddispositivo = d.iddispositivo
				and l.idlocalidad = d.idlocalidad
				and l.idciudad='$idciudad'
				and date(e.fecha) <= current_date
				and date(e.fecha)>=date(CONCAT (year(current_date),'-', month(current_date)-1,'-',day(current_date)-1))
				group by  eguna, d.idlocalidad
				order by month(e.fecha) asc, eguna";
		$db->setQuery((string)$query);
		$pasosDia = $db->loadObjectList();
		return $pasosDia;
	} 
	
	public function getIncidenciasXLocalidadXMes($idciudad)
	{
		$db =& JFactory::getDBO();
		$query ="select l.localidad, count(i.idincidencia) AS 'numInci', monthname(i.fecha) as 'month'
				from localidad l, incidencia i, dispositivo d
				where l.idlocalidad = d.idlocalidad
				and l.idciudad='$idciudad'
				and i.iddispositivo = d.iddispositivo
				group by month(i.fecha), l.idlocalidad
				order by month(i.fecha) asc";
		$db->setQuery((string)$query);
		$inciMes = $db->loadObjectList();
		return $inciMes;
	} 

}