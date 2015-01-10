CREATE TABLE IF NOT EXISTS `config` (
		`name` varchar(64) NOT NULL,
		`value` varchar(64) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`name`, `value`) VALUES
('database_version', 1);

