<?php

namespace common\models\tables;

use common\models\Users;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $discription
 * @property int $creator_id
 * @property int $responsible_id
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deadline
 *
 * @property Comment[] $comments
 * @property FileImage[] $fileImages
 * @property Users $creator
 * @property Users $responsible
 * @property TaskStatuses $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'discription', 'creator_id', 'responsible_id', 'status_id', /*'created_at', 'updated_at',*/ 'deadline'], 'required'],
            [['creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['created_at', 'updated_at', 'deadline'], 'safe'],
            [['name', 'discription'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['responsible_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatuses::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'discription' => 'Описание',
            'creator_id' => 'Создатель',
            'responsible_id' => 'Исполнитель',
            'status_id' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deadline' => 'Срок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileImages()
    {
        return $this->hasMany(FileImage::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Users::className(), ['id' => 'responsible_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::className(), ['id' => 'status_id']);
    }

    //api
    public function extraFields(){
        return ['creator', 'responsible', 'status', 'comments'];
    }
}
