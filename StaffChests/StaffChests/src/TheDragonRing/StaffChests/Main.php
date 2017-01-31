<?php

namespace TheDragonRing\StaffChests;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\permission\Permission;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\utils\Config;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(Colour::AQUA."StaffChests".Colour::DARK_RED." by TheDragonRing".Colour::GREEN." Enabled!");
	}

	public function onDisable(){
		$this->getLogger()->info(Colour::AQUA."StaffChests".Colour::GREEN." by TheDragonRing".Colour::DARK_RED." Disabled!");
	}

    private $permMessage = Colour::DARK_RED."You do not have permission to run this command!";
    private $consoleMsg = Colour::DARK_RED."This command can only be executed in-game!";

	public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
		if(strtolower($cmd->getName() == "staffchests"));
			if(!($sender instanceof Player)){
			$sender->sendMessage(Colour::DARK_RED."$this->consoleMsg");
			return true;
			}
				$player = $this->getServer()->getPlayer($sender->getName());
				if ($player->hasPermission("staffchests.staffchests")){
				if(!isset($args[0])){
				$sender->sendMessage(Colour::BLACK. "---[".Colour::GOLD."StaffChests".Colour::BLACK."]---");
				$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/staffchests key".Colour::DARK_GREEN." Get key to open StaffChest");
				$sender->sendMessage(Colour::BLACK. "- " .Colour::WHITE."/staffchests chest".Colour::DARK_GREEN." Get StaffChest");

		}else{
				switch ($args[0]){
					case "chest":
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "give $player chest 1 {display:{Name:§6§6StaffChest},BlockEntityTag:{Lock:§6§6StaffChest Key,Items:[{id:264,Count:64,Slot:0}]}}");
						$sender->sendMessage(Colour::AQUA."You have received a StaffChest");
						return true;
						break;
					case "key":
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "give $player stick 1 {display:{Name:§6§6StaffChest Key}}");
						$sender->sendMessage(Colour::AQUA."You have received a StaffChest Key");
						return true;
						break;
						}
					}
				}else{	
					$sender->sendMessage(Colour::DARK_RED."$this->permMessage");
					return true;
				}
					break;
		if(strtolower($cmd->getName() == "loopychest"));
			if(!($sender instanceof Player)){
			$sender->sendMessage(Colour::DARK_RED."$this->consoleMsg");
			return true;
			}
				$player = $this->getServer()->getPlayer($sender->getName());
				if ($player->hasPermission("staffchests.loopychest")){
				$this->getServer->dispatchCommand(new ConsoleCommandSender(), "give $player chest 1 {display:{Name:§6§6LoopyChest},BlockEntityTag :{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1,Slot:0,tag:{BlockEntityTag:{Items:[{id:54,Count:1i,Slot:0,tag:{BlockEntityTag:{Items:[{id:7,Count:1,Slot:0,tag:{display:{Name:§7Place Me On Bedrock :)},CanPlaceOn:[bedrock]}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}}]}}");
				$sender->sendMessage(Colour::AQUA."You have received a LoopyChest");
				return true;
			}else{
				$sender->sendMessage(Colour::DARK_RED."$this->permMessage");
				return true;
				}
			break;
	}
}
