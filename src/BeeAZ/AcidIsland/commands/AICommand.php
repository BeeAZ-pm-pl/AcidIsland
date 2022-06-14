<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\commands;

use BeeAZ\AcidIsland\AcidIsland;
use BeeAZ\AcidIsland\commands\subcommand\About;
use BeeAZ\AcidIsland\commands\subcommand\Add;
use BeeAZ\AcidIsland\commands\subcommand\Delete;
use BeeAZ\AcidIsland\commands\subcommand\Help;
use BeeAZ\AcidIsland\commands\subcommand\Info;
use BeeAZ\AcidIsland\commands\subcommand\Join;
use BeeAZ\AcidIsland\commands\subcommand\Kick;
use BeeAZ\AcidIsland\commands\subcommand\Remove;
use BeeAZ\AcidIsland\commands\subcommand\Setting;
use BeeAZ\AcidIsland\commands\subcommand\Teleport;
use BeeAZ\AcidIsland\commands\subcommand\Top;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;

class AICommand extends Command implements PluginOwned {

	public $plugin;

	private $join;

	private $help;

	private $add;

	private $remove;

	private $teleport;

	private $setting;

	private $info;

	private $kick;

	private $delete;

	private $about;

	private $top;

	public function __construct() {
		parent::__construct("acidisland", "AcidIsland Command", null, ["ai", "ac"]);
		$this->join = new Join();
		$this->help = new Help();
		$this->add = new Add();
		$this->remove = new Remove();
		$this->teleport = new Teleport();
		$this->setting = new Setting();
		$this->info = new Info();
		$this->kick = new Kick();
		$this->delete = new Delete();
		$this->about = new About();
		$this->top = new Top();
	}

	public function execute(CommandSender $player, string $label, array $args) {
		if ($args) {
			switch ($args[0]) {
				case "join":
				case "create":
				case "go":
					return $this->join->onCommand($player);
					break;
				case "help":
					return $this->help->onCommand($player);
					break;
				case "add":
					return $this->add->onCommand($player, $args);
					break;
				case "remove":
					return $this->remove->onCommand($player, $args);
					break;
				case "teleport":
				case "tp":
					return $this->teleport->onCommand($player, $args);
					break;
				case "setting":
					return $this->setting->onCommand($player, $args);
					break;
				case "kick":
					return $this->kick->onCommand($player, $args);
					break;
				case "info":
					return $this->info->onCommand($player, $args);
					break;
				case "delete":
					return $this->delete->onCommand($player, $args);
					break;
				case "about":
					return $this->about->onCommand($player);
					break;
				case "top":
					return $this->top->onCommand($player);
					break;
			}
		} else {
			$this->help->onCommand($player);
		}
	}
	public function getOwningPlugin() : AcidIsland {
		return $this->plugin;
	}
}
