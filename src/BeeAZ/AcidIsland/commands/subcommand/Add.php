<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;

class Add{
  
 public function onCommand(CommandSender $player, array $args){
  if(count($args) < 2){
   return true;
  }
  if(!$player->hasPermission("acidisland.add")){
   return true;
  }
  $name1 = strtolower($player->getName());
  $name2 = strtolower(implode(" ", array_slice($args, 1)));
  $server = Server::getInstance();
  $ai = AcidIsland::getInstance();
  if($server->getPlayerExact($name2) !== null){
  if($ai->isIsland($name1)){
  $ex = explode(",", $ai->getIsland($name1)->get("member"));
  if(!in_array($name2, $ex)){
  $im = implode(",", $ex);
  $add = "$im,".$name2;
  $ai->setData($name1, "member", $add);
  $player->sendMessage($ai->cfg->get("ISLAND-ADD"));
  }else{
   $player->sendMessage($ai->cfg->get("ISLAND-ADDERROR"));
   }
  }else{
  $player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
  }
  }else{
   $player->sendMessage($ai->cfg->get("PLAYER-NOTFOUND"));
  }
  return true;
  }
}
