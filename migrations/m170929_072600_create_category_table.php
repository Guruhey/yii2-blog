<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170929_072600_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()
        ]);
         //$this->addForeignKey('category_category_id', 'category', 'id', 'article', 'category_id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
