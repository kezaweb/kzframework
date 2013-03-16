<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1363453530.
 * Generated on 2013-03-16 18:05:30 by yoann
 */
class PropelMigration_1363453530
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'kzf' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE branch
    ADD tpl_id INTEGER AFTER updated_at;

CREATE INDEX fk_branch_template1 ON branch (tpl_id);

CREATE TABLE template
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    tpl_name VARCHAR(100),
    tpl_desc TEXT,
    tpl_file VARCHAR(100),
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_template_user1 (created_by),
    INDEX fk_template_user2 (updated_by)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'kzf' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS template;

DROP INDEX fk_branch_template1 ON branch;

ALTER TABLE branch DROP tpl_id;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}