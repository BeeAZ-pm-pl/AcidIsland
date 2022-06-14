<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\commands\subcommand;

use BeeAZ\AcidIsland\AcidIsland;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\generator\GeneratorManager;
use pocketmine\world\Position;
use pocketmine\world\WorldCreationOptions;
use function mt_rand;
use function str_replace;
use function strtolower;

class Join {

	public function onCommand(CommandSender $player) {
		if (!$player->hasPermission("acidisland.join")) {
			return true;
		}
		$name = strtolower($player->getName());
		$ai = AcidIsland::getInstance();
		if ($ai->isIsland($name)) {
			Server::getInstance()->getWorldManager()->loadWorld("ai-" . $name);
			$player->teleport(new Position(7, 65, 5, Server::getInstance()->getWorldManager()->getWorldByName("ai-" . $name)));
			$player->sendMessage($ai->cfg->get("ISLAND-JOIN"));
		} else {
			$this->createIsland($player);
		}
	}
	public function createIsland(Player $player) {
		$name = strtolower($player->getName());
		$ai = AcidIsland::getInstance();
		$seed = mt_rand();
		$generator = GeneratorManager::getInstance()->getGenerator("basic");
		Server::getInstance()->getWorldManager()->generateWorld(name: "ai-$name", options: WorldCreationOptions::create()->setSeed($seed)->setGeneratorClass($generator->getGeneratorClass()));
		$ai->createData($player);
		$player->sendMessage(str_replace("{seed}", strval($seed), $ai->cfg->get("ISLAND-CREATE")));
	}
}
