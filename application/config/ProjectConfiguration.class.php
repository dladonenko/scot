<?php

require_once '/var/www/vhosts/scotwork.net/httpdocs/application/symfony-1.4.11/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');

    $this->setWebDir(realpath($this->getRootDir().'/../httpdocs'));

    $this->enablePlugins('sfFormExtraPlugin');

  }
}
