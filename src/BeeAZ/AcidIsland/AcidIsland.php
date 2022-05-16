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
use pocketmine\world\Position;
use pocketmine\world\World;
use BeeAZ\AcidIsland\commands\AICommand;

class AcidIsland extends PluginBase implements Listener{

 public $cfg;
 
 public $acid;
 
 private static AcidIsland $instance;

 public function onEnable(): void{
  $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
  GeneratorManager::getInstance()->addGenerator(basic::class, "basic", fn() => null, true);
  $this->saveDefaultConfig();
  $this->cfg = new Config($this->getDataFolder()."config.yml",Config::YAML);
  $this->acid = new Config($this->getDataFolder()."acid.yml",Config::YAML);
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
 $name = $player->getName();
 $this->acid->setNested("$name.member", strtolower($name));
 $this->acid->setNested("$name.pvp", false);
 $this->acid->setNested("$name.lock", false);
 $this->acid->save();
 foreach($this->cfg->get("start-item") as $start){
  $item = explode(":", $start);
   $player->getInventory()->addItem(ItemFactory::getInstance()->get((int)$item[0], (int)$item[1], (int)$item[2]));
}
}
 public function removeIslandData($name){
 $this->acid->remove($name);
 $this->acid->save();
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
}