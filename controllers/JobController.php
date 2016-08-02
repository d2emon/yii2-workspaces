<?php

namespace d2emon\workspace\controllers;

use Yii;
use d2emon\workspace\models\Job;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

use yii\helpers\Json;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Job::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save()) {
	        // file is uploaded successfully
            	return $this->redirect(['view', 'id' => $model->id]);
	    }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Uploads images into Job model.
     * @return mixed
     */
    public function actionUpload()
    {
	$job_id = Yii::$app->request->post('job_id', 0);
	$model = Job::findOne($job_id);
	if(!$model){
	    $model = new Job;
	}

	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        if ($model->upload()) {
	    if ($job_id) {
		return Json::encode($model->save());
	    }else{
		Yii::$app->session->setFlash('image', $model->image);
	        return Json::encode(True);
	    }
	    // file is uploaded successfully
	}
	return Json::encode(False);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
