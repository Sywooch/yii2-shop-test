<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\Category;
use app\modules\admin\models\SearchProduct;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProduct();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Product();
        if($model->isNewRecord){
            $model->active = 1;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->fileAttach($model);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'listCategory' => Category::getListCategory(),
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated = Yii::$app->formatter->format($model->updated, 'date');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->fileAttach($model);
            $model->updated = Yii::$app->formatter->format($model->updated, 'date');
            return $this->render('update', [
                'model' => $model,
                'listCategory' => Category::getListCategory(),
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'listCategory' => Category::getListCategory(),
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * attach image
     * @param type $model
     * @return boolean
     */
    protected function fileAttach($model) {
        $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
        if($model->image){
            $path = Yii::getAlias('@webroot/upload/files/').$model->image->baseName.'.'.$model->image->extension;
            $model->image->saveAs($path);
            $model->attachImage($path);
            return true;
        }
        return false;
    }
}
