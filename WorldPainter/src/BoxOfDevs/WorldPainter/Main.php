<?php
namespace BoxOfDevs\WorldPainter ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\utils\TextFormat as C;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\scheduler\PluginTask; 
use pocketmine\Player;


 define("Prefix", C::YELLOW . "[" . C::GOLD . "WorldPainter" . C::YELLOW . "] ", true);
 define("M_PLACE", "PlayerModePlace");
 define("M_REPLACE", "PlayerModeReplace");
 define("M_BOTH", "PlayerModeBoth");
 define("CG", C::GREEN); // Green color shortcut
 define("CR", C::RED); // Red color shortcut
 define("CY", C::YELLOW); // Yellow color shortcut
 define("CO", C::GOLD); // Orange color shortcut
 
 
 
class Main extends PluginBase{
    
public function onEnable(){
    $this->mode = [];
    $this->radius = [];
    $this->block = [];
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new PaintTask($this), 5);
// $this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
 
 
 
 public function lastemptyblock(Player $player) {
     $fillblock = $player->getTargetBlock(20);
     $block = new \BoxOfDevs\WorldPainter\GetEmptyBlock($player, $fillblock);
     return $block->block;
 }
 
 
 
 
 
 public function getBlock(\string $cblock) { // Format example: "1:0%90,6:0%10" 
 
     if(strpos($cblock, ",")) { // If there is a proportion.
         $cblocks = explode(",", $cblock);
         $blocks = [];
         $rand = rand(0, 100);
         $base = 0; // To be sure that there is one possibility
         foreach($cblocks as $cblock2) {
             
             if(strpos($cblock2, "%")) {
                 $pblock = explode("%", $cblock2);
                 if($base + $pblock[1] > $rand) {
                     if(strpos($pblock[0], ":")) {
                         $ids = explode(":", $pblock[0]);
                         $id = $ids[0];
                         $md = $ids[1];
                     } else {
                         $id = $pblock[0];
                         $md = 0;
                     }
                     return new Block($id, $md);
                 } else {
                     $base = $base + $pblock[1];
                 }
             }
             
         }
         
     } else { // If there is only one block
         if(strpos($pblock[0], ":")) {
           $ids = explode(":", $pblock[0]);
           $id = $ids[0];
           $md = $ids[1];
       } else {
           $id = $pblock[0];
           $md = 0;
       }
       return new Block($id, $md);
     }
 }
 
 
 
 
 
 
 public function parseBlock(\string $cblock) { // Format example: "1:0%90,6:0%10" 
 
     if(strpos($cblock, ",")) { // If there is a proportion.
         $cblocks = explode(",", $cblock);
         $blocks = [];
         foreach($cblocks as $cblock2) {
             
             if(strpos($cblock2, "%")) {
                 $pblock = explode("%", $cblock2);
                 array_push($blocks, Item::fromString($pblock[0])->getName() . " with " .  $pblock[1] . "percents");
             } else {
                 return false; // Isn't a valid format.
             }
             
         }
         return implode(", ", $blocks);
         
     } else { // If there is only one block
         return Item::fromString($cblock);
     }
 }
 
 
 
 
 
 
 
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
     switch($cmd->getName()){
         
         
         
         
         case "/wpwand": // This will be used to detect when does the player wants to use the wand
         if($sender instanceof Player) {
             $sender->getInventory()->addItem(\pocketmine\Item::get($this->getConfig()->get("WandId")));
             $this->modes[$sender->getName()] = M_PLACE;
             $sender->sendMessage(Prefix . CG . "You got now the WorldPainter wand.");
         } else {
             $sender->sendMessage(PREFIX . CR . "You can only use this command in game !");
         }
         break;
         
         
         
         
         case "/mode": // To change between replacing and placing
         if($sender instanceof Player and isset($args[0])) {
             switch(strtolower($args[0])) {
                 case "place": // Entering in place mode
                 $this->modes[$sender->getName()] = M_PLACE;
                 $sender->sendMessage(PREFIX . CG . "You have succefully entered in Place mode.");
                 break;
                 case "place": // Entering in replace mode
                 $this->modes[$sender->getName()] = M_REPLACE;
                 $sender->sendMessage(PREFIX . CG . "You have succefully entered in Replace mode.");
                 break;
                 case "both": // Entering in replace AND player mode
                 $this->modes[$sender->getName()] = M_BOTH;
                 $sender->sendMessage(PREFIX . CG . "You have succefully entered in Replace mode.");
                 break;
                 default: // Not a correct mode
                 $sender->sendMessage(PREFIX . CR . "Mode {$args[0]} does not exists !");
                 break;
             }
         } elseif(!$sender instanceof Player) {
             $sender->sendMessage(PREFIX . CR . "You can only use this command in game !");
         } else {
             return false;
         }
         break;
         
         
         
         
         case "/radius":
         if($sender instanceof Player and isset($args[0])) {
             if(is_numeric($args[0])) {
                 $this->radius[$sender->getName()] = $args[0];
                 $sender->sendMessage(PREFIX . CG . "Your radius has been set to {$args[0]}");
             } else {
                 $sender->sendMessage(PRefix . CR . "A radius must be numeric");
             }
         } elseif(!$sender instanceof Player) {
             $sender->sendMessage(PREFIX . CR . "You can only use this command in game !");
         } else {
             return false;
         }
         break;
         
         
         
         
         
         case "/block":
         if($sender instanceof Player and isset($args[0])) {
             if($this->parseBlock($args[0]) !== false) {
                 $this->block[$sender->getName()] = $args[0];
                 $sender->sendMessage(PREFIX  . CG . "You have succefully set your block to {$this->parseBlock($args[0])}");
             } else {
                 $sender->sendMessage(PREFIX . CR . "You haven't set a real block !");
             }
         } elseif(!$sender instanceof Player) {
             $sender->sendMessage(PREFIX . CR . "You can only use this command in game !");
         } else {
             return false;
         }
         break;
         
         
         
         

         
     }
     return false;
 }
}




















