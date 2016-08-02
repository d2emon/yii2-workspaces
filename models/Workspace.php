<?php

namespace d2emon\workspace\models;

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
    public $imageFile;

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

    public function upload()
    {
        if ((!$this->imageFile) && (Yii::$app->session->hasFlash('image'))){
	    $this->image = Yii::$app->session->getFlash('image');
	    return True;
	}
	Yii::$app->session->removeFlash('image');
	if (!$this->imageFile) {
	    return True;
	}
	if ($this->validate()) {
	    $group = Yii::$app->getModule('workspace')->getImageGroup(0);
	    $this->image = $group->replace($this->image, $this->imageFile);
	    /*
	    Image::thumbnail($imagePath.$filename, 64, 64)
		->save($imagePath.$imagename.'_s.jpg');
	     */
	    
	    $this->imageFile = null;
            return True;
        } else {
            return false;
        }
    }

    /**
     * Forms avatar
     *
     * @return string
     */
    public function getThumb($suffix='')
    {
	$group = Yii::$app->getModule('workspace')->imageGroup;
	if (!$this->image)
	    return '/'.$group->getDefault_filename($suffix);
	return '/'.$group->getFilename($this->image, $suffix);
    }
}
