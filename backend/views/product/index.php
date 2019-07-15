<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
    
    // var_dump($dataProvider->query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
    // $products = $dataProvider->query->all();
    // var_dump($products);
    // var_dump($products[1]->getPrimaryKey());
    // exit;
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            [
                'attribute' => 'id',
                'label' => 'PrimaryKey',
                'content' => function($model) {
        
                    return $model->getPrimaryKey();
                }
            ],
            'name',
            'description:ntext',
            'image',
            'views',
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'content' => function($model) {
                    return date('d.m.Y H:i:s', strtotime($model->created_at));
                }
            ],
            //'active',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
