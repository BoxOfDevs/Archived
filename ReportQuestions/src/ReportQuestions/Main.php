<?php

#  _____                       _    ____                  _   _                 
# |  __ \                     | |  / __ \                | | (_)                
# | |__) |___ _ __   ___  _ __| |_| |  | |_   _  ___  ___| |_ _  ___  _ __  ___ 
# |  _  // _ \ '_ \ / _ \| '__| __| |  | | | | |/ _ \/ __| __| |/ _ \| '_ \/ __|
# | | \ \  __/ |_) | (_) | |  | |_| |__| | |_| |  __/\__ \ |_| | (_) | | | \__ \
# |_|  \_\___| .__/ \___/|_|   \__|\___\_\\__,_|\___||___/\__|_|\___/|_| |_|___/
#            | |                                                                
#            |_|

namespace ReportQuestions;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\IPlayer;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

define("prefix_rq", "§0§l[§r§bReportQuestions§p§l]§r");

class BaseBox extends PluginBase implements Listener, CommandExecutor{

	const pluginName = "ReportQuestions";
	const author = "BoxOfDevs Team";
	const version = "1.0";
	const description = "An easy way for players to report players or ask the server staff questions!";
	const license = "BoxOfDevs General Software License 1.1, Copyright © 2016 BoxOfDevs Team";
	const website = "boxofdevs.com";

	public function onLoad(){
		//Loading Message...
		$this->getLogger()->info(prefix_rq . TF::GOLD . "Loading...");
	}

	public function onEnable(){
		//Configuration Stuff...
		@mkdir($this->getDataFolder());
		$this->saveResource("Config&Data.yml");
		$this->yamlFile = new Config($this->getDataFolder() . "Config&Data.yml", Config::YAML);
		$this->yamlFile->save();

		//Register Events...
		$this->getServer()->getPluginManager()->registerEvents($this,$this);

		//Enabled Message...
		$this->getLogger()->info(prefix_rq . TF::DARK_GREEN . "Enabled!");
	}

	public function onDisable(){
		//Configuration Stuff...
		$this->saveResource("Config&Data.yml");
		$this->yamlFile->save();

		//Disabled Message...
		$this->getLogger()->info(prefix_rq . TF::DARK_RED . "Disabled!");
	}

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		
        if(strolower($cmd->getName() === "report")){
        	
                if($sender->hasPermission("reportquestions" || "reportquestions.report"){
		        $player = $args[0];
    	                if(!isset($args[1])){
				return false;
			}else{
				$senderName = $sender->getName();
				$reports = $this->yamlFile->get($player["Reports"]);
				unset($args[0]);
				array_push($reports,"Reported by $senderName; $args");
				$this->yamlFile->set($player["Reports"], $reports);
				$player->sendMessage(prefix_rq . TF::RED . "You have been reported by $senderName!");
				$sender->sendMessage(prefix_rq . TF::GREEN . "You have successfully reported $player!");
			}
                }
            }
        }
        if(strolower($cmd->getName() === "ask")){
            if(!$sender instanceof Player){
                if(!$sender->hasPermission("reportquestions") or !$sender->hasPermission("reportquestions.ask"))return;
                	if(!isset($args[0])){
			        $sender->sendMessage($this->prefix . TF::DARK_RED . "Usage: /ask <question>");
			}else{
				$questions = $this->yamlFile->get($sender->getName()["Questions"]);
				array_push($questions, $args);
				$this->yamlFile->set($sender->getName()["Questions"], $questions);
				$sender->sendMessage($this->prefix . TF::GREEN . "Your question has successfully been asked!");
			}
                }
        }
        if(strolower($cmd->getName() === "vew")){
            if(!$sender instanceof Player){
                
            }else{
                if(!$sender->hasPermission("reportquestions") or !$sender->hasPermission("reportquestions.view")) return;
            
        }
        if(strolower($cmd->getName() === "warn")){
            if(!$sender instanceof Player){
                
            }else{
                if(!$sender->hasPermission("reportquestions") or !$sender->hasPermission("reportquestions.warn")) return;
                    
            }
        }
    }

}

?>
