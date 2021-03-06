<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('orders', 'All Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <p>
        Lägg till en kostnadsräkning eller redigera inkorrekt information om en bokning genom att klicka på uppdatera.
    </p>
    <p>
        Visa all information som finns tillgänglig om en bokning genom att klicka på visa
    </p>
    <p>
        Filtrera bokningar i sökfälten
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'language',
            [
                'attribute'=> 'bill_sent',
                'value' => function($model){
                    if( isset($model->files[0]) ){
                        return $model->billLink;
                    } else{
                        return 'Ej klar';
                    }
                },
                'format' => 'html',
                'filter' => $searchModel->billSentList
            ],
             [
                 'attribute' => 'type',
                 'value' => function($model){
                    return $model->typeAsText;
                 },
                 'filter' =>$searchModel->typeList,
             ],
             'date',
            [
                'attribute' => 'user_id',
                'filter' => function($model) {
                    return $model->filterUserList;
                },
                'value' => function($model){
                    return $model->user->username;
                }
            ],
             'phone',
             'company_name',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Hantera'],
        ],
    ]); ?>
</div>
