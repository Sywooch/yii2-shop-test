<?php

namespace app\controllers;

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
     * Displays a single Product model.
     * @param string $alias
     * @return mixed
     */
    public function actionView($alias)
    {
        $model = $this->findModel($alias);
        $menu_items_product = Product::getItemsProductMenu($model->category_id);
        $menu_items_category = Category::getItemsCategoryMenu($model->category->parent_category_id,$model->category_id);
        return $this->render('view', [
            'model' => $model,
            'menu_items_product' => $menu_items_product,
            'menu_items_category' => $menu_items_category,
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $alias
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alias)
    {
        if (($model = Product::findOne(['alias' => $alias,'active' => 1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * 
     * @return type
     * список меню. товары текущей категории
     */
    public static function getItems($param) {
        
    }
}
