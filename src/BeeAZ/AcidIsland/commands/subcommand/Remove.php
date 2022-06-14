<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\commands\subcommand;

use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\command\CommandSender;
use function array_slice;
use function count;
use function explode;
use function implode;
use function in_array;
use function str_replace;
use function strtolower;

class Remove {

	public function onCommand(CommandSender $player, array $args) {
		if (count($args) < 2) {
			return true;
		}
		if (!$player->hasPermission("acidisland.remove")) {
			return true;
		}
		$name = strtolower($player->getName());
		$data = strtolower(implode(" ", array_slice($args, 1)));
		$ai = AcidIsland::getInstance();
		if ($ai->isIsland($name)) {
			$ex = explode(",", $ai->getIsland($name)->get("member"));
			if (in_array($data, $ex, true)) {
				$im = implode(",", $ex);
				$replace = str_replace("," . $data, "", $im);
				if ($data !== $name) {
					$ai->setData($name, "member", $replace);
					$player->sendMessage($ai->cfg->get("ISLAND-REMOVEMEMBER"));
				} else {
					$player->sendMessage($ai->cfg->get("ISLAND-REMOVEERROR"));
				}
			} else {
				$player->sendMessage($ai->cfg->get("ISLAND-REMOVEERROR2"));
			}
		} else {
			$player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
		}
	}
}
