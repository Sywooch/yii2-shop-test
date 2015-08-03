<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_category_id
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property string $image
 * @property string $created
 * @property string $updated
 * @property integer $active
 *
 * @property Product[] $products
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_category_id', 'active'], 'required'],
            [['parent_category_id', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'description', 'keywords', 'image'], 'string', 'max' => 255]
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
            'parent_category_id' => 'Родительская категория',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'content' => 'Содержание',
            'image' => 'Картинка',
            'created' => 'Создан',
            'updated' => 'Обновлен',
            'active' => 'Активность',
        ];
    }
    
    /**
     * List for DropDownList
     *  @property array $where
     */
    public static function getListCategory($where = null) {
        return self::find()->select(['name','id'])->where($where)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
    public function beforeValidate() {
        $time =\DateTime::createFromFormat('d-m-Y',$this->created);
        if(is_object($time)){
            $this->created = $time->format('U');
        }     
        //$this->updated = \DateTime::createFromFormat('d-m-Y',$this->updated)->format('U');
        return parent::beforeValidate();
    }
    
}
