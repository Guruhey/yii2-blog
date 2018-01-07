<?php

use yii\db\Migration;

class m171206_143021_add_date_to_comment extends Migration
{
    public function up()
    {
        $this->addColumn('comment','date', $this->date());
    }

    public function down()
    {
        $this->dropColum('comment','date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_143021_add_date_to_comment cannot be reverted.\n";

        return false;
    }
    */
}
