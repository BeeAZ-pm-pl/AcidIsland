<?php

namespace BeeAZ\AcidIsland;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\world\Position;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\data\bedrock\EffectIdMap;
use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class EventListener implements Listener{

 public function onMove(PlayerMoveEvent $ev){
  if($ev->isCancelled()) return;
  $player = $ev->getPlayer();
  $world = $player->getWorld();
  $x = $player->getPosition()->getX();
  $y = $player->getPosition()->getY();
  $z = $player->getPosition()->getZ();
  $pos = new Position($x, $y + 1, $z, $world);
  $block = [8,9];
  $effect = [19, 20, 15];
 if(in_array($world->getBlock($pos)->getId(), $block)){
 foreach($effect as $e){
 $player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId($e), 40, 1, true));
 AcidIsland::getInstance()->playSound($player, "random.orb", 1, 1);
 $player->sendTitle("§c§lWARNING");
 }
}
}

 public function onInteract(PlayerInteractEvent $ev){
 if(Server::getInstance()->isOp($ev->getPlayer()->getName())) return;
  $player = $ev->getPlayer();
  $world = $player->getWorld()->getDisplayName();
  $name = $player->getName();
  $ai = AcidIsland::getInstance();
 if($ai->isAcidIsland($player->getWorld()) && $world !== Server::getInstance()->getWorldManager()->getDefaultWorld()->getDisplayName()){
 if($world !== $name){
 $friend = explode(",", $ai->acid->getNested("$world.member"));
 if(!in_array(strtolower($name), $friend)){
 $player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to touch here");
 $ev->cancel();
 }
 }
}
}
 public function onBreak(BlockBreakEvent $ev){
 if(Server::getInstance()->isOp($ev->getPlayer()->getName())) return;
  $player = $ev->getPlayer();
  $world = $player->getWorld()->getDisplayName();
  $name = $player->getName();
  $ai = AcidIsland::getInstance();
 if($ai->isAcidIsland($player->getWorld()) && $world !== Server::getInstance()->getWorldManager()->getDefaultWorld()->getDisplayName()){
 if($world !== $name){
 $friend = explode(",", $ai->acid->getNested("$world.member"));
 if(!in_array(strtolower($name), $friend)){
 $player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to break here");
 $ev->cancel();
 }
 }
}
}
 public function onPlace(BlockPlaceEvent $ev){
 if(Server::getInstance()->isOp($ev->getPlayer()->getName())) return;
  $player = $ev->getPlayer();
  $world = $player->getWorld()->getDisplayName();
  $name = $player->getName();
  $ai = AcidIsland::getInstance();
 if($ai->isAcidIsland($player->getWorld()) && $world !== Server::getInstance()->getWorldManager()->getDefaultWorld()->getDisplayName()){
 if($world !== $name){
 $friend = explode(",", $ai->acid->getNested("$world.member"));
 if(!in_array(strtolower($name), $friend)){
 $player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to touch here");
 $ev->cancel();
 }
 }
}
}

 public function onDamage(EntityDamageByEntityEvent $ev){
  $entity = $ev->getEntity();
 if($entity instanceof Player){
  $world = $entity->getWorld()->getDisplayName();
  $ai = AcidIsland::getInstance();
 if($ai->isAcidIsland($entity->getWorld()) && $world !== Server::getInstance()->getWorldManager()->getDefaultWorld()->getDisplayName()){
 if($ai->acid->getNested("$world.pvp") == false){
 $entity->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to touch here");
 $ev->cancel();
 }
}
}
}
}
