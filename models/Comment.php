<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 0;
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }
    public function getArticle()
    {
        return $this->hasOne(Article::className(),['id' =>'article_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' =>'user_id']);
    }
    public function getDate()
    {
        Yii::$app->formatter->locale = 'ru-RU';
        echo Yii::$app->formatter->asDate($this->date);
    }
    public function isAllowed()
    {
        return $this->status;
    }
    public function allow()
    {
        $this->status = SELF::STATUS_ALLOW;
        return $this->save(false);
    }
    public function disallow()
    {
        $this->status = SELF::STATUS_DISALLOW;
        return $this->save(false);
    }

}
