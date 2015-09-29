<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории каталога товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'class' => yii\grid\CheckboxColumn::classname(),
                'headerOptions' => [
                     'class'=>'col-md-1'
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
                'value' => function($category) {
                    return Html::tag('a', $category->name, ['href' => Url::to(['update','id' => $category->id])]);
                }
            ],
            'parent_category_id',
            [
                'attribute' => 'parent_category_id',
                'format' => 'raw',
                'value' => function($category) {
                    //return Html::tag('a', $category->name, ['href' => Url::to(['update','id' => $category->id])]);
                
                }
            ],
            [
                'attribute'=>'active',
                'format' => 'raw',
                'value' => function($category) {
                    if($category->active){
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
            //'description',
            //'keywords',
            // 'content',
            // 'image',
            // 'created',
            // 'updated',

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
