<?php

namespace BeeAZ\AcidIsland\commands\subcommand;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use BeeAZ\AcidIsland\AcidIsland;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use function rmdir;
use function unlink;

class Delete {


	public function onCommand(CommandSender $player, array $args) {
		$name = strtolower($player->getName());
		$ai = AcidIsland::getInstance();
		if ($player->hasPermission("acidisland.delete")) {
			if (count($args) < 2) {
				if ($ai->isIsland($name)) {
					$this->removeIsland($name);
					$ai->getProvider()->setDefaultValue($name);
					$player->sendMessage($ai->cfg->get("ISLAND-DELETE"));
					return true;
				}
			} else {
				$a = strtolower(implode(" ", array_slice($args, 1)));
				if ($player->hasPermission("acidisland.delete.other")) {
					if ($ai->isIsland($a)) {
						$this->removeIsland($a);
						$ai->getProvider()->setDefaultValue($a);
						$player->sendMessage($ai->cfg->get("ISLAND-DELETE-OTHER"));
					} else {
						$player->sendMessage($ai->cfg->get("ISLAND-NOTFOUND"));
					}
					return true;
				}
				return true;
			}
		}
	}

	public function removeIsland($name) {
		if (Server::getInstance()->getWorldManager()->isWorldLoaded("ai-" . $name)) {
			$world = Server::getInstance()->getWorldManager()->getWorldByName("ai-" . $name);
			if (count($world->getPlayers()) > 0) {
				foreach ($world->getPlayers() as $players) {
					$players->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
				}
			}
			Server::getInstance()->getWorldManager()->unloadWorld($world);
		}
		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($worldPath = Server::getInstance()->getDataPath() . "/worlds/ai-$name", FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($files as $fileInfo) {
			if ($filePath = $fileInfo->getRealPath()) {
				if ($fileInfo->isFile()) {
					unlink($filePath);
				} else {
					rmdir($filePath);
				}
			}
		}
		rmdir($worldPath);
	}
}
