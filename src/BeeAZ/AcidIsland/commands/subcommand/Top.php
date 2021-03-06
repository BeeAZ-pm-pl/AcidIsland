<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\commands\subcommand;

use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\command\CommandSender;

class Top {

	public function onCommand(CommandSender $player) {
		$player->sendMessage("§c=====§eTop Island§c=====");
		$player->sendMessage(AcidIsland::getInstance()->getProvider()->sort('data'));
	}
}
