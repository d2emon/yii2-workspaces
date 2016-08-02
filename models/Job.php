<?php

namespace d2emon\workspace\models;

use Yii;
use app\modules\profile\models\Profile;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'profile_id']);
    }

    public function getDescription()
    {
    	return $this->responsibilities;
    }

    /**
     * Forms avatar
     *
     * @return string
     */
    public function getThumb($suffix='')
    {
	$group = Yii::$app->getModule('workspace')->getImageGroup(1);
	if (!$this->image)
	    return $group->getDefault_filename($suffix) ? $group->getDefault_filename($suffix) : '';
	return '/'.$group->getFilename($this->image, $suffix);
    }
}
