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

use BoxOfDevs\SingleAuth\ReloadConfigTask;
use BoxOfDevs\SingleAuth\API;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\permission\Permission;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as Colour;

class Main extends PluginBase implements Listener{

    const AUTHOR = "BoxOfDevs Team";
    const VERSION = "1.0.0";
    const MAIN_WEBSITE = "https://BoxOfDevs.github.io/SingleAuth/";
    const PREFIX = "§0§l[§r§bSingleAuth§0§l]§r";
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->reloadConfig();
        $this->getLogger()->info(Colour::GREEN . "Enabled!");
    }

    public function getPrefix(){
        return self::PREFIX;
    }
    public function getAuthor(){
        return self::AUTHOR;
    }
    public function getVersion(){
        return self::VERSION;
    }
    public function getMainWebsite(){
        return self::MAIN_WEBSITE;
    }
    public function getAPI(){
        $this->API = new API($this);
		  return $this->API;
    }

    public function onDisable(){
        $this->getLogger()->info(Colour::RED . "Disabled!");
        $cfg->set("isPlayerOnline", false);
        $cfg->save();
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    	$cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        switch(strtolower($cmd->getName())){
           case "login":
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this, $sender), 5);
            if($sender->getName() === "CONSOLE"){
                $sender->sendMessage("§4This command can only be executed in-game!");
            } else {
                    if(!isset($args[0])){
                     return false;
                    }else{
                        if($cfg->get("UniversalPassword") === $args[0]){
							$sendername = $sender->getName();
							$sendercfg = $cfg->get($sendername);
                            if($sendercfg  ===! "Authed" or !isset($sendercfg)){
                                $cfg->set($sendername, "Authed");
                                $cfg->save();
                                $sender->sendMessage($cfg)->get("SuccessfulLoginMessage"));
                            } else {
                                $sender->sendMessage($cfg->get("AlreadyAuthMessage"));
                            }
                        } else {
                            $sender->sendMessage($cfg->get("WrongPasswordMessage"));
                        }
                    }
                }
                return true;
                break;
                case "checkpass":
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this, $sender), 5);
            $cfg->set("isPlayerOnline", true);
            $cfg->save();
  	$sender->sendMessage("Password is '" . $cfg->get("UniversalPassword"));
  return true;
  break;
  case "setpassword":
  	if(empty($args)) {
  		return false;
  	} else {
  		$cfg->set("UniversalPassword", $args[0]);
  		$cfg->save();
  		$sender->sendMesssage("Password succefully changed! New password: " . $args[0]);
  		foreach($this->getServer()->getOnlinePlayers() as $player) {
  			$this->getServer()->dispatchCommand($player, "logout");
  		}
  	}
  	return true;
  	break;
  case "logout":
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this, $sender), 5);
            $cfg->set("isPlayerOnline", true);
            $cfg->save();
     if(empty($args)) {
  	$sender->sendMessage("You have been logged out. Type /login <password>");
  	$cfg->set($sender->getName(), "Not authed");
  	$cfg->save();
     } else {
        if($sender->hasPermission("singleauth.logoutother")) {
           $player = $this->getServer()->getPlayer($args[0]);
           if(!$player instanceof Player){
               $sender->sendMessage("§4§l[Error]§r§4 Player not found");
           } else {
              $this->getServer()->dispatchCommand($player, "logout");
			  }
		}
	 }
		}
        return true;
    }

    public function onPlayerMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this, $player), 5);
            $cfg->set("isPlayerOnline", true);
            $cfg->save();
        if($cfg->get($player->getName()) ===! "Authed") {
            $event->setCancelled(true);
            $player->sendTip($cfg->get("PlayBeforeAuthMessage"));		
        }
    }

    public function onPlayerChat(PlayerChatEvent $event){
        $player = $event->getPlayer();
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this, $player), 5);
        if($cfg->get($player->getName()) ===! "Authed") {
            $event->setCancelled(true);
            $player->sendMessage($cfg->get("PlayBeforeAuthMessage"));		
        }
    }
    
}
