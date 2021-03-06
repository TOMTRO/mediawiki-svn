-- This script generates associations between a general foreign property table
-- as generated by loadForeignProperties and WikiWord, by matching the value
-- of a (name/synonym) property against WikiWord's maaning table, that is, against known
-- terms refering to concepts.
--
-- Parameters:
--  * wikiword_prefix: the global table prefix. Provided automatically
--  * foreign_properties_table: the table containing the foreign entities/properties
--  * foreign_authority_name: name of the foreign authority (scope if the foreign proeprty name)
--  * foreign_property_name: name of the (name/synonym) property in the foreign property table.

SELECT foreign_authority, foreign_id, 
	concept, concept_name, 
	F.property as foreign_property, "_TERM_" as concept_property,
	M.term_text, M.rule,	M.freq, M.rule * M.freq as weight
FROM /* wikiword_prefix *//* foreign_properties_table */ as F
JOIN /* wikiword_prefix */meaning as M
ON F.value = M.term_text
AND F.foreign_authority = "/* foreign_authority_name */"
AND F.property = "/* foreign_property_name */"
GROUP BY foreign_authority, foreign_id, concept, F.value;