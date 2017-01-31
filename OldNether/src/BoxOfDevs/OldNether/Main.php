<?php
namespace BoxOfDevs\OldNether ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\entity\Entity;
use pocketmine\nbt\DoubleTag;
use pocketmine\nbt\CompoundTag;
use pocketmine\nbt\FloatTag;
use pocketmine\scheduler\PluginTask;
 use pocketmine\Player;


class Main extends PluginBase implements Listener{
    
    private $task;
    
public function onEnable() {
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->task = $this->getServer()->getScheduler()->scheduleRepeatingTask(new NetherReactTask($this), 5);
 }
 

public function onInteract(PlayerInteractEvent $event) {
    
    $this->getLogger()->info($event->getBlock()->getId());
    if($event->getBlock()->getId() == 247) {
        $x = $event->getBlock()->x;
        $y = $event->getBlock()->y;
        $z = $event->getBlock()->z;
        $lvl = $event->getBlock()->getLevel();
        if($lvl->getBlock(new Vector3($x, $y-1, $z))->getId() == 4 // Cobblestone at the bottom
        and $lvl->getBlock(new Vector3($x-1, $y-1, $z))->getId() == 4
        and $lvl->getBlock(new Vector3($x+1, $y-1, $z))->getId() == 4
        and $lvl->getBlock(new Vector3($x, $y-1, $z+1))->getId() == 4
        and $lvl->getBlock(new Vector3($x, $y-1, $z-1))->getId() == 4
        and $lvl->getBlock(new Vector3($x-1, $y-1, $z-1))->getId() == 41 // Gold Blocks
        and $lvl->getBlock(new Vector3($x-1, $y-1, $z+1))->getId() == 41
        and $lvl->getBlock(new Vector3($x+1, $y-1, $z-1))->getId() == 41
        and $lvl->getBlock(new Vector3($x+1, $y-1, $z+1))->getId() == 41
        and $lvl->getBlock(new Vector3($x-1, $y, $z-1))->getId() == 4 // Cobblestone at the lvl of the reactor
        and $lvl->getBlock(new Vector3($x-1, $y, $z+1))->getId() == 4
        and $lvl->getBlock(new Vector3($x+1, $y, $z-1))->getId() == 4
        and $lvl->getBlock(new Vector3($x+1, $y, $z+1))->getId() == 4
        and $lvl->getBlock(new Vector3($x-1, $y+1, $z-1))->getId() == 0 // Air blocks at the top
        and $lvl->getBlock(new Vector3($x-1, $y+1, $z+1))->getId() == 0
        and $lvl->getBlock(new Vector3($x+1, $y+1, $z-1))->getId() == 0
        and $lvl->getBlock(new Vector3($x+1, $y+1, $z+1))->getId() == 0
        and $lvl->getBlock(new Vector3($x, $y+1, $z))->getId() == 4 // Cobblestone at the top
        and $lvl->getBlock(new Vector3($x-1, $y+1, $z))->getId() == 4
        and $lvl->getBlock(new Vector3($x+1, $y+1, $z))->getId() == 4
        and $lvl->getBlock(new Vector3($x, $y+1, $z+1))->getId() == 4
        and $lvl->getBlock(new Vector3($x, $y+1, $z-1))->getId() == 4) {
            
            
            $y -= 2;
            for($wz = $z + 7; $wz >= $z - 7; $wz++) { // Clearing the zone
                for($wx = $x + 7; $wx >= $x - 7; $wx++) {
                    for($wy = $y + 6; $wy >= $y; $wy++) {
                        if(!(!($wx < -1 or $wx > 1) and !($wz < -1 or $wz > 1) and !($wy or $wz > 3))) {
                            $lvl->setBlock(new Vector3($wx, $y, $wz), new Block(0, 0));
                        }
                    }
                }
            }
            for($wz = $z + 8; $wz >= $z - 8; $wz++) { // Ground
                for($wx = $x + 8; $wx >= $x - 8; $wx++) {
                    $lvl->setBlock(new Vector3($wx, $y, $wz), new Block(87, 0));
                }
            }
            for($wx = $x + 8; $wx >= $x - 8; $wx++) { // First wall
                for($wy = $y + 7; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($wx, $wy, $z + 8), new Block(87, 0));
                }
            }
            for($wx = $x + 8; $wx >= $x - 8; $wx++) { // Second wall
                for($wy = $y + 7; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($wx, $wy, $z - 8), new Block(87, 0));
                }
            }
            for($wz = $z + 8; $wz >= $z - 8; $wz++) {  // Third wall
                for($wy = $y + 7; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($x + 8, $wy, $wz), new Block(87, 0));
                }
            }
            for($wz = $z + 8; $wz >= $z - 8; $wz++) { // Fourth wall
                for($wy = $y + 7; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($x + 8, $wy, $wz), new Block(87, 0));
                }
            }
            for($wz = $z + 8; $wz >= $z - 8; $wz++) { // First floor
                for($wx = $x + 8; $wx >= $x; $wx++) {
                    $lvl->setBlock(new Vector3($wx, $y + 7, $wz), new Block(87, 0));
                }
            }
            
            
            for($wx = $x + 5; $wx >= $x - 5; $wx++) { // First wall
                for($wy = $y + 15; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($wx, $wy, $z + 5), new Block(87, 0));
                }
            }
            for($wx = $x + 5; $wx >= $x - 5; $wx++) { // Second wall
                for($wy = $y + 15; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($wx, $wy, $z - 5), new Block(87, 0));
                }
            }
            for($wz = $z + 5; $wz >= $z - 5; $wz++) {  // Third wall
                for($wy = $y + 15; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($x + 5, $wy, $wz), new Block(87, 0));
                }
            }
            for($wz = $z + 5; $wz >= $z - 5; $wz++) { // Fourth wall
                for($wy = $y + 15; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($x + 5, $wy, $wz), new Block(87, 0));
                }
            }
            for($wz = $z + 5; $wz >= $z - 5; $wz++) { // Second floor
                for($wx = $x + 5; $wx >= $x; $wx++) {
                    $lvl->setBlock(new Vector3($wx, $y + 15, $wz), new Block(87, 0));
                }
            }
            
            
            
            for($wx = $x + 2; $wx >= $x - 2; $wx++) { // First wall
                for($wy = $y + 17; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($wx, $wy, $z + 2), new Block(87, 0));
                }
            }
            for($wx = $x + 2; $wx >= $x - 2; $wx++) { // Second wall
                for($wy = $y + 17; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($wx, $wy, $z - 2), new Block(87, 0));
                }
            }
            for($wz = $z + 2; $wz >= $z - 2; $wz++) {  // Third wall
                for($wy = $y + 17; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($x + 2, $wy, $wz), new Block(87, 0));
                }
            }
            for($wz = $z + 2; $wz >= $z - 2; $wz++) { // Fourth wall
                for($wy = $y + 17; $wy >= $y; $wy++) {
                    $lvl->setBlock(new Vector3($x + 2, $wy, $wz), new Block(87, 0));
                }
            }
            for($wz = $z + 2; $wz >= $z - 2; $wz++) { // Third floor
                for($wx = $x + 2; $wx >= $x; $wx++) {
                    $lvl->setBlock(new Vector3($wx, $y + 17, $wz), new Block(87, 0));
                }
            }
            
            
            $this->task->add($x, $y, $z, $lvl);
        }
    }
}
 
 
 
 
 public function createEntity($id, $x, $y, $z, $lvl) {
     $chunk = $lvl->getChunk($x >> 4, $z >> 4);
     
     
     if(!($chunk instanceof \pocketmine\level\format\FullChunk)){
         return false;
     }
     
     $nbt = new CompounTag("", [
                            "Pos" => new \pocketmine\nbt\ListTag("Pos", [
                                new DoubleTag("", $x + 0.5),
                                new DoubleTag("", $y),
                                new DoubleTag("", $z + 0.5)
			                ]),
                            "Motion" => new \pocketmine\nbt\ListTag("Motion", [
                                new DoubleTag("", 0),
                                new DoubleTag("", 0),
                                new DoubleTag("", 0)
			                ]),
                            "Rotation" => new \pocketmine\nbt\ListTag("Rotation", [
				                new FloatTag("", lcg_value() * 360),
				                new FloatTag("", 0)
			                ]),
		                ]);
      $entity = Entity::createEntity($id, $chunk, $nbt);
      if($entity instanceof Entity){
          $entity->spawnToAll();
      }
 }
 
 
 
 
 
 public function getItem($id) {
     $items = [81, 406, 338, 348, 39, 40, 288, 362, 324, 262, 266, 321, 261, 281, 355, 352]; // List of all items 
     return $items[$id];
 }
}













