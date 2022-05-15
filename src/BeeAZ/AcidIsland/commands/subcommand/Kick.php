<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;

class Kick{
 
 public function onCommand(CommandSender $player, array $args){
  if(!$player->hasPermission("acidisland.kick")){
  return true;
  }
  if(count($args) < 2){
  return true;
  }
  $server = Server::getInstance();
  $ai = AcidIsland::getInstance();
  $name = implode(" ", array_slice($args, 1));
  if($server->getPlayerExact($name) !== null){
  $p = $server->getPlayerExact($name);
  if($p->getWorld()->getDisplayName() == $player->getName()){
  $p->teleport($server->getWorldManager()->getDefaultWorld()->getSafeSpawn());
  $player->sendMessage($ai->cfg->get("ISLAND-KICK"));
  $p->sendMessage($ai->cfg->get("ISLAND-KICK2"));
  }else{
   $player->sendMessage($ai->cfg->get("ISLAND-KICKERROR"));
  }
  }else{
   $player->sendMessage($ai->cfg->get("PLAYER-NOTFOUND"));
  }
}
}
