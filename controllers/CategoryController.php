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
use yii\data\Sort;

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
        $menu_items_category = Category::getItemsCategoryMenu(0);
        $sort = new Sort([
            'attributes' => [
                'price' => [
                    'asc' => ['price' => SORT_ASC],
                    'desc' => ['price' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Сортировать по цене',
                ],
            ],
        ]);
        $query = Product::find()->where(['active' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => Yii::$app->params['PageSize']]);
        $items_product = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy($sort->orders)
                ->all();
        return $this->render('index', [
                    'menu_items_category' => $menu_items_category,
                    'items_product' => $items_product,
                    'pages' => $pages,
                    'sort' => $sort,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param string $alias
     * @return mixed
     */
    public function actionView($alias) {
        $model = $this->findModel($alias);
        $menu_items_product = Product::getItemsProductMenu($model->id);
        $menu_items_category = Category::getItemsCategoryMenu($model->parent_category_id);
        $sort = new Sort([
            'attributes' => [
                'price' => [
                    'asc' => ['price' => SORT_ASC],
                    'desc' => ['price' => SORT_DESC],
                    'default' => SORT_DESC,
                    //'label' => 'Сортировать по цене',
                ],
            ],
        ]);
        $query = Product::find()->where(['active' => 1, 'category_id' => $model->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => Yii::$app->params['PageSize']]);
        $items_product = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy($sort->orders)
                ->all();
        return $this->render('view', [
                    'model' => $model,
                    'menu_items_product' => $menu_items_product,
                    'menu_items_category' => $menu_items_category,
                    'items_product' => $items_product,
                    'pages' => $pages,
                    'sort' => $sort,
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
