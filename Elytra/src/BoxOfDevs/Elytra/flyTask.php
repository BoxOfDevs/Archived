<?php
namespace BoxOfDevs\Elytra; 

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\network\protocol\MovePlayerPacket;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityArmorChangeEvent;
use BoxOfDevs\Elytra\events\StartFlyingEvent;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as C;
use pocketmine\IPlayer;
use pocketmine\math\Vector3;


define("TRANSPARENTS", [0, 106, 175, 31, 51, 38, 27, 40, 55, 75, 76, 93, 94, 149, 150, 171, 6, 28, 19, 30, 32, 37, 39, 44, 50, 59, 63, 66, 68, 69, 70, 72, 83, 90, 92, 96, 104, 105, 111, 115, 117, 126, 131, 132, 141, 142, 143, 147, 148, 149, 150, 151, 157, 167, 178, 183, 184, 185, 186, 187]);

   class flyTask extends PluginTask  implements Listener{
	private $plugin;
	private $player;
    public function __construct(Plugin $plugin){
        parent::__construct($plugin);
		$this->p = $plugin;
		$this->isflying = [];
        $this->lastY = [];
		$this->times = 0;
		$this->tipofthemoment = C::GREEN. "Hello!\n You are now flying with your elytra!\n Do NOT take off your elytra while flying !";
	}
	public function onRun($tick) {
		FOREACH($this->p->getServer()->getOnlinePlayers() as $this->player) {
		if(!isset($this->isflying[$this->player->getName()])) {
			$this->isflying[$this->player->getName()] = false;
		}
		if($this->isflying[$this->player->getName()] === "start") {
			$this->p->getServer()->getPluginManager()->callEvent(new StartFlyingEvent($this->player));
			$this->isflying[$this->player->getName()] = true;
		}
		if($this->times > 60.5) {
					switch(rand(1, 5)) {
						case 1:
						$this->tipofthemoment = C::GOLD."To change your direction , just swipe your finger to right or left";
						break;
						case 2:
						$this->tipofthemoment = C::DARK_RED. "You can't change your speed for now";
						break;
						case 3:
						$this->tipofthemoment = C::GREEN. "You can use your tools and items while flying !";
						break;
						case 4:
						$this->tipofthemoment = C::YELLOW. "Do NOT take off your elytra while flying !";
						break;
						case 5:
						$this->tipofthemoment = C::BLUE. "You can't die by crashing into the ground while flying!\n This makes it much more useful for survival";
						break;
					}
					$this->times = 0;
				}
		$chestplate = $this->player->getInventory()->getChestplate();
		$air = $this->player->getLevel()->getBlock(new Vector3($this->player->x, $this->player->y - 1.5, $this->player->z));
		$air2 = $this->player->getLevel()->getBlock(new Vector3($this->player->x, $this->player->y - 0.5, $this->player->z));
		if($this->isflying[$this->player->getName()] === "start" or $this->isflying[$this->player->getName()] === true or $this->isflying[$this->player->getName()] === false) {
		if($chestplate->getID() === 303 and $chestplate->getDamage() !== 1 and in_array($air->getId(), TRANSPARENTS) and in_array($air2->getId(), TRANSPARENTS) and $this->player->hasPermission("elytra.use")) {
			if($this->isflying[$this->player->getName()] === false) {
				$this->isflying[$this->player->getName()] = "start";
                $this->lastY[$this->player->getName()] = $this->player->y;
			}
			$yaw = $this->player->yaw;
			$this->player->sendPopup($this->tipofthemoment);
		    	if (0 <= $yaw and $yaw < 22.5) {
			      $this->knockBack($this->player, 0, 0, -15040, -0.125);
           } elseif (22.5 <= $yaw and $yaw < 67.5) {
                    $this->knockBack($this->player, 0, 15040, -15040, -0.125);
           } elseif (67.5 <= $yaw and $yaw < 112.5) {
                    $this->knockBack($this->player, 0, 15040, 0, -0.125);
           } elseif (112.5 <= $yaw and $yaw < 157.5) {
                    $this->knockBack($this->player, 0, 15040, 15040, -0.125);
           } elseif (157.5 <= $yaw and $yaw < 202.5) {
                    $this->knockBack($this->player, 0, 0, 15040, -0.125);
           } elseif (202.5 <= $yaw and $yaw < 247.5) {
                    $this->knockBack($this->player, 0, -15040, 15040, -0.125);
           } elseif (247.5 <= $yaw and $yaw < 292.5) {
                   $this->knockBack($this->player, 0, -15040, 0, -0.125);
           } elseif (292.5 <= $yaw and $yaw < 337.5) {
                    $this->knockBack($this->player, 0, -15040, -15040, -0.125);
           } elseif (337.5 <= $yaw and $yaw < 360) {
                    $this->knockBack($this->player, 0, 0, -15040, -0.125);
           } else {
					$this->player->sendPopup("Either you are not a player or you are in an invalid position");
			}
            $chestplate->setDamage($chestplate->getDamage() - 0.5);
            $this->player->getInventory()->setChestplate($chestplate);
                // if($this->player->y < $this->lastY[$this->player->getName()] - 0.75) {
                    // $this->player->teleport(new Vector3($this->player->x, $this->lastY[$this->player->getName()] + 1.40, $this->player->z), $this->player->yaw, $this->player->pitch / 180 * M_PI);
                // }
            $this->lastY[$this->player->getName()] = $this->player->y;
				$this->times = $this->times + 1;
		   } else {
			   $this->isflying[$this->player->getName()] = false;
		  }
		}
		}
	}
	public function onStartFlying(StartFlyingEvent $event) {
		if($event->isCancelled()) {
			$this->isflying[$this->player->getName()] = "cancelled";
		}
	}
    
    
    public function knockBack($player, $damage, $x, $z, $base) {
		$f = sqrt($x * $x + $z * $z);
		if($f <= 0){
			return;
		}
        if($player->y < ($this->lastY[$player->getName()] - 0.325)) {
            $player->teleport(new Vector3($player->x, $player->y + ($this->lastY[$player->getName()] - 0.225 - $player->y), $player->z), $player->yaw, $player->pitch);
        }

		$f = 1 / $f;

		$motion = new Vector3($player->motionX, $player->motionY, $player->motionZ);

		$motion->x /= 2;
		$motion->y /= 2;
		$motion->z /= 2;
		$motion->x += $x * $f * $base;
		$motion->y = -0.07;
        // echo $motion->y;
		$motion->z += $z * $f * $base;

		// if($motion->y > $base){
			// $motion->y = $base + 0.2;
		// }

		$player->setMotion($motion);
    }
   }
