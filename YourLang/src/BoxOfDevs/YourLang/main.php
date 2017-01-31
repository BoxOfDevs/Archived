<?php
namespace BoxOfDevs\YourLang;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\Server;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("YourLang by BoxOfDevs Team enabled!");
        $this->saveDefaultConfig();
        $this->saveResource("data.yml");
        $this->data = new Config($this->getDataFolder(). "data.yml", Config::YAML);
    }
    
    public function onDisable(){
        $this->data->save();
    }

    public function getLangMsg($p, array $msg){
        $dlang = $this->getConfig()->get("default_lang");
        if($p instanceof Player or (is_str($p) and $this->getServer()->getPlayer($p) !== null)){
            $p = $p->getName();
        }else{
            $p = "console";
        }
        $pname = $p;
        $p = strtolower($p);
        if(!isset($this->data->get[$p])){
            $lang = $dlang;
        }else{
            $lang = $this->data->get[$p];
        }
        if(!isset($msg[$lang])){
            if(isset($msg[$dlang])){
                $lang = $dlang;
            }elseif(isset($msg["en"])){
                $lang = "en";
            }elseif(!isset($msg[$dlang]) && !isset($msg["en"])){
                $msg_arr = implode(", ", $msg);
                $this->getLogger()->warning("§4[Error]§f No message in the default language AND no message in English (en) found while sending this YourLang message to a player: ".$msg_arr);
                $message = $this->getConfig()->get("error_no_default_lang");
                $message = str_replace("{used_msg}", $msg_arr, $message);
                return $message;
            }
        }
        $message = $msg[$lang];
        $message = str_replace("&", "§", $message);
        $message = str_replace("{player}", $pname, $message);
        return $message;
    }

    public function langBroadcast(array $msg, string $type = "msg"){
        foreach ($this->getServer()->getOnlinePlayers() as $p) {
            $langmsg = $this->getLangMsg($p, $msg);
            if($type = "tip"){
                $p->sendTip($langmsg);
            }elseif($type = "popup"){
                $p->sendPopup($langmsg);
            }else{
                $p->sendMessage($langmsg);
            }
            $cons_msg = $this->getLangMsg("console", $msg);
            $this->getLogger()->info("Broadcasted (Type: ".$type."): ".$cons_msg);
        }
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
            case "langbroadcast":
                if(!isset($args[0])){
                    return false;
                    break;
                }else{
                    $vars = $this->getConfig->get("msgs_for_builtin_cmds");
                    $arg = strtolower($args[0]);
                    if(isset($args[1])){
                        $type = strtolower($args[1]);
                    }else{
                        $type = "msg";
                    }
                    if(isset($vars[$arg])){
                        $msg = $vars[$arg];
                        $this->langBroadcast($msg, $type);
                        break;
                    }else{
                        $sender->sendMessage("§4[Error]§f Message ".$arg." not found!\nPlease make sure that you have written the message-name in the config.yml without any caps!");
                        break;
                    }
                    break;
                }
                break;
            case "langtell":
                if(count($args) < 2){
                    return false;
                    break;
                }else{
                    $p = $this->getServer()->getPlayer($args[0]);
                    if(!$p instanceof Player){
                        $sender->sendMessage("Player ".$args[0]." not found!");
                        break;
                    }else{
                        $vars = $this->getConfig->get("msgs_for_builtin_cmds");
                        $arg = strtolower($args[1]);
                        if(isset($args[2])){
                            $type = strtolower($args[2]);
                        }else{
                            $type = "msg";
                        }
                        if(isset($vars[$arg])){
                            $msg = $vars[$arg];
                            $langmsg = $this->getLangMsg($p, $msg);
                            $sender->sendMessage("Successfully sent a message to ".$args[0]." (Type: ".$type.").");
                            if($type = "tip"){
                                $p->sendTip($langmsg);
                                break;
                            }elseif($type = "popup"){
                                $p->sendPopup($langmsg);
                                break;
                            }else{
                                $p->sendMessage($langmsg);
                                break;
                            }
                            break;
                        }else{
                            $sender->sendMessage("§4[Error]§f Message ".$arg." not found!\nPlease make sure that you have written the message-name in the config.yml without any caps!");
                            break;
                        }
                        break;
                    }
                    break;
                }
                break;
            case "langme":
                if(!isset($args[0])){
                    return false;
                    break;
                }else{
                    $vars = $this->getConfig->get("msgs_for_builtin_cmds");
                    $arg = strtolower($args[0]);
                    if(isset($args[1])){
                        $type = strtolower($args[1]);
                    }else{
                        $type = "msg";
                    }
                    if(isset($vars[$arg])){
                        $msg = $vars[$arg];
                        $langmsg = $this->getLangMsg($sender, $msg);
                        if($type = "tip"){
                            $sender->sendTip($langmsg);
                            break;
                        }elseif($type = "popup"){
                            $sender->sendPopup($langmsg);
                            break;
                        }else{
                            $sender->sendMessage($langmsg);
                            break;
                        }
                        break;
                    }else{
                        $sender->sendMessage("§4[Error]§f Message ".$arg." not found!\nPlease make sure that you have written the message-name in the config.yml without any caps!");
                        break;
                    }
                    break;
                }
                break;
            case "changelang":
                if(!$sender instanceof Player){
                    $sender->sendMessage($this->getConfig()->get("console_msg"));
                    break;
                }else{
                    $langs = $this->getConfig()->get("available_langs");
                    $lang = $args[0];
                    $lang = strtolower($lang);
                    if(!isset($args[0]) || !in_array($lang, $langs)){
                        $msg = $this->getConfig()->get("changelang_usage");
                        $msg = str_replace("{langs}", implode(", ", $langs), $msg);
                        $sender->sendMessage($msg);
                        break;
                    }else{
                        $p = $sender->getName();
                        $p = strtolower($p);
                        $this->data->set($p, $lang);
                        $this->data->save();
                        $msg = $this->getConfig()->get("changed_lang_msg");
                        $msg = str_replace("{lang}", $lang, $msg);
                        $sender->sendMessage($msg);
                        break;
                    }
                    break;
                }
                break;
        }
        return true;
    }
}
