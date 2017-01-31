<?php
namespace BoxOfDevs\ColorfullBlock;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\IPlayer;
use pocketmine\plugin\PluginBase;

   class ReloadConfigTask extends PluginTask  {
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	public function onRun($tick) {
		$this->plugin->reloadConfig();
	}
	}