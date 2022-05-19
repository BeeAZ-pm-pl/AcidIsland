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
  $ar = strtolower(implode(" ", array_slice($args, 1)));
  $ai = AcidIsland::getInstance();
  $name = strtolower($player->getName());
  if($ai->isIsland($name)){
    switch($ar){
       case "pvp":
       $name = strtolower($player->getName());
       $ai->setData($name, "pvp", true);
       $player->sendMessage($ai->cfg->get("PVP"));
       break;
       case "nopvp":
       $name = strtolower($player->getName());
       $ai->setData($name, "pvp", false);
       $player->sendMessage($ai->cfg->get("NOPVP"));
       break;
       case "lock":
       $name = strtolower($player->getName());
       $ai->setData($name, "lock", true);
       $player->sendMessage($ai->cfg->get("LOCK"));
       break;
       case "unlock":
       $name = strtolower($player->getName());
       $ai->setData($name, "lock", false);
       $player->sendMessage($ai->cfg->get("UNLOCK"));
       break;
  }
 }else{
  $player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
 }
 }
}
