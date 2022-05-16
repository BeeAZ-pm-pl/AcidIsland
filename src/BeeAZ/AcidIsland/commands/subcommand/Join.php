<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\Server;
use pocketmine\player\Player;
use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\command\CommandSender;
use pocketmine\world\WorldManager;
use pocketmine\world\World;
use pocketmine\world\generator\GeneratorManager;
use pocketmine\world\WorldCreationOptions;
use pocketmine\world\Position;

class Join{
  
  public function onCommand(CommandSender $player){
  if(!$player->hasPermission("acidisland.join")){
  return true;
  }
  $name = $player->getName();
  $ai = AcidIsland::getInstance();
  if($ai->isIsland($name)){
   Server::getInstance()->getWorldManager()->loadWorld("ai-".$name);
   $player->teleport(new Position(7, 65, 5, Server::getInstance()->getWorldManager()->getWorldByName("ai-".$name)));
   $player->sendMessage($ai->cfg->get("ISLAND-JOIN"));
  }else{
   $this->createIsland($player);
  }
  }
  public function createIsland(Player $player){
  $name = $player->getName();
  $ai = AcidIsland::getInstance();
  $seed = mt_rand();
  $generator = GeneratorManager::getInstance()->getGenerator("basic");
  Server::getInstance()->getWorldManager()->generateWorld(name: "ai-$name", options: WorldCreationOptions::create()->setSeed($seed)->setGeneratorClass($generator->getGeneratorClass()));
  $ai->createData($player);
  $player->sendMessage(str_replace("{seed}", $seed, $ai->cfg->get("ISLAND-CREATE")));
}
}
