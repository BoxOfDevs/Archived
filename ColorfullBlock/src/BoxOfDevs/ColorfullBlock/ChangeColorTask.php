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
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

   class ChangeColorTask extends PluginTask  {
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	public function onRun($tick) {
		$randwool = rand(0, 15);
		$id = 1;
		$cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		while($cfg->get("LastBlockNumber") >= $id) {
			$x = $cfg->get("X" . $id);
			$y = $cfg->get("Y" . $id);
			$z = $cfg->get("Z" . $id);
			$levelname = $cfg->get("Level" . $id);
			$level = $this->plugin->getServer()->getLevelByName($levelname);
			$block = new Block(35, $randwool); 
			$level->setBlock(new Vector3($x, $y, $z), $block, true, false);
<<<<<<< HEAD
			$id++
=======
$i++
>>>>>>> origin/master
		}
	}
   }
