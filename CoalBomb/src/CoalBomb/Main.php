<?php

/**
 * 
 *  .d8888b.                    888 888888b.                          888      
 * d88P  Y88b                   888 888  "88b                         888      
 * 888    888                   888 888  .88P                         888      
 * 888         .d88b.   8888b.  888 8888888K.   .d88b.  88888b.d88b.  88888b.  
 * 888        d88""88b     "88b 888 888  "Y88b d88""88b 888 "888 "88b 888 "88b 
 * 888    888 888  888 .d888888 888 888    888 888  888 888  888  888 888  888 
 * Y88b  d88P Y88..88P 888  888 888 888   d88P Y88..88P 888  888  888 888 d88P 
 *  "Y8888P"   "Y88P"  "Y888888 888 8888888P"   "Y88P"  888  888  888 88888P"  
 * 
 *
 * Copyright © 2016 KairusDarkSeeker
 *
 * This is a public software, you cannot redistribute it and/or modify any way
 * unless otherwise given permission to do so.
 *
 * @author KairusDarkSeeker
 * @link https://github.com/KairusDarkSeeker/
 *
 */

namespace CoalBomb;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\protocol\UseItemPacket;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\level\Explosion;
use pocketmine\event\entity\ExplosionPrimeEvent;

class Main extends PluginBase implements Listener {

	public $coalLog = [];

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CoalDespawnTask($this),1);
	}

	public function onPacketReceived(DataPacketReceiveEvent $event) {
		$packet = $event->getPacket();
		if($packet instanceof UseItemPacket and $packet->face === 0xff) {
			$player = $event->getPlayer();
			$item = $player->getInventory()->getItemInHand();
			if($item->getId() == Item::COAL && $item->getDamage() == 0) {
				$nbt = new CompoundTag ("", [
					"Pos" => new ListTag ("Pos",[
						new DoubleTag ("", $player->getX()),
						new DoubleTag ("", $player->getY() + $player->getEyeHeight()),
						new DoubleTag ("", $player->getZ())
					]),
					"Motion" => new ListTag ("Motion", [
						new DoubleTag("", - \sin($player->yaw / 180 * M_PI)*\cos($player->pitch / 180 * M_PI)),
						new DoubleTag("", - \sin ($player->pitch / 180 * M_PI )),
						new DoubleTag("",\cos($player->yaw / 180 * M_PI)*\cos($player->pitch / 180 * M_PI ))
					]),
					"Rotation" => new ListTag("Rotation", [
						new FloatTag("",$player->yaw),
						new FloatTag("", $player->pitch)
					]),
					"Health" => new ShortTag("Health", 5),
					"Item" => new CompoundTag("Item", [
						"id" => new ShortTag("id", $item->getId()),
						"Damage" => new ShortTag("Damage", $item->getDamage()),
						"Count" => new ByteTag("Count", 1)
					]),
					"PickupDelay" => new ShortTag("PickupDelay", "1")
				]);
				
				$f = 1.5;
				$coal = Entity::createEntity("Item", $player->chunk, $nbt, $player);
				$coal->setMotion($coal->getMotion()->multiply($f));
				$coal->spawnToAll();
				$player->getInventory()->removeItem(Item::get($item->getId(), $item->getDamage(),1));
				$this->coalLog[$coal->getId()] = $player->getName();
			}
		}
	}

	public function onDespawn(EntityDespawnEvent $event) {
		$entity = $event->getEntity();
		if(isset($this->coalLog[$entity->getId()])) {
			$ea = $this->coalLog[$entity->getId()];
			$player = $this->getServer()->getPlayer($ea);
			if($player instanceof Player) {
				$this->getServer()->getPluginManager()->callEvent($ev = new ExplosionPrimeEvent($entity, 4, true));
				if(!$ev->isCancelled()) {
					$explosion = new Explosion($entity, $ev->getForce(), $entity, $ev->dropItem());
					if($ev->isBlockBreaking()) {
						$explosion->explodeA();
					}
					$explosion->explodeB();
				}
			}
			unset($this->coalLog[$entity->getId()]);
		}
	}
}
