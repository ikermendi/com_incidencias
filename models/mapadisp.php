<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');

class IncidenciasModelMapadisp extends JModel
{
	public function getDispositivos($uid, $localidades)
	{
		$db =& JFactory::getDBO();
			
		$query = "select * from dispositivo";

		$db->setQuery((string)$query);
		$dispositivos = $db->loadObjectList();
		return $dispositivos;
	}
}