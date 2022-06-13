<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\commands\subcommand;

use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\command\CommandSender;
use function array_slice;
use function count;
use function implode;
use function str_replace;
use function strtolower;

class Info {

	public function onCommand(CommandSender $player, array $args) {
		if (!$player->hasPermission("acidisland.info")) {
			return true;
		}
		if (count($args) < 2) {
			return true;
		}
		$name = strtolower(implode(" ", array_slice($args, 1)));
		$ai = AcidIsland::getInstance();
		if ($ai->isIsland($name)) {
			$member = $ai->getIsland($name)->get("member");
			$pvp = $this->getPVP($name);
			$lock = $this->getLock($name);
			$player->sendMessage(str_replace(["{member}", "{pvp}", "{lock}"], [$member, $pvp, $lock], $ai->cfg->get("ISLAND-INFO")));
		} else {
			$player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
		}
	}

	public function getPVP($name) {
		$ai = AcidIsland::getInstance();
		$pvp = $ai->getIsland($name)->get("pvp");
		if ($pvp === true) {
			return "on";
		}
		if ($pvp === false) {
			return "off";
		}
	}

	public function getLock($name) {
		$ai = AcidIsland::getInstance();
		$lock = $ai->getIsland($name)->get("lock");
		if ($lock === true) {
			return "on";
		}
		if ($lock === false) {
			return "off";
		}
	}
}
