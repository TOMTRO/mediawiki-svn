ALTER TABLE `uw_expression_ns` 
	ADD INDEX `versioned_expression` (`remove_transaction_id`, `expression_id`, `language_id`),
	ADD INDEX `versioned_language` (`remove_transaction_id`, `language_id`, `expression_id`),
	ADD INDEX `versioned_spelling` (`remove_transaction_id`, `spelling` (255), `expression_id`, `language_id`);
	
--	ADD INDEX `unversioned_spelling` (`spelling` (255), `expression_id`, `language_id`),
--	ADD INDEX `unversioned_expression` (`expression_id`, `language_id`),
--	ADD INDEX `unversioned_language` (`language_id`, `expression_id`);
	