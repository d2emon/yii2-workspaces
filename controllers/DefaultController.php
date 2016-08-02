<?php

namespace d2emon\workspace\controllers;

use Yii;
use d2emon\workspace\models\Workspace;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

use yii\helpers\Json;

/**
 * DefaultController implements the CRUD actions for Workspace model.
 */
class DefaultController extends Controller
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
     * Lists all Workspace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Workspace::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Workspace model.
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
     * Creates a new Workspace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Workspace();

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
     * Updates an existing Workspace model.
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
     * Deletes an existing Workspace model.
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
     * Uploads images into Workspace model.
     * @return mixed
     */
    public function actionUpload()
    {
	$workspace_id = Yii::$app->request->post('workspace_id', 0);
	$model = Workspace::findOne($workspace_id);
	if(!$model){
	    $model = new Workspace;
	}

	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        if ($model->upload()) {
	    if ($workspace_id) {
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
     * Finds the Workspace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workspace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workspace::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
