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
		 
        // These are your data
        $data1 = array(1,2,3,4,5);
        $data2 = array(3,2,2);
        $data3 = array(5,2,5);

        // Convert your data arrays by doing:
        $d1 = new HighchartsArray($data1);
        $d2 = new HighchartsArray($data2);
        $d3 = new HighchartsArray($data3);

        // Create an option array for your graph.
        // Refers to the official Highcharts reference page for a list of the available options.
        // The page is available at:
        // http://www.highcharts.com/ref/
        $options = array(
                         'chart' => array(
                                          'renderTo' => 'my_graph',
                                          'defaultSeriesType' => 'column'
                                          ),
                         'title' => array(
                                          'text' => 'my_title'
                                          ),
                         'xAxis' => array(
                                          'categories' => $d1,
                                          'title' => 'x_axis_title'
                                          ),
                         'yAxis' => array(
                                          'title' => array(
                                                           'text' => 'y_axis_title'
                                                           )
                                          ),
                         'series' => array(
                                           array(
                                                 'name' => 'Data 2',
                                                 'data' => $d2
                                                 ),
                                           array(
                                                 'name' => 'Data 3',
                                                 'data' => $d3
                                                 )
                                           )
                         );

        // Generate your chart
        $chart = new Highcharts('my_graph', $options);

       // Enjoy your new chart
        $this->code=$chart->getCode();
        $this->div= '<div id="my_graph" width="500" height="300"> </div>';
			
		parent::display($tpl);
	}
}