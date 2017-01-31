<?php

namespace onJoinController;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {
	
	public function onLoad() {
		$this->getLogger()->info("Loading onJoinController...");
	}
	
	public function onEnable() {
		@mkdir($this->getDataFolder());
		$this->getLogger()->info("onJoinController has been enabled");
		$this->saveDefaultConfig();
		$this->reloadConfig();
		$this->getConfig()->save();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable() {
		$this->getLogger()->info("onJoinController has been disabled");
	}
	
	public function onJoin(PlayerJoinEvent $event) {
		if($this->getConfig()->get("enabled")) {
			$player = $event->getPlayer();
			foreach($this->getConfig()->get("commands") as $cmd) {
				$command = str_replace(array("{player}", "{onlineplayers}", "{maxplayers}"), array($player->getName(), count($this->getServer()->getOnlinePlayers()), count($this->getServer()->getMaxPlayers())), $cmd);
				$this->getServer()->dispatchCommand(new ConsoleCommandSender(), $command);
			}
		}
	}
}
