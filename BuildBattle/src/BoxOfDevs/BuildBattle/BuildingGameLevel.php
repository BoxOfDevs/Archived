<?php
namespace BoxOfDevs\BuildBattle ; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
 use pocketmine\Player;
 use pocketmine\math\Vector3;
use pocketmine\level\Level;

use BoxOfDevs\BuildBattle\Utils;

class BuildingGameLevel extends Level {
    private $main;
    private $levelname;
    private $levelpath;
    private $level;
    private $cfg;
    public function __construct(Plugin $main, string $levelname, string $levelpath = Server::getWorldPath() . $levelname) {
        parent::__construct(Server::getInstance(), $levelname, $levelpath, LevelProviderManager::getProviderByName($providerName = "mcregion"))
        $this->main = $main;
        $this->levelname = $main;
        $this->level = Server::getLevelByName($levelname);
        $this->levelpath = $levelpath;
        $this->cfg = new Config($this->main->getDataFolder() . "levels/" . $levelname, Config::YAML);
        $this->plots = $this->cfg->get("Spawns");
        $this->lobby = $this->cfg->get("Lobby");
    }
    public function getLevel() {
        return $this->level;
    }
    public function getLevelName() {
        return $this->levelname;
    }
    public function getLevelPath() {
        return $this->levelpath;
    }
    public function getPlayers() {
        return $this->getPlayers();
    }
    public function getLobby() {
        return Utils::posFromString($this->lobby);
    }
    public function getSpawns() {
        $spawns = [];
        foreach($this->plots as $spawn) {
            array_push($spawns, Utils::plotFromString($spawn));
        } 
        return $spawns;
    }
    public function getMaxPlayers() {
        return $this->cfg->get("MaxPlayers");
    }
    public function getThemes() {
        return $this->cfg->get("Themes");
    }
    public function setLobby(Vector3 $pos) {
        $this->lobby = Utils::posToString($pos);
    } 
    public function addPlot(Vector3 $pos1, Vector3 $pos2) {
        array_push($this->spawns, Utils::plotToString($pos1, $pos2));
    }
    public function removePlot($plotid) {
        unset($this->spawns[$plotid - 1]);
    }
    public function teleportToPlot(Player $player, int $plotid) {
        $player->teleport($this->getPlotSpawn($plotid));
    }
    public function getPlotSpawn(int $plotid) {
        $plot = Utils::plotFromString($this->plots[$plotid]);
        $pos1 = $plot->getPos1();
        $pos2 = $plot->getPos2();
        $spawnX = $pos1->x * $pos2->x / 2;
        $spawnY = $pos1->y * $pos2->y / 2;
        $spawnZ = $pos1->z * $pos2->z / 2;
        if($this->level->getBlock(new Vector3($spawnX, $spawnY, $spawnZ))->getId() === 0) {
            return new Vector3($spawnX, $spawnY, $spawnZ);
        } else {
            for($x = $pos1->x; $x <= $pos2->x; $x++) {
                for($z = $pos1->z; $z <= $pos2->x; $z++) {
                    for($y = $pos1->y; $y <= $pos2->y; $y++) {
                        if($this->level->getBlock(new Vector3($X, $Y, $Z))->getId() === 0 and $this->level->getBlock(new Vector3($X, $Y + 1, $Z))->getId() === 0) {
                            return new Vector3($X, $Y, $Z);
                        }
                    }
                }
            }
        }
    }
}