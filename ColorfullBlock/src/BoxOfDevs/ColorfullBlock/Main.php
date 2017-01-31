<?php
namespace BoxOfDevs\ColorfullBlock; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use BoxOfDevs\ColorfullBlock\ChangeColorTask; 
use BoxOfDevs\ColorfullBlock\ReloadConfigTask; 
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocetmine\Player;
use pocketmine\block\Block;
use pocketmine\math\Vector3;


class Main extends PluginBase{
public function onEnable(){
	$this->reloadConfig();
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new ChangeColorTask($this), 10);
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this), 50);
	// $this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
public function onLoad(){
$this->saveDefaultConfig();
$this->reloadConfig();
}
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
switch($cmd->getName()){
	case "createcolorblock":
	if(isset($args[0]) and is_numeric($args[0]) and isset($args[1]) and is_numeric($args[1]) and isset($args[2]) and is_numeric($args[2])) {
		$x = $args[0];
		$y = $args[1];
		$z = $args[2];
		$level = $sender->getLevel();
	} elseif(isset($args[0])) {
		$player = $this->getServer()->getPlayer($args[0]);
		if($player instanceof Player) {
			$x = $player->x;
			$y = $player->y;
			$z = $player->z;
			$level = $player->getLevel();
		} else {
			return false;
		}
	} else {
			$x = $sender->x;
			$y = $sender->y;
			$z = $sender->z;
			$level = $sender->getLevel();
	}
	$cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	$xid = ["X", $cfg->get("LastBlockNumber") + 1];
	$yid = ["Y", $cfg->get("LastBlockNumber") + 1];
	$zid = ["Z", $cfg->get("LastBlockNumber") + 1];
	$lvlid = ["Level", $cfg->get("LastBlockNumber") + 1];
	$cfg->set(implode("",$xid), $x);
	$cfg->set(implode("",$yid), $y);
	$cfg->set(implode("",$zid), $z);
	$cfg->set(implode("",$lvlid), $level);
	$cfg->set("LastBlockNumber", $cfg->get("LastBlockNumber") + 1);
	$cfg->save();
	$sender->sendMessage("[CFB] Block has been place in $x, $y, $z.");
	return true;
}
return false;
 }
}