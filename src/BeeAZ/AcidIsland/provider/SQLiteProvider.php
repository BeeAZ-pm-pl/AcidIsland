<?php

namespace BeeAZ\AcidIsland\provider;

use BeeAZ\AcidIsland\AcidIsland;
use SQLite3;

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
		$this->plugin->prepare = $this->db->prepare("SELECT * FROM top WHERE name = :name");
		$this->plugin->prepare->bindValue(":name", $name);
		$this->plugin->result = $this->plugin->prepare->execute();
		if ($this->plugin->result->fetchArray(SQLITE3_ASSOC) == false) {
			$this->plugin->prepare = $this->db->prepare("INSERT INTO top (name) VALUES (:name);");
			$this->plugin->prepare->bindValue(":name", $name);
			$this->plugin->result = $this->plugin->prepare->execute();
			$this->plugin->prepare->close();
		}
	}

	public function setValue($name, $value) {
		$this->plugin->prepare = $this->db->prepare("UPDATE top SET data = data + :data WHERE name = :name");
		$this->plugin->prepare->bindValue(":data", $value);
		$this->plugin->prepare->bindValue(":name", $name);
		$this->plugin->result = $this->plugin->prepare->execute();
		$this->plugin->prepare->close();
	}

	public function setDefaultValue($name) {
		$this->plugin->prepare = $this->db->prepare("UPDATE top SET data = :data WHERE name = :name");
		$this->plugin->prepare->bindValue(":data", 0);
		$this->plugin->prepare->bindValue(":name", $name);
		$this->plugin->result = $this->plugin->prepare->execute();
		$this->plugin->prepare->close();
	}

	public function sort($type) {
		$cfg = $this->plugin->getConfig()->getAll();
		$count = $cfg['TopCount'];
		$this->plugin->prepare = $this->db->prepare("SELECT name,$type FROM top ORDER BY $type DESC LIMIT $count");
		$this->plugin->result = $this->plugin->prepare->execute();
		$list = "";
		while ($element = $this->plugin->result->fetchArray(SQLITE3_ASSOC))
			$list .= str_replace(['{player}', '{value}'], [$element['name'], $element[$type]], $cfg['TopElement']) . "\n";
		return $list;
		$this->plugin->prepare->close();
	}
}
