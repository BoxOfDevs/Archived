<?php
namespace BoxOfDevs\FileManager ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;
use pocketmine\utils\Config;
use pocketmine\Server;
 use pocketmine\Player;

 const MDIR = "dir";
 const MFILE = "file";
define("ERROR_INVALID_CMD", "Error, the command you're trying to execute do NOT exist !");
class Main extends PluginBase implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->sessions = [];
$this->ranks = []; // if OP or not 
$this->path = [];
$this->type = [];


$this->cmdcfg = ["type <yaml | propreties | json | serialize>",
"read",
"set <object> <new object>",
"get <object>",
"close"];


$this->cmdcfgdesc = ["Change config type",
"Read all contents of the config",
"Set a paramater of the config",
"Get a parameter of the config",
"Close config editor and go to directory"];


$this->cmddir = ["cd <foldername[/<sub dir[/<sub dir[...]>]>]>>",
"pwd",
"ls",
"file <filename>"];

$this->cmddirdesc = ["Move to a selected repertory",
"Check current path",
"Get all the directories and files in your current directory",
"Go in edit mode for a selected file"];

$this->cmdfile = ["read",
"addtext <text>",
"rpl <text to replace>---<replacement>",
"rmtext <text to remove>",
"close"];


$this->cmdfiledesc = ["Read all contents of the file",
"Add text at the end of the file",
"Replace specific texts in the file by another specific text",
"Remove a specific",
"Close file editor and go to directory"];
 }
