<?php

namespace BoxofDevs\BoxForms;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\command\CommandExecutor;
use pocketmine\permission\Permission;

class Main extends PlayerEvent implements Cancellable
{

    public function onEnable(){
    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info(TextFormat::GREEN . "BoxForms enabled!");
        $this->saveResource("Config.yml");
        $config = new Config($this->getDataFolder . "Config.yml", Config::YAML);
        $config->save();
    }
        public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function onDisable(){
	         $this->getServer()->getLogger()->info(TextFormat::RED . "BoxForms disabled! :o");
    }
    
     public function onCommand(CommandSender $sender, Command $command, $label, array $args){
          switch($command->getName()){
               case "form":
               	$sender->sendMessage("Usage: /form (1, 2 ,3).")
                    if(!($sender instanceof player)){
                         $sender->sendMessage("Use this command in-game!");
                    }else{
                         if(!isset($args[0])){
                              if($sender->hasPermission("forms.command")){
                              }
                         }else{
                              switch ($args[0]){
                                   case "1":
                                        if($sender->hasPermission("form.command.1");
                                                $sender->sendMessage("You are about to answer form #1, Do you want to continue?")
                                                $this->message = $message;
                                        }
                                             break;
                                   case "2":
                                        if($sender->hasPermission("form.command.2")){
                                        	$sender->sendMessage("You are about to answer form #1")
                                        }
                                             break;
    }
}
