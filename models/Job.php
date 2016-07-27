<?php

namespace app\modules\job\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $responsibilities
 * @property integer $workspace_id
 *
 * @property Workspace $workspace
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['responsibilities'], 'string'],
            [['workspace_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 6],
            [['workspace_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workspace::className(), 'targetAttribute' => ['workspace_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('job', 'ID'),
            'title' => Yii::t('job', 'Title'),
            'image' => Yii::t('job', 'Image'),
            'responsibilities' => Yii::t('job', 'Responsibilities'),
            'workspace_id' => Yii::t('job', 'Workspace ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkspace()
    {
        return $this->hasOne(Workspace::className(), ['id' => 'workspace_id']);
    }
}
