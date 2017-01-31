<?php

namespace TeamSorter;

use TeamSorter\SymbolFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener, CommandExecutor{
    
    const NAME = "TeamSorter";
    const AUTHOR = "BoxOfDevs Team";
    const VERSION = "1.0";
    const WEBSITE = "http://boxofdevs.ml/software";
	const DESCRIPTION = "Ever needed a multi-feature TeamPVP plugin?";
	const LICENSE = "BOD International Software License 1.0";

    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveResource("data.yml");
        $this->saveResource("config.yml");
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
        $data->set("RedTeam", 0);
        $data->set("BlueTeam", 0);
        $items = $config->get("Items");
        $num = 0;
        foreach($items as $i){
            $r = explode(":",$i);
            $this->itemdata[$num] = array($r[0],$r[1],$r[2]);
            $num++;
        }
        $data->save();
        $this->getLogger()->info(TF::GREEN . "TeamSorter Enabled!");
    }
    
    public function getPrefix(){
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $text = $config->get("Prefix");
        $prefix = $this->FormatText($text);
        return $prefix;
    }

    public function onBoth(PlayerJoinEvent $joinevent, PlayerRespawnEvent $event){
        $data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
        $red = $data->get("RedTeam");
        $blue = $data->get("BlueTeam");
        $player = $event->getPlayer();
        $name = $player->getName();
        $playername = $name;
        $redmembers = $data->get("RedTeamMembers");
        $bluemembers = $data->get("BlueTeamMembers");
        foreach($this->itemdata as $i){
            $item = new Item($i[0],$i[1],$i[2]);
            $player->getInventory()->addItem($item);
        }
        if($red = $blue){
            $joinevent->setJoinMessage($this->getPrefix() . $name . "joined the" . TF::DARK_RED . "RED" . TF::WHITE . "team!");
            $player->setDisplayName(TF::DARK_RED . $name);
            $redhelmet = Item::get(298);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Helmet", 16711680);
            $redhelmet->setCompoundTag($tempTag);
            $player->getInventory()->setHelmet($redhelmet);
            $redchestplate = Item::get(299);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Chestplate", 16711680);
            $redchestplate->setCompoundTag($tempTag);
            $player->getInventory()->setChestplate($redchestplate);
            $redleggings = Item::get(300);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Leggings", 16711680);
            $redleggings->setCompoundTag($tempTag);
            $player->getInventory()->setLeggings($redleggings);
            $redboots = Item::get(301);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Boots", 16711680);
            $redboots->setCompoundTag($tempTag);
            $player->getInventory()->setBoots($redboots);
            array_push($redmembers, $playername);
            $data->set("RedTeam", $red + 1);
            $data->set("RedTeamMembers", $playername);
            $data->save();
            $player->sendMessage($this->getPrefix() . " You are now on the " . TF::DARK_RED . "RED " . TF::WHITE . "team!");
        }elseif($red > $blue){
            $joinevent->setJoinMessage($this->getPrefix() . $name . "joined the" . TF::AQUA . "BLUE" . TF::WHITE . "team!");
            $player->setDisplayName(TF::AQUA . $name);
            $bluehelmet = Item::get(298);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Blue Helmet", 255);
            $bluehelmet->setCompoundTag($tempTag);
            $player->getInventory()->setHelmet($bluehelmet);
            $bluechestplate = Item::get(299);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Blue Chestplate", 255);
            $bluechestplate->setCompoundTag($tempTag);
            $player->getInventory()->setChestplate($bluechestplate);
            $blueleggings = Item::get(300);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Blue Leggings", 255);
            $blueleggings->setCompoundTag($tempTag);
            $player->getInventory()->setLeggings($blueleggings);
            $blueboots = Item::get(301);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Blue Boots", 255);
            $blueboots->setCompoundTag($tempTag);
            $player->getInventory()->setBoots($blueboots);
            array_push($redmembers, $playername);
            $data->set("BlueTeam", $red + 1);
            $data->set("BlueTeamMembers", $playername);
            $data->save();
            $player->sendMessage($this->getPrefix() . " You are now on the " . TF::AQUA . "BLUE " . TF::WHITE . "team!");
        }elseif($red < $blue){
            $joinevent->setJoinMessage($this->getPrefix() . $name . "joined the" . TF::DARK_RED . "RED" . TF::WHITE . "team!");
            $player->setDisplayName(TF::DARK_RED . $name);
            $redhelmet = Item::get(298);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Helmet", 16711680);
            $redhelmet->setCompoundTag($tempTag);
            $player->getInventory()->setHelmet($redhelmet);
            $redchestplate = Item::get(299);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Chestplate", 16711680);
            $redchestplate->setCompoundTag($tempTag);
            $player->getInventory()->setChestplate($redchestplate);
            $redleggings = Item::get(300);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Leggings", 16711680);
            $redleggings->setCompoundTag($tempTag);
            $player->getInventory()->setLeggings($redleggings);
            $redboots = Item::get(301);
            $tempTag = new CompoundTag("", []);
            $tempTag->customColour = new IntTag("Red Boots", 16711680);
            $redboots->setCompoundTag($tempTag);
            $player->getInventory()->setBoots($redboots);
            array_push($redmembers, $playername);
            $data->set("RedTeam", $red + 1);
            $data->set("RedTeamMembers", $playername);
            $data->save();
            $player->sendMessage($this->getPrefix() . " You are now on the " . TF::DARK_RED . "RED " . TF::WHITE . "team!");
        }
    }

    public function onDamage(EntityDamageEvent $event){
        if($event instanceof EntityDamageByEntityEvent && $event->getDamager() instanceof Player){
            $player = $event->getPlayer();
            $playername = $player->getName();
            $attacker = $event->getDamager();
            $attackername = $attacker->getName();
            $data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
            $redteammembers = $data->get("RedTeamMembers");
            $blueteammembers = $data->get("BlueTeamMembers");
            foreach($redteammembers as $redteam){
                foreach($blueteammembers as $blueteam){
                    if($redteam === $playername && $attackername){
                        $event->setCancelled();
                    }elseif($blueteam === $playername && $attackername){
                        $event->setCancelled();
                    }else{
                        return $event;
                    }
                }
            }
        }
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        if(strtolower($cmd->getName() == "changeteam")){
            $data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
            if(!$sender instanceof Player){
				if(!isset($args[1])){
				    $this->getLogger()->info($this->getPrefix() . TF::DARK_RED . " Usage: /changteam red|blue [player] - [player] required when run from console!");
				}elseif(isset($args[1])){
    				$player = $this->getServer()->getPlayer($args[1]);
					$playername = $args[1];
					$name = $args[1];
                    $team = $args[0];
                    $red = $data->get("RedTeam");
                    $blue = $data->get("BlueTeam");
                    $redteam = $data->get("RedTeamMembers");
                    $blueteam = $data->get("BlueTeamMembers");
    				if(!$player instanceof Player){
    				    $this->getLogger()->info($this->getPrefix() . TF::DARK_RED . " Player not found");
                    }elseif($player instanceof Player){
				        if($team === "red"){
				            $this->getServer()->broadcastMessage($this->getPrefix() . $name . "joined the" . TF::DARK_RED . "RED" . TF::WHITE . "team!");
                            $player->setDisplayName(TF::DARK_RED . $name);
                            $redhelmet = Item::get(298);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Helmet", 16711680);
                            $redhelmet->setCompoundTag($tempTag);
                            $player->getInventory()->setHelmet($redhelmet);
                            $redchestplate = Item::get(299);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Chestplate", 16711680);
                            $redchestplate->setCompoundTag($tempTag);
                            $player->getInventory()->setChestplate($redchestplate);
                            $redleggings = Item::get(300);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Leggings", 16711680);
                            $redleggings->setCompoundTag($tempTag);
                            $player->getInventory()->setLeggings($redleggings);
                            $redboots = Item::get(301);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Boots", 16711680);
                            $redboots->setCompoundTag($tempTag);
                            $player->getInventory()->setBoots($redboots);
                            array_push($redmembers, $playername);
                            $data->set("RedTeam", $red + 1);
                            $data->set("RedTeamMembers", $playername);
                            $data->save();
                            $player->sendMessage($this->getPrefix() . " You are now on the " . TF::DARK_RED . "RED " . TF::WHITE . "team!");
				        }elseif($team === "blue"){
                            $this->getServer()->broadcastMessage($this->getPrefix() . $name . "joined the" . TF::DARK_BLUE . "BLUE" . TF::WHITE . "team!");
                            $player->setDisplayName(TF::AQUA . $name);
                            $bluehelmet = Item::get(298);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Helmet", 255);
                            $bluehelmet->setCompoundTag($tempTag);
                            $player->getInventory()->setHelmet($bluehelmet);
                            $bluechestplate = Item::get(299);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Chestplate", 255);
                            $bluechestplate->setCompoundTag($tempTag);
                            $player->getInventory()->setChestplate($bluechestplate);
                            $blueleggings = Item::get(300);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Leggings", 255);
                            $blueleggings->setCompoundTag($tempTag);
                            $player->getInventory()->setLeggings($blueleggings);
                            $blueboots = Item::get(301);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Boots", 255);
                            $blueboots->setCompoundTag($tempTag);
                            $player->getInventory()->setBoots($blueboots);
                            array_push($bluemembers, $playername);
                            $data->set("BlueTeam", $blue + 1);
                            $data->set("BlueTeamMembers", $playername);
                            $data->save();
                            $player->sendMessage($this->getPrefix() . " You are now on the " . TF::AQUA . "BLUE " . TF::WHITE . "team!");
				        }else{
				            $this->getLogger()->info($this->getPrefix() . TF::DARK_RED . " Invalid Team!");
				        }
				    }
				}
            }elseif($sender instanceof Player){
                if(!$sender->hasPermission("teamsorter" || "teamsorter.change")){
					$sender->sendMessage($this->getPrefix() . TF::DARK_RED . " You do not have permission to run this command!");
				}elseif($sender->hasPermission("teamsorter" || "teamsorter.change")){
				    if(!isset($args[1])){
					    $name = $sender->getName();
					    $sendername = $name;
                        $team = $args[0];
                        $red = $data->get("RedTeam");
                        $blue = $data->get("BlueTeam");
                        $redteam = $data->get("RedTeamMembers");
                        $blueteam = $data->get("BlueTeamMembers");
				        if($team === "red"){
				            $this->getServer()->broadcastMessage($this->getPrefix() . $name . "joined the" . TF::DARK_RED . "RED" . TF::WHITE . "team!");
                            $sender->setDisplayName(TF::DARK_RED . $name);
                            $redhelmet = Item::get(298);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Helmet", 16711680);
                            $redhelmet->setCompoundTag($tempTag);
                            $sender->getInventory()->setHelmet($redhelmet);
                            $redchestplate = Item::get(299);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Chestplate", 16711680);
                            $redchestplate->setCompoundTag($tempTag);
                            $sender->getInventory()->setChestplate($redchestplate);
                            $redleggings = Item::get(300);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Leggings", 16711680);
                            $redleggings->setCompoundTag($tempTag);
                            $sender->getInventory()->setLeggings($redleggings);
                            $redboots = Item::get(301);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Red Boots", 16711680);
                            $redboots->setCompoundTag($tempTag);
                            $sender->getInventory()->setBoots($redboots);
                            array_push($redmembers, $sendername);
                            $data->set("RedTeam", $red + 1);
                            $data->set("RedTeamMembers", $sendername);
                            $data->save();
                            $sender->sendMessage($this->getPrefix() . " You are now on the " . TF::DARK_RED . "RED " . TF::WHITE . "team!");
				        }elseif($team === "blue"){
                            $this->getServer()->broadcastMessage($this->getPrefix() . $name . "joined the" . TF::DARK_BLUE . "BLUE" . TF::WHITE . "team!");
                            $sender->setDisplayName(TF::AQUA . $name);
                            $bluehelmet = Item::get(298);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Helmet", 255);
                            $bluehelmet->setCompoundTag($tempTag);
                            $sender->getInventory()->setHelmet($bluehelmet);
                            $bluechestplate = Item::get(299);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Chestplate", 255);
                            $bluechestplate->setCompoundTag($tempTag);
                            $sender->getInventory()->setChestplate($bluechestplate);
                            $blueleggings = Item::get(300);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Leggings", 255);
                            $blueleggings->setCompoundTag($tempTag);
                            $sender->getInventory()->setLeggings($blueleggings);
                            $blueboots = Item::get(301);
                            $tempTag = new CompoundTag("", []);
                            $tempTag->customColour = new IntTag("Blue Boots", 255);
                            $blueboots->setCompoundTag($tempTag);
                            $sender->getInventory()->setBoots($blueboots);
                            array_push($bluemembers, $sendername);
                            $data->set("BlueTeam", $blue + 1);
                            $data->set("BlueTeamMembers", $sendername);
                            $data->save();
                            $sender->sendMessage($this->getPrefix() . " You are now on the " . TF::AQUA . "BLUE " . TF::WHITE . "team!");
				        }else{
				            $sender->sendMessage($this->getPrefix() . TF::DARK_RED . " Invalid Team!");
				        }
				    }elseif(isset($args[1])){
    				    $player = $this->getServer()->getPlayer($args[1]);
					    $playername = $args[1];
					    $name = $args[1];
                        $team = $args[0];
                        $red = $data->get("RedTeam");
                        $blue = $data->get("BlueTeam");
                        $redteam = $data->get("RedTeamMembers");
                        $blueteam = $data->get("BlueTeamMembers");
    				    if(!$player instanceof Player){
    				        $sender->sendMessage($this->getPrefix() . TF::DARK_RED . " Player not found");
                        }elseif($player instanceof Player){
				            if($team === "red"){
				                $this->getServer()->broadcastMessage($this->getPrefix() . $name . "joined the" . TF::DARK_RED . "RED" . TF::WHITE . "team!");
                                $player->setDisplayName(TF::DARK_RED . $name);
                                $redhelmet = Item::get(298);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Red Helmet", 16711680);
                                $redhelmet->setCompoundTag($tempTag);
                                $player->getInventory()->setHelmet($redhelmet);
                                $redchestplate = Item::get(299);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Red Chestplate", 16711680);
                                $redchestplate->setCompoundTag($tempTag);
                                $player->getInventory()->setChestplate($redchestplate);
                                $redleggings = Item::get(300);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Red Leggings", 16711680);
                                $redleggings->setCompoundTag($tempTag);
                                $player->getInventory()->setLeggings($redleggings);
                                $redboots = Item::get(301);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Red Boots", 16711680);
                                $redboots->setCompoundTag($tempTag);
                                $player->getInventory()->setBoots($redboots);
                                array_push($redmembers, $playername);
                                $data->set("RedTeam", $red + 1);
                                $data->set("RedTeamMembers", $playername);
                                $data->save();
                                $player->sendMessage($this->getPrefix() . " You are now on the " . TF::DARK_RED . "RED " . TF::WHITE . "team!");
				            }elseif($team === "blue"){
                                $this->getServer()->broadcastMessage($this->getPrefix() . $name . "joined the" . TF::DARK_BLUE . "BLUE" . TF::WHITE . "team!");
                                $player->setDisplayName(TF::AQUA . $name);
                                $bluehelmet = Item::get(298);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Blue Helmet", 255);
                                $bluehelmet->setCompoundTag($tempTag);
                                $player->getInventory()->setHelmet($bluehelmet);
                                $bluechestplate = Item::get(299);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Blue Chestplate", 255);
                                $bluechestplate->setCompoundTag($tempTag);
                                $player->getInventory()->setChestplate($bluechestplate);
                                $blueleggings = Item::get(300);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Blue Leggings", 255);
                                $blueleggings->setCompoundTag($tempTag);
                                $player->getInventory()->setLeggings($blueleggings);
                                $blueboots = Item::get(301);
                                $tempTag = new CompoundTag("", []);
                                $tempTag->customColour = new IntTag("Blue Boots", 255);
                                $blueboots->setCompoundTag($tempTag);
                                $player->getInventory()->setBoots($blueboots);
                                array_push($bluemembers, $playername);
                                $data->set("BlueTeam", $blue + 1);
                                $data->set("BlueTeamMembers", $playername);
                                $data->save();
                                $player->sendMessage($this->getPrefix() . " You are now on the " . TF::AQUA . "BLUE " . TF::WHITE . "team!");
				            }else{
				                $sender->sendMessage($this->getPrefix() . TF::DARK_RED . " Invalid Team!");
				            }
				        }
				    }
				}
            }
        }
        return $cmd;
    }

    public function onDisable(){
        $data = new Config($this->getDataFolder . "data.yml", Config::YAML);
        $data->set("RedTeam", 0);
        $data->set("BlueTeam", 0);
        $data->remove("RedTeamMembers");
        $data->remove("BlueTeamMembers");
        $data->save();
        $this->getLogger()->info(TF::DARK_RED . "TeamSorter Disabled!");
    }

}

?>
