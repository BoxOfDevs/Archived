<?php

namespace Taki21;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerDeathEvent,PlayerJoinEvent,PlayerRespawnEvent};
use pocketmine\event\entity\{EntityDamageEvent,EntityDamageByEntityEvent};
use pocketmine\item\enchantment\Enchantment;
use pocketmine\command\{Command,CommandSender};
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;
use pocketmine\{Player,Server};
use pocketmine\entity\Entity;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(C::BLUE."Enabled");
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml", false);
    }
    
    public function onJoin(PlayerJoinEvent $e){
        $p = $e->getPlayer();
        $name = $p->getName();
        $this->saveResource("".$name.".yml", false);
        $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
        $coins = $this->config->get("coins");
        if($this->config->get($name) == null){
            $this->config->set("name", $name);
            $this->config->set("coins", 15000);
            $this->config->set("upgrade", "I");
            $this->config->set("kit", "II");
            $this->config->save();
            $en = Enchantment::getEnchantment(4);
            $en->setLevel(3);
            $helmet = Item::get(298,0,1);
            $chest = Item::get(299,0,1);
            $pant = Item::get(300,0,1);
            $boots = Item::get(301,0,1);
            $inv = $p->getInventory();
            $helmet->addEnchantment($en);
            $chest->addEnchantment($en);
            $pant->addEnchantment($en);
            $boots->addEnchantment($en);
            $inv->addItem($helmet);
            $inv->addItem($chest);
            $inv->addItem($pant);
            $inv->addItem($boots);
        }else{
            $this->config->set("coins", $coins + 10);
            $this->config->save();
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "I" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(1);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(2);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(3);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "IV"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(4);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "V"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(5);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "II" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(4);
                $en->setLevel(4);
                $helmet = Item::get(298,0,1);
                $chest = Item::get(299,0,1);
                $pant = Item::get(300,0,1);
                $boots = Item::get(301,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $pant->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($pant);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(4);
                $en->setLevel(3);
                $helmet = Item::get(314,0,1);
                $chest = Item::get(315,0,1);
                $pant = Item::get(316,0,1);
                $boots = Item::get(317,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $pant->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($pant);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(4);
                $en->setLevel(2);
                $helmet = Item::get(302,0,1);
                $chest = Item::get(303,0,1);
                $pant = Item::get(304,0,1);
                $boots = Item::get(305,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $pant->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($pant);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "IV"){
                $en = Enchantment::getEnchantment(0);
                $en->setLevel(3);
                $helmet = Item::get(306,0,1);
                $chest = Item::get(307,0,1);
                $boots = Item::get(309,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "V"){
                $en = Enchantment::getEnchantment(0);
                $en->setLevel(2);
                $chest = Item::get(311,0,1);
                $boots = Item::get(313,0,1);
                $inv = $p->getInventory();
                $chest->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($chest);
                $inv->addItem($boots);
            }
            
            if($this->kit == "III" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(3);
                $en->setLevel(3);
                $pant = Item::get(316,0,1);
                $inv = $p->getInventory();
                $pant->addEnchantment($en);
                $inv->addItem($pant);
                $inv->addItem(Item::get(46,0,4));
                $inv->addItem(Item::get(152,0,4));
            }
            
            if($this->kit == "III" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(3);
                $en->setLevel(3);
                $pant = Item::get(308,0,1);
                $inv = $p->getInventory();
                $pant->addEnchantment($en);
                $inv->addItem($pant);
                $inv->addItem(Item::get(46,0,8));
                $inv->addItem(Item::get(152,0,8));
            }
            
            if($this->kit == "III" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(3);
                $en->setLevel(3);
                $pant = Item::get(312,0,1);
                $inv = $p->getInventory();
                $pant->addEnchantment($en);
                $inv->addItem($pant);
                $inv->addItem(Item::get(46,0,16));
                $inv->addItem(Item::get(152,0,16));
            }
            
            if($this->kit == "IV" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(12); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(3);
                $sword = Item::get(268,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(9); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(2);
                $sword = Item::get(283,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(9); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(1);
                $sword = Item::get(272,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "IV"){
                $en = Enchantment::getEnchantment(13); // 9 = Sharpness while 12 = Knockback and 13 = Fire_Aspect
                $en->setLevel(1);
                $sword = Item::get(267,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "V"){
                $en = Enchantment::getEnchantment(9); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(1);
                $sword = Item::get(276,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "V" && $this->upgrade == "I"){
                $sword = Item::get(268,0,1);
                $potion = Item::get(373,8258,1);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "II"){
                $sword = Item::get(283,0,1);
                $potion = Item::get(373,8258,3);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "III"){
                $sword = Item::get(272,0,1);
                $potion = Item::get(373,8194,1);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "IV"){
                $sword = Item::get(267,0,1);
                $potion = Item::get(373,8194,3);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "V"){
                $sword = Item::get(276,0,1);
                $potion = Item::get(373,8194,5);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
        }
    }
    
    public function onCommand(CommandSender $s, Command $cmd, $label, array $args){
        if(strtolower($cmd->getName() == "kit1")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "I" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(1);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(2);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(3);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "IV"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(4);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
            
            if($this->kit == "I" && $this->upgrade == "V"){
                $en = Enchantment::getEnchantment(19);
                $en->setLevel(5);
                $bow = Item::get(261,0,1);
                $arrows = Item::get(262,0,64);
                $inv = $p->getInventory();
                $bow->addEnchantment($en);
                $inv->addItem($bow);
                $inv->addItem($arrows);
            }
        }
        
        if(strtolower($cmd->getName() == "k1u")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "I" && $this->upgrade == "I"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","II");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 2");
                }
            }
            
            if($this->kit == "I" && $this->upgrade == "II"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","III");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 3");
                }
            }
            
            if($this->kit == "I" && $this->upgrade == "III"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","IV");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 4");
                }
            }
            
            if($this->kit == "I" && $this->upgrade == "IV"){
                if(count($coins >= 30000)){
                    $this->config->set("coins", $coins - 30000);
                    $this->config->set("upgrade","V");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 5!");
                }
            }
        }
        
        if(strtolower($cmd->getName() == "kit2")){
            $p = $s;
            $name = $p->getName();
            
            if($this->kit == "II" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(4);
                $en->setLevel(4);
                $helmet = Item::get(298,0,1);
                $chest = Item::get(299,0,1);
                $pant = Item::get(300,0,1);
                $boots = Item::get(301,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $pant->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($pant);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(4);
                $en->setLevel(3);
                $helmet = Item::get(314,0,1);
                $chest = Item::get(315,0,1);
                $pant = Item::get(316,0,1);
                $boots = Item::get(317,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $pant->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($pant);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(4);
                $en->setLevel(2);
                $helmet = Item::get(302,0,1);
                $chest = Item::get(303,0,1);
                $pant = Item::get(304,0,1);
                $boots = Item::get(305,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $pant->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($pant);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "IV"){
                $en = Enchantment::getEnchantment(0);
                $en->setLevel(3);
                $helmet = Item::get(306,0,1);
                $chest = Item::get(307,0,1);
                $boots = Item::get(309,0,1);
                $inv = $p->getInventory();
                $helmet->addEnchantment($en);
                $chest->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($helmet);
                $inv->addItem($chest);
                $inv->addItem($boots);
            }
            
            if($this->kit == "II" && $this->upgrade == "V"){
                $en = Enchantment::getEnchantment(0);
                $en->setLevel(2);
                $chest = Item::get(311,0,1);
                $boots = Item::get(313,0,1);
                $inv = $p->getInventory();
                $chest->addEnchantment($en);
                $boots->addEnchantment($en);
                $inv->addItem($chest);
                $inv->addItem($boots);
            }
        }
        
        if(strtolower($cmd->getName() == "k2u")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            $coins = $this->config->get("coins");
            
            if($this->kit == "II" && $this->upgrade == "I"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set($this->upgrade,"II");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 2");
                }
            }
            
            if($this->kit == "II" && $this->upgrade == "II"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","III");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 3");
                }
            }
            
            if($this->kit == "II" && $this->upgrade == "III"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","IV");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 4");
                }
            }
            
            if($this->kit == "II" && $this->upgrade == "IV"){
                if(count($coins >= 30000)){
                    $this->config->set("coins", $coins - 30000);
                    $this->config->set("upgrade","V");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 5!");
                }
            }
        }
        
        if(strtolower($cmd->getName() == "kit3")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "III" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(3);
                $en->setLevel(3);
                $pant = Item::get(316,0,1);
                $inv = $p->getInventory();
                $pant->addEnchantment($en);
                $inv->addItem($pant);
                $inv->addItem(Item::get(46,0,4));
                $inv->addItem(Item::get(152,0,4));
            }
            
            if($this->kit == "III" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(3);
                $en->setLevel(3);
                $pant = Item::get(308,0,1);
                $inv = $p->getInventory();
                $pant->addEnchantment($en);
                $inv->addItem($pant);
                $inv->addItem(Item::get(46,0,8));
                $inv->addItem(Item::get(152,0,8));
            }
            
            if($this->kit == "III" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(3);
                $en->setLevel(3);
                $pant = Item::get(312,0,1);
                $inv = $p->getInventory();
                $pant->addEnchantment($en);
                $inv->addItem($pant);
                $inv->addItem(Item::get(46,0,16));
                $inv->addItem(Item::get(152,0,16));
            }
        }
        
        if(strtolower($cmd->getName() == "k3u")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "III" && $this->upgrade == "I"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","II");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 2");
                }
            }
            
            if($this->kit == "III" && $this->upgrade == "II"){
                if(count($coins >= 30000)){
                    $this->config->set("coins", $coins - 30000);
                    $this->config->set("upgrade","III");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 3");
                }
            }
        }
        
        if(strtolower($cmd->getName() == "kit4")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "IV" && $this->upgrade == "I"){
                $en = Enchantment::getEnchantment(12); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(3);
                $sword = Item::get(268,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "II"){
                $en = Enchantment::getEnchantment(9); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(2);
                $sword = Item::get(283,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "III"){
                $en = Enchantment::getEnchantment(9); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(1);
                $sword = Item::get(272,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "IV"){
                $en = Enchantment::getEnchantment(13); // 9 = Sharpness while 12 = Knockback and 13 = Fire_Aspect
                $en->setLevel(1);
                $sword = Item::get(267,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
            
            if($this->kit == "IV" && $this->upgrade == "V"){
                $en = Enchantment::getEnchantment(9); // 9 = Sharpness while 12 = Knockback
                $en->setLevel(1);
                $sword = Item::get(276,0,1);
                $inv = $p->getInventory();
                $sword->addEnchantment($en);
                $inv->addItem($sword);
            }
        }
        
        if(strtolower($cmd->getName() == "k4u")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "IV" && $this->upgrade == "I"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","II");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 2");
                }
            }
            
            if($this->kit == "IV" && $this->upgrade == "II"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","III");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 3");
                }
            }
            
            if($this->kit == "IV" && $this->upgrade == "III"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","IV");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 4");
                }
            }
            
            if($this->kit == "IV" && $this->upgrade == "IV"){
                if(count($coins >= 30000)){
                    $this->config->set("coins", $coins - 30000);
                    $this->config->set("upgrade","V");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 5!");
                }
            }
        }
        
        if(strtolower($cmd->getName() == "kit5")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "V" && $this->upgrade == "I"){
                $sword = Item::get(268,0,1);
                $potion = Item::get(373,8258,1);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "II"){
                $sword = Item::get(283,0,1);
                $potion = Item::get(373,8258,3);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "III"){
                $sword = Item::get(272,0,1);
                $potion = Item::get(373,8194,1);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "IV"){
                $sword = Item::get(267,0,1);
                $potion = Item::get(373,8194,3);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
            
            if($this->kit == "V" && $this->upgrade == "V"){
                $sword = Item::get(276,0,1);
                $potion = Item::get(373,8194,5);
                $inv = $p->getInventory();
                $inv->addItem($sword);
                $inv->addItem($potion);
            }
        }
        
        if(strtolower($cmd->getName() == "k5u")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $this->kit = $this->config->get("kit");
            $this->upgrade = $this->config->get("upgrade");
            
            if($this->kit == "V" && $this->upgrade == "I"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","II");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 2");
                }
            }
            
            if($this->kit == "V" && $this->upgrade == "II"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","III");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 3");
                }
            }
            
            if($this->kit == "V" && $this->upgrade == "III"){
                if(count($coins >= 15000)){
                    $this->config->set("coins", $coins - 15000);
                    $this->config->set("upgrade","IV");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 4");
                }
            }
            
            if($this->kit == "V" && $this->upgrade == "IV"){
                if(count($coins >= 30000)){
                    $this->config->set("coins", $coins - 30000);
                    $this->config->set("upgrade","V");
                    $this->config->save();
                    $p->sendMessage(C::GREEN."You've Been Successfully Upgraded to Level 5!");
                }
            }
        }
        
        if(strtolower($cmd->getName() == "mycoins")){
            $p = $s;
            $name = $p->getName();
            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
            $coins = $this->config->get("coins");
            $p->sendMessage(C::GOLD."You currently have $coins coins.");
        }
        
        if(strtolower($cmd->getName() == "ac")){
            if($s->isOp()){
                if(!isset($args[0])){
                    $s->sendMessage(C::RED."Usage: /ac <player> <amount.of.coins>");
                }else{
                    if(!isset($args[1])){
                        $s->sendMessage(C::RED."Usage: /ac <player> <amount.of.coins>");
                    }else{
                        $target = $args[0];
                        if(!file_exists($this->getDataFolder(). "".$target.".yml")){
                            $s->sendMessage(C::RED."That Player Doesn't Exist!");
                        }else{
                            $name = $s->getName();
                            $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
                            $coins = $this->config->get("coins");
                            $amount_of_coins = $args[1];
                            if(is_numeric($amount_of_coins)){
                                $int = intval($amount_of_coins);
                                $coins = $this->config->get("coins");
                                $this->config->set("coins", $coins + $int);
                            }else{
                                $s->sendMessage(C::RED."Please Provide a Integer (can be negative or positive)");
                            }
                        }
                    }
                }
            }else{
                $s->sendMessage(C::RED."This command cannot be used by NON OPS");
            }
        }
        return true;
    }
    
    public function playerDeathEvent(PlayerDeathEvent $event){
        $cause = $event->getEntity()->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent){
            $killer = $cause->getDamager();
            if($killer instanceof Player){
                $name = $killer->getName();
                $this->config = new Config($this->getDataFolder(). "".$name.".yml", Config::YAML);
                $coins = $this->config->get("coins");
                $this->config->set("coins", $coins + 65);
                $this->config->save();
                $killer->sendMessage(C::GOLD."+1 Kill (65 Coins)");
            }
        }
    }
    
    public function onDisable(){
        $this->saveResource("config.yml");
        $this->getLogger()->info(C::RED."Disabled Plugin!");
    }
    
}