class PaintTask extends PluginTask {
    
    
    public function __construct(Plugin $main) {
        parent::__construct($main);
        $this->m = $main;
        $this->cfg = $main->getConfig();
        $this->wandid = $main->getConfig()->get("WandId");
    }
    
    
    
    public function place(Player $player) {
        switch($this->m->mode[$player->getName()]) {
            
            case M_PLACE:
            $centerblock = $this->m->lastemptyblock($player);
            if(!isset($this->m->radius[$player->getName()])) {
                $this->m->radius[$player->getName()] = 1;
            }
            $r = $this->m->radius[$player->getName()];
            for($x = $centerblock->x - $r / 2; $x <= $centerblock->x + $r / 2; $x++) {
                for($y = $centerblock->y - $r / 2; $y <= $centerblock->y + $r / 2; $y++) {
                    for($z = $centerblock->z - $r / 2; $z <= $centerblock->z + $r / 2; $z++) {
                        if($player->getLevel()->getBlock(new Vector3($x, $y, $z))->getId() == 0) {
                            $player->getLevel()->setBlock(new Vector3($x, $y, $z), $this->m->getBlock($this->m->block[$player->getName()]));
                        }
                    }
                }
            }
            break;
            
            case M_BOTH:
            $centerblock = $player->getTargetBlock(20);
            if(!isset($this->m->radius[$player->getName()])) {
                $this->m->radius[$player->getName()] = 1;
            }
            $r = $this->m->radius[$player->getName()];
            for($x = $centerblock->x - $r / 2; $x <= $centerblock->x + $r / 2; $x++) {
                for($y = $centerblock->y - $r / 2; $y <= $centerblock->y + $r / 2; $y++) {
                    for($z = $centerblock->z - $r / 2; $z <= $centerblock->z + $r / 2; $z++) {
                        $player->getLevel()->setBlock(new Vector3($x, $y, $z), $this->m->getBlock($this->m->block[$player->getName()]));
                    }
                }
            }
            break;
            
            case M_REPLACE:
            $centerblock = $player->getTargetBlock(20);
            if(!isset($this->m->radius[$player->getName()])) {
                $this->m->radius[$player->getName()] = 1;
            }
            $r = $this->m->radius[$player->getName()];
            for($x = $centerblock->x - $r / 2; $x <= $centerblock->x + $r / 2; $x++) {
                for($y = $centerblock->y - $r / 2; $y <= $centerblock->y + $r / 2; $y++) {
                    for($z = $centerblock->z - $r / 2; $z <= $centerblock->z + $r / 2; $z++) {
                        if($player->getLevel()->getBlock(new Vector3($x, $y, $z))->getId() !== 0) {
                            $player->getLevel()->setBlock(new Vector3($x, $y, $z), $this->m->getBlock($this->m->block[$player->getName()]));
                        }
                    }
                }
            }
            break;
            
            default:
            $this->m->mode[$player->getName()] = M_PLACE;
            $player->sendMessage(PREFIX . CY . "Switched to Place mode.");
            break;
        }
    }
    
    
    
    
    public function onRun($tick) {
        foreach($this->m->getServer()->getOnlinePlayers() as $player) {
            if($player->getInventory()->getItemInHand()->getId() === $this->wandid and $player->hasPermission('wp.use')) {
                $this->place($player);
            }
        }
    }
    
    
    
    
    
}
