<?php
class DB {
	private static $instance;
	protected $sql;

	/**
	Usage: build the following file:
	class API extends DB {
		protected function performUpdates($current_version) {
			if ($current_version < 2) {
				$this->sql->query('whatever');
				$current_version = 2;
			}
		}

		public function exampleFn($x) {
			$stmt = $this->sql->prepare("INSERT INTO foo(bar) VALUES (?)");
			$stmt->bind_param("s", $x);
			$stmt->execute();
			$result = $stmt->insert_id;
			$stmt->close();
			return $result;
		}
	}
	*/

	private function get_config_value($name, $default = -1) {
		$stmt = $this->sql->prepare("SELECT value FROM config WHERE `name`= ?");
		if(!$stmt){
			return $default;
		}
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$stmt->bind_result($value);
		if ($stmt->fetch()) {
			$stmt->close();
			return $value;
		} else {
			$stmt->close();
			return $default;
		}
	}

	private function set_config_value($name, $value) {
		$stmt = $this->sql->prepare("SELECT count(*) FROM config WHERE `name` = ? LIMIT 1");
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$stmt->bind_result($found);
		$stmt->fetch();
		$stmt->close();

		if ($found == '1') {
			$stmt = $this->sql->prepare("UPDATE config SET `value` = ? WHERE `name` = ? LIMIT 1");
			if(!$stmt) die($this->sql->error);
			$stmt->bind_param("ss", $value, $name);
			$stmt->execute();
			$stmt->close();
		} else {
			$stmt = $this->sql->prepare("INSERT INTO config(`name`, `value`) VALUES(?, ?)");
			$stmt->bind_param("ss", $name, $value);
			$stmt->execute();
			$stmt->close();
		}
	}

	private function assertDatabase() {
		$old_version = $this->get_config_value("database_version");
		$current_version = $old_version;

		if ($current_version == -1) {
			// Create initial database
			$sqldata = file_get_contents('schema.sql', false);
			$this->sql->multi_query($sqldata);
			header("Location: index.php");
			die(_("Database updated")); // Automatischer Refresh folgt
		}

		$this->performUpdates($current_version);

		if ($current_version != $old_version) {
			$this->set_config_value("database_version", $current_version);
		}
	}

	protected function performUpdates(&$current_version) {
		// overload this and add your content like:
		/*
		if ($current_version < 2) {
			$this->sql->query('whatever');
			$current_version = 2;
		}
		*/
	}

	protected function __construct() {
		if (!file_exists('conf.php')) {
			die(_('Missing config. Please copy conf.php.dist to conf.php and edit it.'));
		}
		include 'conf.php';
		$this->sql = new mysqli($host, $username, $password, $database);
		$this->sql->report_mode = MYSQLI_REPORT_ALL;
		$this->assertDatabase();
	}

	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new static();
		}
		return self::$instance;
	}

	// derive from this class, implement performUpdates() and add new functions
	// that use $this->sql
	/**
	public function exampleFn($x) {
		$stmt = $this->sql->prepare("INSERT INTO foo(bar) VALUES (?)");
		$stmt->bind_param("s", $x);
		$stmt->execute();
		$result = $stmt->insert_id;
		$stmt->close();
		return $result;
	}
	*/
}
