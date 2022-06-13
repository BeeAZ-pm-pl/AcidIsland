<?php

namespace BeeAZ\AcidIsland;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\world\Position;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\data\bedrock\EffectIdMap;
use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\block\BlockLegacyIds;
use pocketmine\data\bedrock\EffectIds;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class EventListener implements Listener {

	public function onJoin(PlayerJoinEvent $ev) {
		$name = strtolower($ev->getPlayer()->getName());
		$provider = AcidIsland::getInstance()->getProvider();
		$provider->createTopData($name);
	}

	public function onMove(PlayerMoveEvent $ev) {
		$player = $ev->getPlayer();
		$world = $player->getWorld();
		$wn = $world->getDisplayName();
		$x = intval($player->getPosition()->getX());
		$y = intval($player->getPosition()->getY());
		$z = intval($player->getPosition()->getZ());
		$pos = new Position($x, $y + 1, $z, $world);
		$ex = explode("-", $wn);
		if ($ex[0] == "ai") {
			if ($world->getBlock($pos)->getId() === BlockLegacyIds::WATER) {
				$player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId(EffectIds::BLINDNESS), 200, 2, true));
				$player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId(EffectIds::POISON), 200, 2, true));
				$player->getEffects()->add(new EffectInstance(EffectIdMap::getInstance()->fromId(EffectIds::WITHER), 200, 2, true));
				AcidIsland::getInstance()->playSound($player, "random.orb", 1, 1);
				$player->sendTitle("§c§lWARNING");
			}
		}
	}

	public function onInteract(PlayerInteractEvent $ev) {
		$player = $ev->getPlayer();
		$world = $player->getWorld()->getDisplayName();
		$name = strtolower($player->getName());
		$ai = AcidIsland::getInstance();
		$ex = explode("-", $world);
		if (!Server::getInstance()->isOp($name)) {
			if ($ex[0] == "ai") {
				if ($ex[1] !== $name) {
					$friend = explode(",", $ai->getIsland($ex[1])->get("member"));
					if (!in_array($name, $friend)) {
						$player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to touch here");
						$ev->cancel();
					}
				}
			}
		}
	}
	public function onBreak(BlockBreakEvent $ev) {
		$player = $ev->getPlayer();
		$world = $player->getWorld()->getDisplayName();
		$name = strtolower($player->getName());
		$ai = AcidIsland::getInstance();
		$ex = explode("-", $world);
		if (!Server::getInstance()->isOp($name)) {
			if ($ex[0] == "ai") {
				if ($ex[1] !== $name) {
					$friend = explode(",", $ai->getIsland($ex[1])->get("member"));
					if (!in_array($name, $friend)) {
						$player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to break here");
						$ev->cancel();
					}
				}
			}
		}
	}

	public function onPlace(BlockPlaceEvent $ev) {
		$player = $ev->getPlayer();
		$world = $player->getWorld()->getDisplayName();
		$name = strtolower($player->getName());
		$ai = AcidIsland::getInstance();
		$ex = explode("-", $world);
		if (!Server::getInstance()->isOp($name)) {
			if ($ex[0] == "ai") {
				if ($ex[1] !== $name) {
					$friend = explode(",", $ai->getIsland($ex[1])->get("member"));
					if (!in_array($name, $friend)) {
						$player->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to place here");
						$ev->cancel();
					}
				}
			}
		}
		if ($ex[0] == "ai") {
			if ($ex[1] == $name) {
				$ai->getProvider()->setValue($name, 1);
			}
		}
	}
	public function onDamage(EntityDamageByEntityEvent $ev) {
		$entity = $ev->getEntity();
		$damager = $ev->getDamager();
		if ($entity instanceof Player && $damager instanceof Player) {
			$world = $entity->getWorld()->getDisplayName();
			$name = strtolower($damager->getName());
			$ai = AcidIsland::getInstance();
			$ex = explode("-", $world);
			if ($ex[0] == "ai") {
				if ($ex[1] !== $name) {
					if ($ai->getIsland($ex[1])->get("pvp") === false) {
						$damager->sendMessage("☞ §a§l[AcidIsland] §cYou do not have permission to pvp here");
						$ev->cancel();
					}
				}
			}
		}
	}
}
