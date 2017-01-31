<?php

namespace Mcrafters\MultiLanguage;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\Utils;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{

	private static $instance = null;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info(TextFormat::BLUE . "MultiLanguage Has Been Enabled.");
		$this->getServer()->getLogger()->info(TextFormat::BLUE . "By: MCrafterss. http://github.com/MCrafterss");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder(), 0777, true);
		$this->NL = new Config($this->getDataFolder()."NL.yml", Config::YAML, array());
		$this->saveResource("NL.yml");
		$this->EN = new Config($this->getDataFolder()."EN.yml", Config::YAML, array());
		$this->saveResource("EN.yml");
		$this->FR = new Config($this->getDataFolder()."FR.yml", Config::YAML, array());
		$this->saveResource("FR.yml");
		$this->DE = new Config($this->getDataFolder()."DE.yml", Config::YAML,array());
		$this->saveResource("DE.yml");
		$this->data = new Config($this->getDataFolder()."Data.yml", Config::YAML, array());
		$this->saveResource("data.yml");
		self::$instance = $this;
	}
	
	public static function getInstance(){
    		return self::$instance;
    		
	}
	
	public function setPlayerLang($player, $language){
		$this->data->set($player,$language);
		$this->data->save();
	}
	public function getPlayerLang($player){
		$this->data->get($player);
	}
	
	public function Translate(Player $player, $message){
                $player = $player->getName();
        	if ($this->getPlayerLang($player) === "nl"){
           		$player->sendMessage($this->NL->get($message));
        	}
        	if ($this->getPlayerLang($player) === "en"){
            		$player->sendMessage($this->EN->get($message));
        	}
		if ($this->getPlayerLang($player) === "fr"){
            		$player->sendMessage($this->FR->get($message));
        	}
        	if ($this->getPlayerLang($player)=== "de"){
            		$player->sendMessage($this->DE->get($message));
        	}
    	}
    	//public function onCommand(){
    	/// add set language
}
