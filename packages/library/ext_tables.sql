CREATE TABLE tx_library_domain_model_book (
	title varchar(255) NOT NULL DEFAULT '',
	description varchar(255) NOT NULL DEFAULT '',
	cover int(11) unsigned NOT NULL DEFAULT '0',
	author int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_library_domain_model_author (
	name varchar(255) NOT NULL DEFAULT '',
	surname varchar(255) NOT NULL DEFAULT '',
	photo int(11) unsigned NOT NULL DEFAULT '0'
);
