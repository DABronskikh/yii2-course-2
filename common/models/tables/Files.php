<?php

namespace common\models\tables;

use common\models\Users;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $task_id
 * @property int $creator_id
 * @property string $filename
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UploadedFile $file
 *
 * @property Users $creator
 * @property Tasks $task
 */
class Files extends \yii\db\ActiveRecord
{
    public $timeKey;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'creator_id'/*, 'file', 'filename'*//*, 'created_at', 'updated_at'*/], 'required'],
            [['task_id', 'creator_id'], 'integer'],
            [['created_at', 'updated_at', 'filename'], 'safe'],
            [['file', 'filename'], 'file', 'extensions' => 'jpg, png'],
            //[['file', 'filename'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
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
            'task_id' => 'Task ID',
            'creator_id' => 'Creator ID',
            'file' => 'File',
            'filename' => 'Filename',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    public function getFileName(){
        return $this->file->getBaseName().'.'.$this->file->getExtension();
    }

    public function getNewFileName(){
        if (!$this->timeKey){
           $this->timeKey = $this->task_id.'-'.$this->creator_id.'-'.mktime().'.'.$this->file->getExtension();
        }
        return $this->timeKey;
    }

    public function saveFile(){
        if ($this->validate()){
            $file = $this->getNewFileName();
            $filePath=Yii::getAlias("@frontend/web/files/img/{$file}");
            $this->file->saveAs($filePath);

            Image::thumbnail($filePath, 150, 100)
                ->save(Yii::getAlias("@frontend/web/files/img-min/{$file}"));
        }
    }
}