class NetherReactTask extends PluginTask {
    
    private $reactors = [];
    
    public function __construct(Main $plugin) {
        parent::__construct($plugin);
        $this->main = $plugin;
        $this->reactors = [];
    }
    
    
    
    
    
    public function onRun($tick) {
    $id = 0;
        foreach($this->reactors as $reactor) {
            switch($reactor["time"]) {
                
                
                
                case "0":
                for($y = $reactor[$y] + 3; $y < $reactor[$y] + 1; $y++) {// Changing the reactor into glowing obsidian
                    for($z = $reactor[$z] + 1; $z < $reactor[$z] - 1; $z++) {
                        for($x = $reactor[$x] + 1; $x < $reactor[$x] - 1; $x++) {
                            if($reactor["level"]->getBlock(new Vector3($x, $y, $z))->getId() !== 0) {
                                $reactor["level"]->setBlock(new Vector3($x, $y, $z), new Block(246, 0));
                            }
                        }
                    }
                }
                $reactor["level"]->setBlock(new Vector3($reactor[$x], $y + 2, $reactor[$z]), new Block(247, 1));
                break;
                
                
                
                case "4":
                for($pigs = 0; $pigs <= 3; $pigs++) { // Spawning the pigmans
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $this->main->createEntity(36, $x, $y, $z, $reactor["level"]);
                    }
                }
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "24":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "44":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                $reactor["level"]->setTime(24000);
                break;
                
                
                
                
                case "64":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "84":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "104":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "124":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "144":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "164":
                for($items = 0; $items <= 15; $items++) { // Spawning the items
                    $randx = rand($reactor[$x] - 6, $reactor[$x] + 6);
                    $randz = rand($reactor[$z] - 6, $reactor[$z] + 6);
                    if(($randx < -2 or $randx > 2) and ($randz < -2 or $randz > 2)) { // Checking they are ot in the reactor
                        $reactor["level"]->dropItem(new Vector3($x, $y, $z), Item::get($this->m->getItem(rand(1, 15)), 0));
                    }
                }
                break;
                
                
                
                
                case "184":
                for($wz = $reactor[$z] + 7; $wz >= $reactor[$z] - 7; $wz++) { // "Breaking" the monument.
                    for($wx = $reactor[$x] + 7; $wx >= $reactor[$x] - 7; $wx++) {
                        for($wy = $reactor[$y] + 17; $wy >= $reactor[$y]; $wy++) {
                            if($lvl->setBlock(new Vector3($wx, $wy, $wz))->getId() == 87 and rand(0, 4) == 4) {
                                $lvl->setBlock(new Vector3($wx, $wy, $wz), new Block(0, 0));
                            }
                        }
                    }
                }
                $reactor["level"]->setBlock(new Vector3($reactor[$x], $reactor[$y] + 2, $reactor[$z]), new Block(247, 2));
                unset($reactors[$id]);
                break;
                
                
                
            }
            $reactors[$id]["time"]++;
        }
        $id++;
    }
    
    
    
    
    
    public function add(int $x, int $y, int $z, Level $level) {
        array_push($reactors, ["x" => $x, "y" => $y, "z" => $z, "level" => $level, "time" => 0]);
    }
}