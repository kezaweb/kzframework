<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1362827382.
 * Generated on 2013-03-09 12:09:42 by yoann
 */
class PropelMigration_1362827382
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

CREATE TABLE bch_rul
(
    bch_id INTEGER NOT NULL,
    rul_id INTEGER NOT NULL,
    bcr_option TEXT,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (bch_id,rul_id),
    INDEX fk_bch_rul_rule1 (rul_id),
    INDEX fk_bch_rul_branch1 (bch_id),
    INDEX fk_bch_rul_user1 (created_by),
    INDEX fk_bch_rul_user2 (updated_by),
    CONSTRAINT fk_bch_rul_rule1
        FOREIGN KEY (rul_id)
        REFERENCES rule (id),
    CONSTRAINT fk_bch_rul_branch1
        FOREIGN KEY (bch_id)
        REFERENCES branch (id),
    CONSTRAINT fk_bch_rul_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_bch_rul_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE branch
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    bch_title VARCHAR(150),
    bch_active TINYINT(1),
    bch_published_at DATETIME,
    bch_level INTEGER,
    bch_url VARCHAR(90),
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_branch_user1 (created_by),
    INDEX fk_branch_user2 (updated_by),
    CONSTRAINT fk_branch_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_branch_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE credential
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    cre_name VARCHAR(45),
    cre_level INTEGER,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_credential_user1 (created_by),
    INDEX fk_credential_user2 (updated_by),
    CONSTRAINT fk_credential_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_credential_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE leaf
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    lef_title VARCHAR(150),
    lef_active TINYINT(1),
    lef_published_at DATETIME,
    lef_content LONGBLOB,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_leaf_user1 (created_by),
    INDEX fk_leaf_user2 (updated_by),
    CONSTRAINT fk_leaf_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_leaf_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE lef_rul
(
    lef_id INTEGER NOT NULL,
    rul_id INTEGER NOT NULL,
    ler_option TEXT,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (lef_id,rul_id),
    INDEX fk_lef_rul_rule1 (rul_id),
    INDEX fk_lef_rul_leaf1 (lef_id),
    INDEX fk_lef_rul_user1 (created_by),
    INDEX fk_lef_rul_user2 (updated_by),
    CONSTRAINT fk_lef_rul_rule1
        FOREIGN KEY (rul_id)
        REFERENCES rule (id),
    CONSTRAINT fk_lef_rul_leaf1
        FOREIGN KEY (lef_id)
        REFERENCES leaf (id),
    CONSTRAINT fk_lef_rul_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_lef_rul_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

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
    INDEX fk_node_tree_branch_parent (bch_parent),
    CONSTRAINT fk_node_tree_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_node_tree_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id),
    CONSTRAINT fk_node_tree_branch
        FOREIGN KEY (bch_id)
        REFERENCES branch (id),
    CONSTRAINT fk_node_tree_branch_parent
        FOREIGN KEY (bch_parent)
        REFERENCES branch (id),
    CONSTRAINT fk_node_tree_leaf1
        FOREIGN KEY (lef_id)
        REFERENCES leaf (id)
) ENGINE=InnoDB;

CREATE TABLE rul_option
(
    id INTEGER NOT NULL,
    rou_name VARCHAR(45),
    rou_desc VARCHAR(200),
    rou_default_value TEXT,
    rou_pattern TEXT,
    rul_id INTEGER,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_rul_option_rule1 (rul_id),
    INDEX fk_rul_option_user1 (created_by),
    INDEX fk_rul_option_user2 (updated_by),
    CONSTRAINT fk_rul_option_rule1
        FOREIGN KEY (rul_id)
        REFERENCES rule (id),
    CONSTRAINT fk_rul_option_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_rul_option_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE rule
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    rul_name VARCHAR(45),
    rul_desc VARCHAR(200),
    rul_actif TINYINT(1),
    tru_id INTEGER,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_rule_user1 (created_by),
    INDEX fk_rule_user2 (updated_by),
    INDEX fk_rule_type_rule1 (tru_id),
    CONSTRAINT fk_rule_type_rule1
        FOREIGN KEY (tru_id)
        REFERENCES type_rule (id),
    CONSTRAINT fk_rule_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_rule_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE type_rule
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    is_in_store TINYINT(1),
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_type_rule_user1 (created_by),
    INDEX fk_type_rule_user2 (updated_by),
    CONSTRAINT fk_type_rule_user1
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_type_rule_user2
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE type_rule_i18n
(
    id INTEGER NOT NULL,
    local VARCHAR(5) DEFAULT \'en_EN\' NOT NULL,
    tru_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_type_rule_i18n_type_rule1
        FOREIGN KEY (id)
        REFERENCES type_rule (id)
) ENGINE=InnoDB;

CREATE TABLE user
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    usr_first_name VARCHAR(70),
    usr_last_name VARCHAR(70),
    usr_login VARCHAR(70),
    usr_password VARCHAR(70),
    usr_cp INTEGER(5),
    usr_avatar VARCHAR(100),
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (id),
    INDEX fk_updated_by_user (updated_by),
    INDEX fk_created_by_user (created_by),
    CONSTRAINT fk_created_by_user
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_updated_by_user
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

CREATE TABLE usr_cre
(
    usr_id INTEGER NOT NULL,
    cre_id INTEGER NOT NULL,
    created_by INTEGER,
    created_at DATETIME,
    updated_by INTEGER,
    updated_at DATETIME,
    PRIMARY KEY (usr_id,cre_id),
    INDEX fk_usr_cre_user1 (usr_id),
    INDEX fk_usr_cre_credential1 (cre_id),
    INDEX fk_usr_cre_user2 (created_by),
    INDEX fk_usr_cre_user3 (updated_by),
    CONSTRAINT fk_usr_cre_user1
        FOREIGN KEY (usr_id)
        REFERENCES user (id),
    CONSTRAINT fk_usr_cre_credential1
        FOREIGN KEY (cre_id)
        REFERENCES credential (id),
    CONSTRAINT fk_usr_cre_user2
        FOREIGN KEY (created_by)
        REFERENCES user (id),
    CONSTRAINT fk_usr_cre_user3
        FOREIGN KEY (updated_by)
        REFERENCES user (id)
) ENGINE=InnoDB;

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

DROP TABLE IF EXISTS bch_rul;

DROP TABLE IF EXISTS branch;

DROP TABLE IF EXISTS credential;

DROP TABLE IF EXISTS leaf;

DROP TABLE IF EXISTS lef_rul;

DROP TABLE IF EXISTS node_tree;

DROP TABLE IF EXISTS rul_option;

DROP TABLE IF EXISTS rule;

DROP TABLE IF EXISTS type_rule;

DROP TABLE IF EXISTS type_rule_i18n;

DROP TABLE IF EXISTS user;

DROP TABLE IF EXISTS usr_cre;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}