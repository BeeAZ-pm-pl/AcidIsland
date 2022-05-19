<?php

namespace BeeAZ\AcidIsland;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\world\generator\GeneratorManager;
use BeeAZ\AcidIsland\generator\Basic\basic;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use BeeAZ\AcidIsland\EventListener;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;
use BeeAZ\AcidIsland\commands\AICommand;

class AcidIsland extends PluginBase implements Listener{

 public $cfg;
 
 private static AcidIsland $instance;

 public function onEnable(): void{
  $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
  GeneratorManager::getInstance()->addGenerator(basic::class, "basic", fn() => null, true);
  $this->saveDefaultConfig();
  $this->cfg = new Config($this->getDataFolder()."config.yml",Config::YAML);
  @mkdir($this->getDataFolder()."islands/");
  $this->getServer()->getCommandMap()->register($this->getDescription()->getName(), new AICommand($this));
  self::$instance = $this;
 }
 
 public static function getInstance(): AcidIsland{
  return self::$instance;
 }
 
 public function isIsland($name){
  return $this->getServer()->getWorldManager()->isWorldGenerated("ai-".$name);
 }
 
 public function createData(Player $player){
 $name = strtolower($player->getName());
 $this->setData($name, "member", $name);
 $this->setData($name, "lock", false);
 $this->setData($name, "pvp", false);
 foreach($this->cfg->get("start-item") as $start){
  $item = explode(":", $start);
   $player->getInventory()->addItem(ItemFactory::getInstance()->get((int)$item[0], (int)$item[1], (int)$item[2]));
}
}

 public function playSound($player, string $sound, float $volume = 0, float $pitch = 0): void{
    $packet = new PlaySoundPacket();
    $packet->soundName = $sound;
    $packet->x = $player->getPosition()->getX();
    $packet->y = $player->getPosition()->getY();
    $packet->z = $player->getPosition()->getZ();
    $packet->volume = $volume;
    $packet->pitch = $pitch;
    $player->getNetworkSession()->sendDataPacket($packet);
  }
  
 public function getIsland($name){
   $dir = $this->getDataFolder() . "/islands/" . substr($name, 0, 1) . "/";
    if (!is_dir($dir)) {
      mkdir($dir);
     }
    $cfg = new Config($dir . "$name.yml", Config::YAML);
    return $cfg;
    }
 public function setData($name, $key, $data){
   $dir = $this->getDataFolder() . "/islands/" . substr($name, 0, 1) . "/";
    if (!is_dir($dir)) {
      mkdir($dir);
     }
    $cfg = new Config($dir . "$name.yml", Config::YAML);
    $cfg->set($key, $data);
    $cfg->save();
    }
}
