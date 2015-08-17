<?php

namespace app\controllers;

use Yii;
use app\modules\admin\models\Category;
use app\modules\admin\models\Product;
use app\modules\admin\models\SearchCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {

    public function behaviors() {
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex() {
        /*$searchModel = new SearchCategory();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);*/
        $menu_items_category = Category::getItemsCategoryMenu(0);
        $query = Product::find()->where(['active' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => Yii::$app->params['PageSize']]);
        $items_product = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('index', [
                    'menu_items_category' => $menu_items_category,
                    'items_product' => $items_product,
                    'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($alias) {
        $model = $this->findModel($alias);
        $menu_items_product = Product::getItemsProductMenu($model->id);
        $menu_items_category = Category::getItemsCategoryMenu($model->parent_category_id);
        $query = Product::find()->where(['active' => 1, 'category_id' => $model->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => Yii::$app->params['PageSize']]);
        $items_product = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('view', [
                    'model' => $model,
                    'menu_items_product' => $menu_items_product,
                    'menu_items_category' => $menu_items_category,
                    'items_product' => $items_product,
                    'pages' => $pages,
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alias) {
        if (($model = Category::findOne(['alias' => $alias, 'active' => 1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
