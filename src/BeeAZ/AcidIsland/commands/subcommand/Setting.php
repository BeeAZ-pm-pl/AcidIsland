<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;

class Setting{
  
 
 public function onCommand(CommandSender $player, array $args){
  if(!$player->hasPermission("acidisland.setting")){
   return true;
  }
  if(count($args) < 2){
   return true;
  }
  $ar = implode(" ", array_slice($args, 1));
  $ai = AcidIsland::getInstance();
  $name = $player->getName();
  if($ai->isIsland($name)){
    switch($ar){
       case "pvp":
       $name = $player->getName();
       $ai->acid->setNested("$name.pvp", true);
       $ai->acid->save();
       $player->sendMessage($ai->cfg->get("PVP"));
       break;
       case "nopvp":
       $name = $player->getName();
       $ai->acid->setNested("$name.pvp", false);
       $ai->acid->save();
       $player->sendMessage($ai->cfg->get("NOPVP"));
       break;
       case "lock":
       $name = $player->getName();
       $ai->acid->setNested("$name.lock", true);
       $ai->acid->save();
       $player->sendMessage($ai->cfg->get("LOCK"));
       break;
       case "unlock":
       $name = $player->getName();
       $ai->acid->setNested("$name.lock", false);
       $ai->acid->save();
       $player->sendMessage($ai->cfg->get("UNLOCK"));
       break;
  }
 }else{
  $player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
 }
 }
}
