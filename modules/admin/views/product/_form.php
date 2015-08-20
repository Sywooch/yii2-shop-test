<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $listCategory app\modules\admin\models\Category; */
/* @var $form yii\widgets\ActiveForm */

//$model->updated = Yii::$app->formatter->format($model->updated, 'date');
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' =>['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'active')->checkbox(['id' => 'check']) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($listCategory, 'id', 'name'));?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <?$images = $model->getImages()?>
            <div class="row">
                <?  foreach ($images as $image):?>
                <div class="col-md-3">
                    
                    <img src="<?=$image->getPath('200x200')?>">
                </div>
                <?endforeach?>
            </div>
            
        </div>
    </div>
    
    <?= $form->field($model, 'created')->widget(DatePicker::classname(),[
        'language' => 'ru',
        'dateFormat' => 'dd-MM-yyyy',
    ]) ?>
    <?= $form->field($model,'updated')->textInput(['maxlength' => true,'disabled' =>'disabled']) ?>
    <?= $form->field($model, 'screen_size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'os')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'standart')->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'content')->textArea(['rows'=>'15']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
