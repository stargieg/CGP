<?php

# Collectd olsrd Plugin

require_once 'conf/common.inc.php';
require_once 'type/Default.class.php';
require_once 'inc/collectd.inc.php';

$obj = new Type_Default($CONFIG);
$obj->data_sources = array('value');
$obj->ds_names = array('value' => 'Value');
$obj->colors = array('value' => '0000f0');
$obj->rrd_format = '%6.1lf';


switch($obj->args['pinstance']) {
	case 'links':
		switch($obj->args['type']) {
			case 'links':
				$obj->rrd_title = 'Number of links';
				$obj->rrd_vertical = 'Nr';
				break;
			case 'signal_quality':
				$obj->rrd_title = sprintf('signal_quality %s', $obj->args['tinstance']);
				$obj->rrd_vertical = 'lq/nlq';
				$obj->colors = '';
				break;
		}
		break;
	case 'routes':
		switch($obj->args['type']) {
			case 'routes':
				$obj->rrd_title = sprintf('routes (%s) table routes', $obj->args['tinstance']);
				$obj->rrd_vertical = 'Nr';
				break;
			case 'route_etx':
				$obj->rrd_title = sprintf('etx (%s) table routes', $obj->args['category']);
				$obj->rrd_vertical = '%';
				break;
			case 'route_metric':
				$obj->rrd_title = sprintf('metric (%s) table routes', $obj->args['tinstance']);
				$obj->rrd_vertical = '%';
				break;
		}
		break;
	case 'topology':
		switch($obj->args['type']) {
			case 'links':
				$obj->rrd_title = sprintf('Number of (%s) table topology', $obj->args['tinstance']);
				$obj->rrd_vertical = 'Nr';
				break;
			case 'signal_quality':
				$obj->rrd_title = sprintf('signal_quality (%s) table topology', $obj->args['tinstance']);
				$obj->rrd_vertical = 'Nr';
				break;
		}
		break;
}

collectd_flush($obj->identifiers);
$obj->rrd_graph();