public function onChat(PlayerChatEvent $event){
    if(isset($this->sessions[$event->getPlayer()->getName()])) {
        $cmd = explode(" ", $event->getMessage());
        if(!count($cmd) < 2) {
        $this->exeCmd($event->getPlayer(), $cmd);
        } else {
            $event->getPlayer()->sendMessage(C::RED . "Please enter at least an argument");
        }
        $event->setCancelled();
    }
}
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
switch($cmd->getName()){
    case "manage-files":
    if(isset($this->sessions[$sender->getName()])) {
        unset($this->sessions[$sender->getName()]);
        unset($this->path[$sender->getName()]);
        unset($this->type[$sender->getName()]);
        if($sender->isOp()) {
            $this->getServer()->getPluginManager()->subscribeToPermission(Server::BROADCAST_CHANNEL_ADMINISTRATIVE, $sender);
        }
       $this->getServer()->getPluginManager()->subscribeToPermission(Server::BROADCAST_CHANNEL_USERS, $sender);
        $sender->sendMessage(C::RED ."You left the file manager mode, relog to get back to game");
    } elseif($sender instanceof Player) {
    $this->sessions[$sender->getName()] = "dir";
    $this->path[$sender->getName()] = "";
    $this->getServer()->removeOnlinePlayer($sender);
	$this->getServer()->removePlayer($sender);
    $this->getServer()->getPluginManager()->unsubscribeFromPermission(Server::BROADCAST_CHANNEL_ADMINISTRATIVE, $sender);
    $this->getServer()->getPluginManager()->unsubscribeFromPermission(Server::BROADCAST_CHANNEL_USERS, $sender);
	foreach($this->getServer()->getOnlinePlayers() as $player){
				if($player->canSee($sender)){
					$player->hidePlayer($sender);
				}
	}
	unset($sender->buffer);
    $sender->sendMessage(C::GREEN . "You entered the file manager mode, you don't receive messages anymore and other players don't see you anymore ! Get informations on how to navigate and edit thouth files ay http://wiki.boxofdevs.ml/FileManager/ .");
    } else {
        $sender->sendMessage("Why are you trying to edit file thougth the console? Just use your file manager app instead cilly xD !");
    }
    return true;
    break;
}
return false;
 }
 private function exeCmd($player, $cmd) {
     $serverpath = $this->getServer()->getDataPath();
     $player->sendMessage("/".$this->path[$player->getName()] . "> " . implode(" ", $cmd));
     $this->getServer()->getLogger()->info($player->getName()."@/".$this->path[$player->getName()] . "> " . implode(" ", $cmd));
     switch($this->sessions[$player->getName()]) {
         case "dir":
         switch($cmd[0]) {
             
             
         case "cd":
         if(strpos($cmd[1], "/")) {
             $path = explode("/", $cmd[1]);
             foreach($path as $dir) {
                 if(is_dir($serverpath . $this->path[$player->getName()] . $dir)) {
                     if($dir === "..") {
                         $plpath = explode("/", $this->path[$player->getName()]);
                         unset($plpath[count($plpath) - 1]);
                         $this->path[$player->getName()] = implode("/", $plpath);
                     } elseif($dir === ".") {
                     } else {
                         $this->path[$player->getName()] = $this->path[$player->getName()] . $dir;
                         $player->sendMessage(C::GREEN . "Moving to " . $this->path[$player->getName()] . $dir);
                     }
                 } else {
                     $player->sendMessage(C::RED . "Error, directory $dir not found");
                 }
             }
         } else {
             $dir = $cmd[1];
             if(is_dir($serverpath . $this->path[$player->getName()] . $dir)) {
                     if($dir === "..") {
                         $plpath = explode("/", $this->path[$player->getName()]);
                         unset($plpath[count($plpath) - 1]);
                         $this->path[$player->getName()] = implode("/", $plpath);
                     } elseif($dir === ".") {
                     } else {
                         $this->path[$player->getName()] = $this->path[$player->getName()] . $dir;
                         $player->sendMessage(C::GREEN . "Moving to " . $this->path[$player->getName()]);
                     }
                 } else {
                     $player->sendMessage(C::RED . "Error, directory $dir not found");
                 }
         }
         break;
         
         
         case "pwd":
         $player->sendMessage(C::GREEN . "Your path : /".$this->path[$player->getName()]);
         break;
         
         
         case "ls":
         $dirs = [];
         $files = [];
         foreach(array_diff(scandir($serverpath . $this->path[$player->getName()]), array('..', '.')) as $path) {
             if(is_dir($serverpath . $this->path[$player->getName()] . $path)) {
                 array_push($dirs, $path);
             } else {
                 array_push($files, $path);
             }
         }
             foreach($files as $file) {
                 $player->sendMessage(C::GREEN . "File : ".$this->path[$player->getName()] . "/" . $file);
             }
             foreach($dirs as $dir) {
                 $player->sendMessage(C::GREEN . "Folder : ".$this->path[$player->getName()] . "/" . $dir);
             }
         break;
         
         
         case "file":
         if(file_exists($serverpath. $this->path[$player->getName()] . "/" . $cmd[1])) {
             foreach($this->getConfig()->get("denied-ext") as $ext) {
                     if($ext === pathinfo(file_exists($serverpath. $this->path[$player->getName()] . "/" . $cmd[1]))["extension"]) {
                         $player->sendMessage(C::RED . "Error. You don't have the permission / you can't see file $cmd[1]");
                         $denied = true;
                     }
                 }
                 foreach($this->getConfig()->get("denied-files") as $file) {
                     if($file === $this->path[$player->getName()] . "/" . $cmd[1]) {
                         $player->sendMessage(C::RED . "Error. You don't have the permission / you can't see file $cmd[1]");
                         $denied = true;
                     }
                 }
                 if(!isset($denied)) {
                 switch(pathinfo(file_exists($serverpath. $this->path[$player->getName()] . "/" . $cmd[1]))["extension"]) {
                 case "yml":
                 case "json":
                 case "propreties":
                 case "js":
                 case "sl":
                 case "serialized":
                 case "yaml":
                 case "list":
                 case "enum":
                 case "cnf":
                 case "conf":
                 case "config":
                 $this->sessions[$player->getName()] = "config";
                 $this->path[$player->getName()] = $this->path[$player->getName()] . "/" . $cmd[1];
                 $player->sendMessage(C::GREEN . "You have navigated to the config $cmd[1]");
                 break;
                 case "phar":
                 case "cmd":
                 case "bat":
                 case "zip":
                 $player->sendMessage(C::RED . "Error. You don't have the permission / you can't see file $cmd[1]");
                 break;
                 default:
                     $this->sessions[$player->getName()] = "file";
                     $this->path[$player->getName()] = $this->path[$player->getName()] . "/" . $cmd[1];
                     $player->sendMessage(C::GREEN . "You have navigated to the file $cmd[1]");
                 break;
                 }
                 }
         } else {
             $player->sendMessage(C::RED . "Error, file $cmd[1] not found");
         }
         break;
         
         
         case "help":
         default:
         $player->sendMessage(C::GOLD . "_____/" . C::GREEN ." Help for FileManager Directory mode " . C::GOLD . "\_____");
         $id = 0;
         foreach($this->cmddir as $cmd) {
             $player->sendMessage(C::GREEN . $this->cmddir[$id] . " : " . C::GOLD . $this->cmddirdesc[$id]);
             $id = $id + 1;
         }
         break;
     }
     break;
     
     
     case "config":
     switch($cmd[0]) {
         
         
         case "type":
         if(isset($cmd[1])) {
           switch($cmd [1]) {
             case "yaml":
             $this->type[$player->getName()] = "yaml";
             $player->sendMessage(C::GREEN ."You are now editing this file in YAML mode");
             break;
             case "propreties":
             $this->type[$player->getName()] = "propreties";
             $player->sendMessage(C::GREEN ."You are now editing this file in PROPRETIES mode");
             break;
             case "json":
             $this->type[$player->getName()][$player->getName()] = "json";
             $player->sendMessage(C::GREEN ."You are now editing this file in JSON mode");
             break;
             case "serialize":
             $this->type[$player->getName()] = "serialize";
             $player->sendMessage(C::GREEN ."You are now editing this file in SERIALIZE mode");
             break;
             case "enum":
             $this->type[$player->getName()] = "enum";
             $player->sendMessage(C::GREEN ."You are now editing this file in ENUM mode");
             break;
             case "cnf":
             $this->type[$player->getName()] = "cnf";
             $player->sendMessage(C::GREEN ."You are now editing this file in cnf mode");
             break;
           }
         }
         break;
         
         
         case "read":
         $contents = file_get_contents($serverpath . $this->path[$player->getName()]);
         $player->sendMessage(C::GREEN . "_______/ " . C::GOLD . "Contents of " . $this->path[$player->getName()] . C::GREEN . " \_______\n" . $contents);
         break;
         
         
         case "set":
         if(isset($cmd[2])){
            if(isset($this->type[$player->getName()])) {
             switch($this->type[$player->getName()])  {
                 case "yaml":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::YAML);
                 break;
                 case "propreties":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::PROPRETIES);
                 break;
                 case "json":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::JSON);
                 break;
                 case "serialize":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::SERIALIZED);
                 break;
                 case "enum":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::ENUM);
                 break;
                 case "cnf":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::CNF);
                 break;
             }
         } else {
             $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::DETECT);
         }
         if(strpos($cmd[2], ",")) {
             $array = [];
             foreach(explode(",", $cmd[2]) as $array_piece) {
                 array_push($array, $array_piece);
             }
         } else {
             $array = $cmd[2];
         }
         $cfg->set($cmd[1], $array);
         $cfg->save();
         }
         break;
         
         
         case "get":
         if(isset($cmd[1])){
            if(isset($this->type[$player->getName()])) {
             switch($this->type[$player->getName()])  {
                 case "yaml":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::YAML);
                 break;
                 case "propreties":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::PROPRETIES);
                 break;
                 case "json":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::JSON);
                 break;
                 case "serialize":
                 $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::SERIALIZED);
                 break;
             }
         } else {
             $cfg = new Config($serverpath . $this->path[$player->getName()], CONFIG::DETECT);
         }
         $result = $cfg->get($cmd[1]);
         if(is_array($result)) {
             $result = "[". implode(", ", $result) . "]";
         }
         $player->sendMessage(C::GREEN ."In this config, ". C::BLUE ."$cmd[1] " . C::GREEN . "= " . C::AQUA . "$result");
         }
         break;
         
         
         case "close":
         $this->sessions[$player->getName()] = "dir";
         $path = explode("/", $this->path[$player->getName()]);
         $c = count($path) - 1;
         unset($path[$c]);
         $this->path[$player->getName()] = implode("/", $path);
         $player->sendMessage(C::GREEN . "You closed the config. You are now on dir " . $this->path[$player->getName()] . ".");
         break; 
         
         
         case "help":
         default:
         $player->sendMessage(C::GOLD . "_____/" . C::GREEN ." Help for FileManager Config mode " . C::GOLD . "\_____");
         $id = 0;
         foreach($this->cmdfile as $cmd) {
             $player->sendMessage(C::GREEN . $this->cmdcfg[$id] . " : " . C::GOLD . $this->cmdcfgdesc[$id]);
             $id = $id + 1;
         }
         break;
     }
     break;
     case "file":
     switch($cmd[0]) {
         case "read":
         $contents = file_get_contents($serverpath . $this->path[$player->getName()]);
         $player->sendMessage(C::GREEN . "_______/ " . C::GOLD . "Contents of " . $this->path[$player->getName()] . C::GREEN . " \_______\n" . $contents);
         break;
         
         
         case "addtext":
         if(isset($cmd[1])){
             unset($cmd[0]);
             file_put_contents($serverpath . $this->path[$player->getName()], file_get_contents($serverpath . $this->path[$player->getName()]) . implode(" ", $cmd));
         } else {
             $player->sendMessage(C::RED . "Usage: > addtext <text>");
         }
         break;
         
         
         case 'rpltext':
         if(isset($cmd[1])){
             unset($cmd[0]);
             $cmd = explode("---", implode(" ", $cmd));
             $content = file_get_contents($serverpath . $this->path[$player->getName()]);
             if(isset($cmd[1])) {
             $content = str_ireplace($cmd[0], $cmd[1], $content);
             file_put_contents($serverpath . $this->path[$player->getName()], $content);
             } else {
                 $player->sendMessage(C::RED . "Usage: > rpltext <text to replace>---<replacement>");
             }
         } else {
             $player->sendMessage(C::RED . "Usage: > rpltext <text to replace>---<replacement>");
         }
         break;
         
         
         case "rmtext":
         if(isset($cmd[1])){
             unset($cmd[0]);
             $content = file_get_contents($serverpath . $this->path[$player->getName()]);
             $content = str_ireplace(implode(" ", $cmd), "", $content);
             file_put_contents($serverpath . $this->path[$player->getName()], $content);
         } else {
             $player->sendMessage(C::RED . "Usage: > rmtext <text to remove>");
         }
         break;
         
         
         case 'delfile':
         if($player->hasPermission("filemanager.delete-files")) {
             delete($serverpath . $this->path[$player->getName()]);
         } else {
             $player->sendMessage(C::RED . "Error. You don't have the permission to delete file $cmd[1]");
         }
         break;
         
         
         case "close":
         $this->sessions[$player->getName()] = "dir";
         $path = explode("/", $this->path[$player->getName()]);
         $c = count($path) - 1;
         unset($path[$c]);
         $this->path[$player->getName()] = implode("/", $path);
         $player->sendMessage(C::GREEN . "You closed the file. You are now on dir " . $this->path[$player->getName()] . ".");
         break;
         
         case "search":
         if(isset($cmd[1])) {
               $player->sendMessage(C::GREEN . "Found text " . implode(" ", $cmd) . substr_count(file_get_contents($serverpath . $this->path[$player->getName()]), implode(' ', $cmd)) . "times .");
         } else {
             $player->sendMessage(C::RED . "Usage: > search <text>");
         }
         break;
         case "help":
         default:
         $player->sendMessage(C::GOLD . "_____/" . C::GREEN ." Help for FileManager File mode " . C::GOLD . "\_____");
         $id = 0;
         foreach($this->cmdfile as $cmd) {
             $player->sendMessage(C::GREEN . $this->cmdfile[$id] . " : " . C::GOLD . $this->cmdfiledesc[$id]);
             $id = $id + 1;
         }
         break;
     }
     }
 }
}