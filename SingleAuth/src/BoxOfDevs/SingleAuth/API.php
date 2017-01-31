<?php

namespace BoxOfDevs\SingleAuth;

use pocketmine\Player;
use pocketmine\server;
use pocketmine\plugin\PluginBase;

 class  API {
   public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }
    public function getPassword() {
    return $this->plugin->getConfig()->get("UniversalPassword");
    }
    public function setPassword($password) {
    $this->plugin->getConfig()->set("UniversalPassword", $password);
    return true;
    }
    public function isAuthed(Player $player) {
    $authed = $this->plugin->getConfig()->get($player->getName());
    return strtolower($authed);
    }
    public function setAuthed(Player $player) {
    $this->plugin->getConfig()->set($player->getName(), "Authed");
    return true;
    }
    public function unSetAuthed(Player $player) {
    $this->plugin->getConfig()->set($player->getName(), "Not Authed");
    return true;
    }
 }
