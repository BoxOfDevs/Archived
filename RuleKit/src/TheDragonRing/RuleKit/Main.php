<?php

/*
  _____       _      _  ___ _          __   ___   ___  
 |  __ \     | |    | |/ (_) |        /_ | / _ \ / _ \ 
 | |__) |   _| | ___| ' / _| |_  __   _| || | | | | | |
 |  _  / | | | |/ _ \  < | | __| \ \ / / || | | | | | |
 | | \ \ |_| | |  __/ . \| | |_   \ V /| || |_| | |_| |
 |_|  \_\__,_|_|\___|_|\_\_|\__|   \_/ |_(_)___(_)___/ 
 
 */
 
namespace TheDragonRing\RuleKit;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\permission\Permission;
use pocketmine\utils\Config;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
    
    const PRODUCER = "TheDragonRing";
    const VERSION = "1.0.0";
    const MAIN_WEBSITE = "https://TheDragonRing.github.io/RuleKit/";

	public function onEnable(){
	           if(!$this->getServer()->getName()=="ImagicalMine"){
                $this->getLogger()->warn("§0§l[§r§bRuleKit§t0§l]§r Sorry, RuleKit is only available for ImagicalMine - server software for Minecraft: Pocket Edition and a third-party build of PocketMine-MP");
                $this->getLogger()->info("§0§l[§r§bRuleKit§t0§l]§r In order to use RuleKit, download ImagicalMine at http://imagicalmine.net");
                $this->setEnabled(false);
                }
                
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(Colour::AQUA."RuleKit by TheDragonRing".Colour::GREEN." Enabled!")
		
			@mkdir($this->getDataFolder());
			$this->yml = new Config($this->getDataFolder()."rules.yml",Config::YAML, array(
				#  _____       _      _  ___ _          __   ___   ___  
                # |  __ \     | |    | |/ (_) |        /_ | / _ \ / _ \ 
                # | |__) |   _| | ___| ' / _| |_  __   _| || | | | | | |
                # |  _  / | | | |/ _ \  < | | __| \ \ / / || | | | | | |
                # | | \ \ |_| | |  __/ . \| | |_   \ V /| || |_| | |_| |
                # |_|  \_\__,_|_|\___|_|\_\_|\__|   \_/ |_(_)___(_)___/ 
				# 
				
				# The message which appears players when they join
				# Use § to colour the text
				"RulesJoinMsg" => "§6Please run /rules 1|2 to see the server rules!"

				# Custom rules which show up when /rules 1|2 is run
				# Use § to colour the text
				"Rule1" => "No Swearing",
				"Rule2" => "No Using Mods",
				"Rule3" => "No Advertising",
				"Rule4" => "No Asking For OP",
				"Rule5" => "No Asking For Creative",
				"Rule6" => "Have Fun :)",
				"Rule7" => "No Griefing",
				"Rule8" => "Another Rule",
				"Rule9" => "Another Rule",
				"Rule10" => "Another Rule",
			));
    $this->saveResource("rules.yml");
	}
	
	public function onDisable(){
		$this->getLogger()->info(Colour::AQUA."RuleKit by TheDragonRing".Colour::DARK_RED." Disabled!");
	}
	
    private $permMessage = Colour::DARK_RED."You do not have permission to run this command!";
    private $consoleMsg = Colour::DARK_RED."This command can only be executed in-game!";

	public function onJoin(PlayerJoinEvent $event){
		$sender->sendMessage($this->config->get("RulesJoinMsg"));
		return true;
		break;
	}
	
	public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){
//rulekit
		if(strtolower($cmd->getName() == "rulekit"));
			if(!($sender instanceof Player)){
						$sender->sendMessage(Colour::BLACK. "---[".Colour::AQUA."RuleKit v1.0.0 Info".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."Plugin Author: ".Colour::WHITE."TheDragonRing")));
						$sender->sendMessage(Colour::AQUA."Commands-")));
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/rulekit".Colour::WHITE." Easily view all the info about RuleKit, version, author, commands and permissions! (aliases = /rk, /rulek, and /rkit)");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/rules 1|2".Colour::WHITE." Easily shows server rules (aliases = /r, and /rk)");
						$sender->sendMessage(Colour::AQUA."Permissions-");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."rulekit.info".Colour::WHITE." Allows use of /rulekit");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."rulekit.rules".Colour::WHITE." Allows use of /rules");
							return true;
							break;
	                   }
			$player = $this->getServer()->getPlayer($sender->getName());
			if($player->hasPermission("rulekit.info")){
						$sender->sendMessage(Colour::BLACK. "---[".Colour::AQUA."RuleKit v1.0.0 Info".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."Plugin Author: ".Colour::WHITE."TheDragonRing")));
						$sender->sendMessage(Colour::AQUA."Commands-")));
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/rulekit".Colour::WHITE." Easily view all the info about RuleKit, version, author, commands and permissions! (aliases = /rk, /rulek, and /rkit)");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."/rules 1|2".Colour::WHITE." Easily shows server rules (aliases = /r, and /rk)");
						$sender->sendMessage(Colour::AQUA."Permissions-");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."rulekit.info".Colour::WHITE." Allows use of /rulekit");
						$sender->sendMessage(Colour::BLACK. "- ".Colour::DARK_GREEN."rulekit.rules".Colour::WHITE." Allows use of /rules");
							return true;
							break;
	               }else{
			$sender->sendMessage("$this->permMessage");
			return true;
				}
		break;
//rules
		if(strtolower($cmd->getName() == "rules"));
			if(!($sender instanceof Player)){
			if(!isset($args[0])){
				$sender->sendMessage(Colour::DARK_RED. "Usage: " .Colour::WHITE."/rules 1|2".Colour::DARK_RED." Easily shows page 1 or 2 of server rules");
				return true;
			}else{
				switch ($args[0]){
					case "1":
						$sender->sendMessage(Colour::BLACK. "---[".Colour::DARK_PURPLE."Server Rules Page 1".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule1")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule2")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule3")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule4")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule5")));
						return true;
							break;
					case "2":
						$sender->sendMessage(Colour::BLACK. "---[".Colour::DARK_PURPLE."Server Rules Page 2".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule6")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule7")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule8")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule9")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule10")));
							return true;
							break;
						}
				}
		}
			$player = $this->getServer()->getPlayer($sender->getName());
			if($player->hasPermission("rulekit.rules")){
			if(!isset($args[0])){
				$sender->sendMessage(Colour::DARK_RED. "Usage: " .Colour::WHITE."/rules 1|2".Colour::DARK_RED." Shows page 1 or 2 of server rules");
				return true;
			}else{
				switch ($args[0]){
					case "1":
						$sender->sendMessage(Colour::BLACK. "---[".Colour::DARK_PURPLE."Server Rules Page 1".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule1")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule2")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule3")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule4")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule5")));
						return true;
							break;
					case "2":
						$sender->sendMessage(Colour::BLACK. "---[".Colour::DARK_PURPLE."Server Rules Page 2".Colour::BLACK."]---");
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule6")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule7")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule8")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule9")));
						$sender->sendMessage(Colour::BLACK. "- " ($this->config->get(Colour::WHITE."Rule10")));
							return true;
							break;
						}
				}
		}else{
			$sender->sendMessage("$this->permMessage");
			return true;
				}
		break;
    }
}