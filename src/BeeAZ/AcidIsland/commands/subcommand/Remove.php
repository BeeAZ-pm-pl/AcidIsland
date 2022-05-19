<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;

class Remove{
  
 public function onCommand(CommandSender $player, array $args){
  if(count($args) < 2){
   return true;
  }
  if(!$player->hasPermission("acidisland.remove")){
   return true;
  }
  $name1 = strtolower($player->getName());
  $name2 = strtolower(implode(" ", array_slice($args, 1)));
  $ai = AcidIsland::getInstance();
  if($ai->isIsland($name1)){
  $ex = explode(",", $ai->getIsland($name1)->get("member"));
  if(in_array($name2, $ex)){
  $im = implode(",", $ex);
  $replace = str_replace(",".$name2, "", $im);
  if($name2 !== $name1){
  $ai->setData($name1, "member", $replace);
  $player->sendMessage($ai->cfg->get("ISLAND-REMOVEMEMBER"));
  }else{
   $player->sendMessage($ai->cfg->get("ISLAND-REMOVEERROR"));
  }
  }else{
   $player->sendMessage($ai->cfg->get("ISLAND-REMOVEERROR2"));
   }
  }else{
  $player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
  }
}
}
