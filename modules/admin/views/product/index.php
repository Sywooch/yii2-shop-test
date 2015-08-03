<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchProduct */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'class' => yii\grid\CheckboxColumn::classname(),
                'headerOptions' => [
                     'class'=>'col-sm-1'
                ],
            ],
            [
                'attribute' => 'id',
                'headerOptions' => [
                     'class'=>'col-sm-1'
                ],
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($product) {
                    return Html::tag('a', $product->name, ['href' => Url::to(['update','id' => $product->id])]);
                }
            ],
            [
                'attribute' => 'price',
                'value' => function($product) {
                    return isset($product->price) ? $product->price : 'По запросу';
                }
            ],
            'created:datetime',
            [
                'attribute'=>'active',
                'format' => 'raw',
                'value' => function($product) {
                    if($product->active){
                        $mes = 'Да';
                        $class = 'success';
                    }else{
                        $mes = 'Нет';
                        $class = 'warning';
                    }
                    return Html::tag('span', $mes, ['class' => 'label label-'.$class]);
                },
                'headerOptions' => [
                     'class'=>'col-sm-1'
                ],
            ],
            //'category.name',// то же самое, что и запись ниже
            [
                'attribute'=>'category_id',
                'label'=>'Категория товара',
                'value' => function($product) {
                    return $product->category->name;
                }
            ],
            // 'image',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'headerOptions' => [
                     'class'=>'col-sm-1'
                ],
            ],
        ],
    ]); ?>

</div>
