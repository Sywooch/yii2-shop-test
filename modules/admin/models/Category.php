<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
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
 * @property string $alias
 * @property string $created
 * @property string $updated
 * @property integer $active
 *
 * @property Product[] $products
 */
class Category extends ActiveRecord {

    const YES = 1;
    const NO = 0;


    /*
     * return array Yes or No
     */
    static function getYesNo()
    {
        return [
            self::YES=>'Да',
            self::NO=>'Нет',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'parent_category_id', 'active'], 'required'],
            [['parent_category_id', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'description', 'keywords', 'image', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['content'], 'string']
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ],
                'value' => function() {
                        return date('U');
                    },
            ],
            'alias' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'alias',
            ],
            'image' => [
                //'class' => 'rico\yii2images\behaviors\ImageBehave',
                'class' => 'app\behaviors\ImageBehavior',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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
            'alias' => 'Псевдоним',
        ];
    }

    /*
     * get parent category
     */
    public function getParent()
    {
        return $this->hasOne(self::className(),['parent_category_id'=>'id'])
            ->from(self::tableName() . ' parent');
    }

    /**
     * List for DropDownList
     *  @property array $where
     */
    public static function getListCategory($where = null) {
        return self::find()->select(['name', 'id'])->where($where)->all();
    }

    /**
     * массив категорий для меню
     * @return array
     * 
     * @param integer $category_id
     * @param integer $parent_category_id
     * 
     */
    public static function getItemsCategoryMenu($parent_category_id, $category_id = NULL) {
        $query = self::find()->where(['parent_category_id' => $parent_category_id, 'active' => 1])->select(['alias', 'id', 'name'])->all();
        $items = [];
        $i = 0;
        foreach ($query as $value) {
            $items[$i] = ['label' => $value->name, 'url' => ['category/view', 'alias' => $value->alias]];
            if (isset($category_id) && $category_id == $value->id) {
                $items[$i]['active'] = true;
            }
            $i++;
        }
        return $items;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts() {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public function beforeValidate() {
        $time = \DateTime::createFromFormat('d-m-Y', $this->created);
        if (is_object($time)) {
            $this->created = $time->format('U');
        }
        //$this->updated = \DateTime::createFromFormat('d-m-Y',$this->updated)->format('U');
        return parent::beforeValidate();
    }

}
