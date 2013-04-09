<?php


require_once(dirname(__FILE__).'/application/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('api', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
