<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;

class Info{
  
 
 public function onCommand(CommandSender $player, array $args){
 if(!$player->hasPermission("acidisland.info")){
  return true;
 }
 if(count($args) < 2){
  return true;
 }
 $name = implode(" ", array_slice($args, 1));
 $ai = AcidIsland::getInstance();
 if($ai->isIsland($name)){
   $member = $ai->acid->getNested("$name.member");
   $pvp = $this->getPVP($name);
   $lock = $this->getLock($name);
   $player->sendMessage(str_replace(["{member}", "{pvp}", "{lock}"], [$member, $pvp, $lock], $ai->cfg->get("ISLAND-INFO")));
 }else{
   $player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
  }
}

 public function getPVP($name){
 $ai = AcidIsland::getInstance();
 $pvp = $ai->acid->getNested("$name.pvp");
 if($pvp === true){
  return "on";
 }
 if($pvp === false){
  return "off";
 }
 }
 
 public function getLock($name){
  $ai = AcidIsland::getInstance();
  $lock = $ai->acid->getNested("$name.lock");
 if($lock === true){
  return "on";
 }
 if($lock === false){
  return "off";
 }
 }
 }
