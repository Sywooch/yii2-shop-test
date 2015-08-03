<?php

namespace app\modules\admin\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property string $image
 * @property string $created
 * @property string $updated
 * @property integer $active
 * @property string $screen_size
 * @property string $os
 * @property string $standart
 * @property integer $category_id
 *
 * @property Category $category
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'active', 'category_id'], 'required'],
            [['price'], 'number'],
            [['created', 'updated'], 'safe'],
            [['active', 'category_id'], 'integer'],
            [['name', 'description', 'keywords', 'image', 'screen_size', 'os', 'standart'], 'string', 'max' => 255]
        ];
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created','updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
                'value' => function() { return date('U');},
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'price' => 'Цена',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'content' => 'Content',
            'image' => 'Изображение',
            'created' => 'Создан',
            'updated' => 'Обновлен',
            'active' => 'Активность',
            'screen_size' => 'Размер экрана',
            'os' => 'Операционная система',
            'standart' => 'Стандарт связи',
            'category_id' => 'Категория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    public function beforeValidate() {
        $time =\DateTime::createFromFormat('d-m-Y',$this->created);
        if(is_object($time)){
            $this->created = $time->format('U');
        }
        //$this->updated = \DateTime::createFromFormat('d-m-Y',$this->updated)->format('U');
        //Yii::info('1111', 'apiResponse');
        return parent::beforeValidate();
    }
    /*
    public function beforeUpdate() {
        echo '!!!!!!!!!!';
        Yii::info('1111', 'apiRequest');
        return parent::beforeUpdate();
    }*/
}
