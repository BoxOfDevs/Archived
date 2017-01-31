<?php

/*

   _____ _             _                    _   _     
  / ____(_)           | |        /\        | | | |    
 | (___  _ _ __   __ _| | ___   /  \  _   _| |_| |__  
  \___ \| | '_ \ / _` | |/ _ \ / /\ \| | | | __| '_ \ 
  ____) | | | | | (_| | |  __// ____ \ |_| | |_| | | |
 |_____/|_|_| |_|\__, |_|\___/_/    \_\__,_|\__|_| |_|
                  __/ |                               
                 |___/                                

An auth plugin with a single universal password

*/

namespace BoxOfDevs\SingleAuth;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\utils\TextFormat as C;
use pocketmine\plugin\PluginBase;

class ReloadConfigTask extends PluginTask  {
    private $player;
    private $plugin;
    public function __construct($plugin, $player){
        parent::__construct($plugin);
        $this->player = $player;
        $this->plugin = $plugin;
    }
     public function onRun($tick){
     	$this->plugin->reloadConfig();
     }
}
