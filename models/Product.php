<?php

namespace app\models;

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
class Product extends \yii\db\ActiveRecord
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'content' => 'Content',
            'image' => 'Image',
            'created' => 'Created',
            'updated' => 'Updated',
            'active' => 'Active',
            'screen_size' => 'Screen Size',
            'os' => 'Os',
            'standart' => 'Standart',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
