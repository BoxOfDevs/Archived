<?php
namespace BoxOfDevs\Elytra ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\event\TranslationContainer;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\CompoundTag;


class Main extends PluginBase implements Listener{
    
    const Author = "BoxOfDevs";
    
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->getServer()->getScheduler()->scheduleRepeatingTask(new  flyTask($this), 1);
$this->flyers = [];
 }
 
 
 
public function onPlayerItemHeld(PlayerItemHeldEvent $event) {
	$item = $event->getItem();
	if($item->getId() === 303) {
	    $item->setNamedTag(\pocketmine\nbt\NBT::parseJSON("{display:{Name:\"§rElytra\"},Unbreakable:1}"));
	}
}



public function onServerCommand(ServerCommandEvent $event) {
    $cmd = explode(" ", $event->getCommand());
    //echo "cmd: " . $event->getCommand();
    if($cmd[0] == "give" and ($cmd[2] == "443" or strtolower($cmd[2]) == "elytra")) {
        if(!isset($cmd[3])) {
            $cmd[3] = 0;
        }
        if(!isset($cmd[4])) {
            $cmd[4] = 1;
        }
        if(!isset($cmd[5])) {
            $cmd[5] = "{}";
        }
        $this->giveElytra($sender, $this->getServer()->getPlayer($cmd[1]), $cmd[3], $cmd[4], $cmd[5]);
        $event->setCancelled();
    }
}


public function onPlayerCommandPreprocess(PlayerCommandPreprocessEvent $event) {
    $cmd = explode(" ", $event->getMessage());
    //echo "cmd: " . $event->getCommand();
    if($cmd[0] == "give" and ($cmd[2] == "443" or strtolower($cmd[2]) == "elytra")) {
        if(!isset($cmd[3])) {
            $cmd[3] = 0;
        }
        if(!isset($cmd[4])) {
            $cmd[4] = 1;
        }
        if(!isset($cmd[5])) {
            $cmd[5] = "{}";
        }
        $this->giveElytra($sender, $this->getServer()->getPlayer($cmd[1]), $cmd[3], $cmd[4], $cmd[5]);
        $event->setCancelled();
    }
}



public function onHurt(EntityDamageEvent $event){
    if($event->getCause() === EntityDamageEvent::CAUSE_FALL and $event->getEntity()->getInventory()->getItem($event->getEntity()->getInventory()->getSize() + 1)/* The chestplate */) {
        $event->setCancelled();
    }
}
/*
public function onArmorChange(EntityArmorChangeEvent $event) {
	if($event->getEntity() instanceof Player) {
		$player = $event->getEntity();
		$item = $event->getNewItem();
		if($item->getId() === 303 and !in_array($player->getName(), $this->flyers)) {
		    $player->sendMessage("[Elytra] You can now glide !");
		}
	}
}
*/


public function giveElytra($sender, $player, $damage, $count, $nbt) {
    $item = Item::get(303, $damage);
    $item->setCount((int) $count);
    $tags = $exception = null;
    try{
				$tags = NBT::parseJSON($nbt);
    }catch (\Throwable $ex){
				$exception = $ex;
    }
    
    
    if(!($tags instanceof CompoundTag) or $exception !== null){
				$sender->sendMessage(new TranslationContainer("commands.give.tagError", [$exception !== null ? $exception->getMessage() : "Invalid tag conversion"]));
				return true;
    }
    $item->setNamedTag($tags);

		if($player instanceof Player){
			if($item->getId() === 0){
				$sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.give.item.notFound", [$args[1]]));

				return true;
			}

			//TODO: overflow
			$player->getInventory()->addItem(clone $item);
		}else{
			$sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.generic.player.notFound"));

			return true;
		}

		Command::broadcastCommandMessage($sender, new TranslationContainer("%commands.give.success", [
			 "Elytra (443:" . $item->getDamage() . ")",
			(string) $item->getCount(),
			$player->getName()
		]));
		return true;
}
}
