<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $views
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['views', 'active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'views' => 'Views',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        // var_dump($insert);
        // var_dump($changedAttributes);
        // var_dump($this);
        // exit;

        if($insert) {
            // var_dump($this->created_at);
            // var_dump(strtotime($this->created_at));
            // var_dump(date('c', strtotime($this->created_at)));
            // exit;
            $productElastic = new ProductElastic();
            $productElastic->setPrimaryKey($this->id);
            $productElastic->views = "0";
            $productElastic->created_at = date('c');
        } else {
            $productElastic = ProductElastic::findOne($this->id);
            $productElastic->views = $this->views;
        }

        $productElastic->updated_at = date('c');
        $productElastic->name = $this->name;
        $productElastic->description = $this->description;
        $productElastic->image = $this->image;
        $productElastic->active = $this->active;
        $productElastic->save();
    }

    public function delete(){
        $productElastic = ProductElastic::findOne($this->id);

        if(!empty($productElastic)) {
            $productElastic->delete();
            // нужна секунда, что б после удаления успел обновиться elastic
            sleep(1);
        }

        return parent::delete();
    }
}
