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
			marginBottom: 40
		},
		title: {
			text: '"; $content = $content . $title . "', " ."
			x: -20 //center
		},
		xAxis: {
			title: {
					text: 'Dias'
				},
			categories: ['"; 
						$tmp = array();
						$tmp1="";
						$aux = "";
						$j=1;
						$size = sizeof($this->pasos);
						for($i = 0; $i < $size; $i++)
						{
							if ($i == ($size-1)) 
								$tmp1 = $tmp1 . "'" . $this->pasos[$i]->eguna . "' ";
							else{
								$aux = $this->pasos[$i]->eguna;
								if ($i==0)
								{
									$tmp1 = $aux. "',";
									$tmp[$i] = $aux;
								}
								else if ($aux != $tmp[$i-$j])
								{
									$tmp1 = $tmp1 . "'" . $this->pasos[$i]->eguna . "',";
									$tmp[$i-$j+1] = $this->pasos[$i]->eguna;
								}
								else
									$j= $j++;
							}
									
						}
						$content = $content . $tmp1 . "]
		},
		yAxis: {
			title: {
				text: 'Num pasos cebra'
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
		series: [";
					$tmp1 = array();
					$tmp = "";
					$aux="";
					$k=1;
					$size = sizeof($this->pasos);
					
					for($i = 0; $i < $size; $i++)
					{
						$aux = $this->pasos[$i]->localidad;
						if ($i==0)
						{
							$tmp1[$i] = $aux;
							for($j = 0; $j <$size; $j++) 
							{	
								if ($j==0)
									$tmp = "{ name: '" . $aux . "', data: [" . $this->pasos[$j]->cantidad;
								else if($aux === $this->pasos[$j]->localidad)
									$tmp = $tmp . ", " . $this->pasos[$j]->cantidad;
								
								if ($j==($size-1))
									$tmp = $tmp . "]}";	
							}
						}
						else {
							var_dump("aux: " . $aux);
							
							 $l=0;
							 $in=false;
							while($l<sizeof($tmp1))
							{ 
								if ($aux !== $tmp1[$l])
								{
									$in=true;
									$l++;
								}
								else
								{
									$in=false;
									$l=sizeof($tmp1);
								}
							}
							if ($in===true)
							{
									$tmp1[sizeof($tmp1)] = $this->pasos[$i]->localidad;
									for($j = $i; $j < $size; $j++) 
									{	
										if ($j==$i)
											$tmp = $tmp . ",{ name: '" . $aux . "', data: [" . $this->pasos[$i]->cantidad;
										else if($aux == $this->pasos[$j]->localidad)
											$tmp = $tmp . ", " . $this->pasos[$j]->cantidad;
										else if ($j==($size-1))
											$tmp = $tmp . "]}";	
									}
									$l=sizeof($tmp1);
									var_dump($tmp1);
							}
						}
					}
					
				
				
				$content = $content . $tmp . "]
	});
});";
	
			return $content;
	}
}