<?php

// Include the library
require_once('components/com_incidencias/helpers/highcharts.php');

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');

 

class IncidenciasViewEstadisticas extends JView
{
		
	function display($tpl = null) 
	{
		$uid = JFactory::getUser()->id;
		$model =& $this->getModel();
		//$vName = JRequest::getCmd('tipo', 1);
		
		$this->content =$this->numPasosPorLocalidad($uid, $model);
        $this->div= '<div id="my_graph1" width="500" height="300"> </div>';
		
		$this->content = $this->content . $this->numPasosPorLocalidadAlDia($uid, $model);
		$this->div = $this->div . '<div id="my_graph2" width="500" height="300"> </div>';
			
		parent::display($tpl); 
	}
	
	private function numPasosPorLocalidad($uid, $model) 
	{
		
		//Se consigue la "provincia" del empleado
		$this->ciudad = $model->getCiudad($uid);
		//Con la provincia, se consigue los pasos de cada localidad de esa provincia
		$this->pasos = $model->getPasosXLocalidad($this->ciudad[0]->idciudad);
		
		$title='Numero de usuarios por pasos de cebra en '.$this->ciudad[0]->ciudad. ' agrupado por localidades';
		
		$content = "
				var chart;
				$(document).ready(function() {
					chart = new Highcharts.Chart({
						chart: {
							renderTo: 'my_graph1',
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: '"; $content = $content . $title . "' " ."
						},
				 
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								
							}
						},
						series: [{
							type: 'pie',
							name: 'Num pasos',
							data: [";
							
												
								$tmp = "";
								$size = sizeof($this->pasos);
								for($i = 0; $i < $size; $i++)
					{
						if ($i == $size-1) 
							$tmp = $tmp . "['" . $this->pasos[$i]->localidad . "', " . $this->pasos[$i]->cantidad . "]";
						else
							$tmp = $tmp . "['" . $this->pasos[$i]->localidad . "', " . $this->pasos[$i]->cantidad . "],";
						 
								
					}
					
							
							
							$content = $content . $tmp . "]
						}]
					});
				});";
	
	return $content;
	}
	
	private function numPasosPorLocalidadAlDia($uid, $model) 
	{
		
		//Se consigue la "provincia" del empleado
		$this->ciudad = $model->getCiudad($uid);
		
		//Con la provincia, se consigue los pasos de cada localidad cada dia de esa provincia
		$this->pasos = $model->getPasosXLocalidadXDia($this->ciudad[0]->idciudad);
		
		$title='Numero de usuarios por pasos de cebra al dia en '.$this->ciudad[0]->ciudad. ' agrupado por localidades';
		
		$content = "var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'my_graph2',
			type: 'line',
			marginRight: 130,
			marginBottom: 25
		},
		title: {
			text: 'Monthly Average Temperature',
			x: -20 //center
		},
		subtitle: {
			text: 'Source: WorldClimate.com',
			x: -20
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
				'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis: {
			title: {
				text: 'Temperature (°C)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +': '+ this.y +'°C';
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -10,
			y: 100,
			borderWidth: 0
		},
		series: [{
			name: 'Tokyo',
			data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
		}, {
			name: 'New York',
			data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
		}, {
			name: 'Berlin',
			data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
		}, {
			name: 'London',
			data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
		}]
	});
});";
	
			return $content;
	}
}