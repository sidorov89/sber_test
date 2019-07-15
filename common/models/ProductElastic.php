<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $views
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 */
// class Product extends \yii\db\ActiveRecord
class ProductElastic extends \yii\elasticsearch\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
    //         [['name'], 'required'],
    //         [['description'], 'string'],
    //         [['views', 'active'], 'integer'],
    //         [['created_at', 'updated_at'], 'safe'],
    //         [['name', 'image'], 'string', 'max' => 255],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    // public function attributeLabels()
    // {
    //     return [
    //         'id' => 'ID',
    //         'name' => 'Name',
    //         'description' => 'Description',
    //         'image' => 'Image',
    //         'views' => 'Views',
    //         'active' => 'Active',
    //         'created_at' => 'Created At',
    //         'updated_at' => 'Updated At',
    //     ];
    // }

    public function attributes()
    {
        return ['id', 'name', 'description', 'image', 'views', 'active', 'created_at', 'updated_at'];
    }

    public static function index() {
        return 'sber';
    }

    public static function type() {
        return 'product';
    }

    
}
