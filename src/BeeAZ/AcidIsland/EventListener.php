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
  $e = [15, 19, 20];
 if(in_array($world->getBlock($pos)->getId(), $block)){
 foreach($e as $effect){
 $player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId($effect), 200, 2, true));
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
  $ex = explode("-", $world);
 if($ex[0] == "ai"){
 if($ex[1] !== $name){ #When playing in someone else's world 
 $friend = explode(",", $ai->acid->getNested("$ex[1].member"));
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
  $ex = explode("-", $world);
 if($ex[0] == "ai"){
 if($ex[1] !== $name){ #When playing in someone else's world 
 $friend = explode(",", $ai->acid->getNested("$ex[1].member"));
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
  $ex = explode("-", $world);
 if($ex[0] == "ai"){
 if($ex[1] !== $name){ #When playing in someone else's world 
 $friend = explode(",", $ai->acid->getNested("$ex[1].member"));
 if(!in_array(strtolower($name), $friend)){
 $player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to place here");
 $ev->cancel();
 }
 }
}
}

 public function onDamage(EntityDamageByEntityEvent $ev){
  $entity = $ev->getEntity();
  $damager = $ev->getDamager();
 if($entity instanceof Player && $damager instanceof Player){
  $world = $entity->getWorld()->getDisplayName();
  $name = $damager->getName();
  $ai = AcidIsland::getInstance();
 $ex = explode("-", $world);
 if($ex[0] == "ai"){
 if($ex[1] !== $name){ #When playing in someone else's world 
 if($ai->acid->getNested("$ex[1].pvp") === false){
 $damager->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to pvp here");
 $ev->cancel();
 }
}
}
}
}
}
