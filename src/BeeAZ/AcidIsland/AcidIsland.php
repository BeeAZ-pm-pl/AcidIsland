<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland;

use BeeAZ\AcidIsland\commands\AICommand;
use BeeAZ\AcidIsland\generator\Basic\Basic;
use BeeAZ\AcidIsland\commands\subcommand\join;
use pocketmine\event\Listener;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\world\generator\GeneratorManager;
use function explode;
use function is_dir;
use function mkdir;
use function rename;
use function strtolower;
use function substr;

class AcidIsland extends PluginBase implements Listener {

	public $cfg;

	private static AcidIsland $instance;

	public function onEnable() : void {
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		GeneratorManager::getInstance()->addGenerator(Basic::class, "basic", fn () => null, true);
		$this->saveDefaultConfig();
		$this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		@mkdir($this->getDataFolder() . "islands/");
		$this->getServer()->getCommandMap()->register($this->getDescription()->getName(), new AICommand($this));
		$this->checkConfig();
	}

	public static function getInstance() : AcidIsland {
		return self::$instance;
	}

	public function checkConfig() {
		if ($this->cfg->get("config-version", false) !== 1) {
			$this->getLogger()->notice("Your configuration file is outdated, updating the config.yml...");
			$this->getLogger()->notice("The old configuration file can be found at config_old.yml");
			rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
			$this->saveDefaultConfig();
			$this->getConfig()->reload();
		}
	}

	public function isIsland($name) {
		return $this->getServer()->getWorldManager()->isWorldGenerated("ai-" . $name);
	}


	public function createData(Player $player) {
		$name = strtolower($player->getName());
		$this->setData($name, "member", $name);
		$this->setData($name, "lock", false);
		$this->setData($name, "pvp", false);
		Server::getInstance()->getWorldManager()->loadWorld("ai-" . $name);
		$player->teleport(new Position(7, 65, 5, Server::getInstance()->getWorldManager()->getWorldByName("ai-" . $name)));
		$player->sendMessage($ai->cfg->get("ISLAND-JOIN"));
		foreach ($this->cfg->get("start-item") as $start) {
			$item = explode(":", $start);
			$player->getInventory()->addItem(LegacyStringToItemParser::getInstance()->parse((int) $item[0].':'.(int) $item[1])->setCount((int) $item[2]));
		}
	}

	public function playSound($player, string $sound, float $volume = 0, float $pitch = 0) : void {
		$packet = new PlaySoundPacket();
		$packet->soundName = $sound;
		$packet->x = $player->getPosition()->getX();
		$packet->y = $player->getPosition()->getY();
		$packet->z = $player->getPosition()->getZ();
		$packet->volume = $volume;
		$packet->pitch = $pitch;
		$player->getNetworkSession()->sendDataPacket($packet);
	}

	public function getIsland($name) {
		$dir = $this->getDataFolder() . "/islands/" . substr($name, 0, 1) . "/";
		if (!is_dir($dir)) {
			mkdir($dir);
		}
		$cfg = new Config($dir . "$name.yml", Config::YAML);
		return $cfg;
	}

	public function setData($name, $key, $data) {
		$dir = $this->getDataFolder() . "/islands/" . substr($name, 0, 1) . "/";
		if (!is_dir($dir)) {
			mkdir($dir);
		}
		$cfg = new Config($dir . "$name.yml", Config::YAML);
		$cfg->set($key, $data);
		$cfg->save();
	}
}
