<?php

namespace MCrafterss;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;

use Mcrafters\MultiLanguage\Main as ML;

class test extends PluginBase implements Listener {
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		ML::getInstance()->Translate($player, "testmessage");
	}
}
