<?php
namespace frontend\models;

use Yii;
use yii\base\Model;


/**
 * Post
 */
class Post extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function findAll() {
        $connection = Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM post');
        $posts = $command->queryAll();

        if ($posts === false) {
            Yii::error("Post findall failed:");
        }

        return $posts;
    }
}
