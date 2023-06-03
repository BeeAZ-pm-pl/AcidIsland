<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\provider;

use BeeAZ\AcidIsland\AcidIsland;
use SQLite3;
use function file_exists;
use function str_replace;

class SQLiteProvider {

	public SQLite3 $db;

	public AcidIsland $plugin;

	public function __construct(AcidIsland $plugin) {
		$this->plugin = $plugin;
	}

	public function initDataBase() {
		if (!file_exists($this->plugin->getDataFolder() . 'top.db')) {
			$this->db = new \SQLite3($this->plugin->getDataFolder() . 'top.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
		} else {
			$this->db = new \SQLite3($this->plugin->getDataFolder() . 'top.db', SQLITE3_OPEN_READWRITE);
		}
		$this->createDB();
	}

	public function createDB() {
		$this->db->exec("CREATE TABLE IF NOT EXISTS top (name TEXT PRIMARY KEY NOT NULL, data INTEGER default 0 NOT NULL);");
	}

	public function createTopData($name) {
		$prepare = $this->db->prepare("SELECT * FROM top WHERE name = :name");
		$prepare->bindValue(":name", $name);
		$result = $prepare->execute();
		if ($result->fetchArray(SQLITE3_ASSOC) == false) {
		  $prepare->reset();
			$prepare = $this->db->prepare("INSERT INTO top (name) VALUES (:name);");
			$prepare->bindValue(":name", $name);
		}
			$prepare->reset();
	}

	public function setValue($name, $value) {
		$prepare = $this->db->prepare("UPDATE top SET data = data + :data WHERE name = :name");
		$prepare->bindValue(":data", $value);
		$prepare->bindValue(":name", $name);
		$prepare->reset();
	}

	public function setDefaultValue($name) {
		$prepare = $this->db->prepare("UPDATE top SET data = :data WHERE name = :name");
		$prepare->bindValue(":data", 0);
		$prepare->bindValue(":name", $name);
		$prepare->reset();
	}

	public function sort($type) {
		$cfg = $this->getConfig()->getAll();
		$count = $cfg['TopCount'];
		$prepare = $this->db->prepare("SELECT name,$type FROM top ORDER BY $type DESC LIMIT $count");
		$result = $prepare->execute();
		$list = "";
		while ($element = $result->fetchArray(SQLITE3_ASSOC)) {
			$list .= str_replace(['{player}', '{value}'], [$element['name'], $element[$type]], $cfg['TopElement']) . "\n";
		}
		return $list;
		$prepare->reset();
	}
}
