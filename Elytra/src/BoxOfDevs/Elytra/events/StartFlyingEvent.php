<?php
namespace BoxOfDevs\Elytra\events;
use pocketmine\Player;
use pocketmine\event\player\PlayerEvent;
use pocketmine\event\Cancellable;
class StartFlyingEvent extends PlayerEvent implements Cancellable{
	
	public static $handlerList = null;
	
	protected $source;
	protected $player;
	
	public function __construct(Player $player){
		$this->player = $player;
	}
	
	public function getPlayer(){
		return $this->player;
	}
}