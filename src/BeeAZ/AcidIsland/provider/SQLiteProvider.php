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
	
	public mixed $prepare;
	
	public mixed $result;

	public function __construct(AcidIsland $plugin) {
		$this->plugin = $plugin;
	}

	public function initDataBase() {
		if (!file_exists($this->getDataFolder() . 'top.db')) {
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
		$this->prepare = $this->db->prepare("SELECT * FROM top WHERE name = :name");
		$this->prepare->bindValue(":name", $name);
		$this->result = $this->prepare->execute();
		if ($this->result->fetchArray(SQLITE3_ASSOC) == false) {
			$this->prepare = $this->db->prepare("INSERT INTO top (name) VALUES (:name);");
			$this->prepare->bindValue(":name", $name);
			$this->result = $this->prepare->execute();
			$this->prepare->close();
		}
	}

	public function setValue($name, $value) {
		$this->prepare = $this->db->prepare("UPDATE top SET data = data + :data WHERE name = :name");
		$this->prepare->bindValue(":data", $value);
		$this->prepare->bindValue(":name", $name);
		$this->result = $this->prepare->execute();
		$this->prepare->close();
	}

	public function setDefaultValue($name) {
		$this->prepare = $this->db->prepare("UPDATE top SET data = :data WHERE name = :name");
		$this->prepare->bindValue(":data", 0);
		$this->prepare->bindValue(":name", $name);
		$this->result = $this->prepare->execute();
		$this->prepare->close();
	}

	public function sort($type) {
		$cfg = $this->getConfig()->getAll();
		$count = $cfg['TopCount'];
		$this->prepare = $this->db->prepare("SELECT name,$type FROM top ORDER BY $type DESC LIMIT $count");
		$this->result = $this->prepare->execute();
		$list = "";
		while ($element = $this->result->fetchArray(SQLITE3_ASSOC)) {
			$list .= str_replace(['{player}', '{value}'], [$element['name'], $element[$type]], $cfg['TopElement']) . "\n";
		}
		return $list;
		$this->prepare->close();
	}
}
