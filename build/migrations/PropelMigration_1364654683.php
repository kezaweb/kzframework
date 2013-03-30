<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1364654683.
 * Generated on 2013-03-30 15:44:43 by yoann
 */
class PropelMigration_1364654683
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

DROP TABLE IF EXISTS node_tree;

ALTER TABLE node
    ADD nod_type VARCHAR(45) AFTER nod_level,
    ADD nod_cloud INTEGER(1) AFTER nod_type,
    ADD nod_virtual INTEGER(1) AFTER nod_cloud,
    ADD bch_id INTEGER AFTER nod_virtual,
    ADD bch_parent INTEGER AFTER bch_id,
    ADD lef_id INTEGER AFTER bch_parent,
    ADD created_by INTEGER AFTER lef_id,
    ADD updated_by INTEGER AFTER created_by,
    ADD created_at DATETIME AFTER updated_by,
    ADD updated_at DATETIME AFTER created_at;

ALTER TABLE usr_cre DROP created_at;

ALTER TABLE usr_cre DROP updated_at;

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

ALTER TABLE node DROP nod_type;

ALTER TABLE node DROP nod_cloud;

ALTER TABLE node DROP nod_virtual;

ALTER TABLE node DROP bch_id;

ALTER TABLE node DROP bch_parent;

ALTER TABLE node DROP lef_id;

ALTER TABLE node DROP created_by;

ALTER TABLE node DROP updated_by;

ALTER TABLE node DROP created_at;

ALTER TABLE node DROP updated_at;

ALTER TABLE usr_cre
    ADD created_at DATETIME AFTER created_by,
    ADD updated_at DATETIME AFTER updated_by;

CREATE TABLE node_tree
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    ndt_id INTEGER,
    ndt_position INTEGER,
    ndt_left INTEGER,
    ndt_right INTEGER,
    ndt_level INTEGER,
    ndt_title VARCHAR(150),
    ndt_type VARCHAR(45),
    ndt_cloud TINYINT(1),
    ndt_virtual TINYINT(1),
    bch_id INTEGER,
    bch_parent INTEGER,
    lef_id INTEGER,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_node_tree_leaf1 (lef_id),
    INDEX fk_node_tree_user1 (created_by),
    INDEX fk_node_tree_user2 (updated_by),
    INDEX fk_node_tree_branch (bch_id),
    INDEX fk_node_tree_branch_parent (bch_parent)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}