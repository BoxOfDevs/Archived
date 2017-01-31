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

use pocketmine\scheduler\PluginTask;
use pocketmine\entity\Item;

class CoalDespawnTask extends PluginTask {

	public function __construct(Main $plugin) {
		parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	
	public function onRun($currentTick){
		foreach($this->plugin->getServer()->getLevels() as $lvls){
			foreach($lvls->getEntities() as $ent){
				if($ent instanceof Item){
					if(isset($this->plugin->coalLog[$ent->getId()])){
						$b_below = $ent->getLevel()->getBlockIdAt($ent->getX(),$ent->getY() - 1,$ent->getZ());
						$b_side1 = $ent->getLevel()->getBlockIdAt($ent->getX() + 0.1,$ent->getY(),$ent->getZ());
						$b_side2 = $ent->getLevel()->getBlockIdAt($ent->getX() - 0.1,$ent->getY(),$ent->getZ());
						$b_side3 = $ent->getLevel()->getBlockIdAt($ent->getX(),$ent->getY(),$ent->getZ() + 0.1);
						$b_side4 = $ent->getLevel()->getBlockIdAt($ent->getX(),$ent->getY(),$ent->getZ() - 0.1);
						if($b_below != 0 || $b_side1 != 0 || $b_side2 != 0 || $b_side3 != 0 || $b_side4 != 0){
							$ent->close();
						}
					}
				}
			}
		}
	}
}
