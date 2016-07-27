<?php

namespace app\modules\job\models;

use Yii;

/**
 * This is the model class for table "workspace".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 *
 * @property Job[] $jobs
 */
class Workspace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workspace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 6],
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
            'description' => Yii::t('job', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['workspace_id' => 'id']);
    }

    /**
     * Forms avatar
     *
     * @return string
     */
    public function getAvatar()
    {
	$image = $this->image ? $this->image : '0';
	return sprintf("/images/workspaces/%s.jpg", $image, $this->id);
    }
}
