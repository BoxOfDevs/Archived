<?php
namespace BoxOfDevs\BuildBattle ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
 use pocketmine\Player;
use BoxOfDevs\BuildBattle\BuildingGameLevel;
use BoxOfDevs\BuildBattle\Utils;


class Main extends PluginBase implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->pos1 = [];
$this->pos2 = [];
$this->worlds = [];
foreach($this->getConfig()->get("Levels") as $world) {
    array_push($this->worlds, new BuildingGameLevel($this, $world, $this->getServer()->getWorldPath() . $world));
}
 }
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
switch($cmd->getName()){
    case 'buildbattle':
    if(isset($args[0]) && $sender->isOp() && $sender instanceof Player) {
        switch($args[0]) {
            case 'addworld':
            if(isset($args[1]) and $this->getServer()->getLevelByName($args[1]) instanceof Level) {
                $this->addWorld($args[1]);
                $sender->sendMessage("§aAdding world "  . $args[1]);
            } elseif($sender instanceof Player) {
                $this->addWorld($sender->getLevel()->getName());
                $sender->sendMessage("§aAdding world "  . $sender->getLevel()->getName());
            } else {
                $sender->sendMessage("This command can be only executed in game");
            }
            break;
            case 'addpos1':
            $this->pos1[$sender->getName()] = new Vector3($sender->x, $sender->y, $sender->z);
            $sender->sendMessage("§aSetting position 1 to X: " . $sender->x . " Y: " . $sender->y . " Z: " . $sender->z);
            break;
            case 'addpos2':
            $this->pos2[$sender->getName()] = new Vector3($sender->x, $sender->y, $sender->z);
            $sender->sendMessage("§aSetting position 2 to X: " . $sender->x . " Y: " . $sender->y . " Z: " . $sender->z);
            break;
            case 'createplot':
            if(isset($this->pos1[$sender->getName()]) and isset($this->pos2[$sender->getName()]) and isset($this->worlds[$sender->getLevel()->getName()])) {
                $sender->sendMessage("§aCreating plot ...");
                $this->worlds[$sender->getLevel()->getName()]->addPlot($this->pos1[$sender->getName()], $this->pos2[$sender->getName()]);
            }
            break;
            case 'setlobby':
            if(isset($this->worlds[$sender->getLevel()->getName()])) {
                if(isset($args[2])) {
                    $this->worlds[$sender->getLevel()->getName()]->setLobby(new Vector3($args[1], $args[2], $args[3]));
                } else {
                    $this->worlds[$sender->getLevel()->getName()]->setLobby(new Vector3($sender->x, $sender->y, $sender->z));
                }
            } else {
                $sender->sendMessage("§4You are not in a BuildingGame world")
            }
            break;
            case 'removespawn':
            if(isset($args[0])) {
                $this->worlds[$sender->getLevel()->getName()]->removeSpawn($args[0]);
                $sender->sendMessage("Removed spawn " . $args[0]);
            }
            break;
        }
        return true;
    }
    if(isset($args[0]) && $sender instanceof Player) {
        
    }
    break;
}
return false;
 }
 public function addWorld($arg) {
     if(!isset($this->worlds[$arg])) {
         array_push($this->worlds, new BuildingGameLevel($this, $arg, $this->getServer()->getWorldPath() . $arg));
     }
 }
}
