<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;

class Help {

	public function onCommand(CommandSender $player) {
		$player->sendMessage("§c==== §aAcidIsland Command §c====");
		$player->sendMessage("§a/ac join : §fTo Your Island");
		$player->sendMessage("§a/ac add <name> : §fAdd Friends Into the Island");
		$player->sendMessage("§a/ac tp <name> : §fTo Someone Else's Island");
		$player->sendMessage("§a/ac delete or /ac delete <name> (op) : §fClear the island");
		$player->sendMessage("§a/ac kick <name> : §f Kick Player Is In Your Island");
		$player->sendMessage("§a/ac remove <name> : §fRemove Player From Friend List");
		$player->sendMessage("§a/ac info <name> : §fView player's island information");
		$player->sendMessage("§a/ac setting <setting>: §fpvp, nopvp, lock, unlock");
		$player->sendMessage("§a/ac top : §f Top island");
		$player->sendMessage("§a/ac about : §f Plugin Information");
	}
}
