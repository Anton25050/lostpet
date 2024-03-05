<?php

use app\models\Report;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\Pet_requestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description:ntext',
            'user',
            [
                'attribute'=> 'admin_message_custom',
                'content' => function ($admin_message) {
                    $html = Html::beginForm(['update', 'id' => $admin_message->id]);
                    $html .= Html::activeTextarea($admin_message, 'admin_message');
                    $html .= Html::submitButton('Сообщить', ['class' => 'btn btn-link']);
                    $html .= Html::endForm();
                    return $html;
                }
            ],
            [
                'attribute' => 'status',
                'content' => function ($report) {
                    $html = Html::beginForm(['update', 'id' => $report->id]);
                    $html .= Html::activeDropDownList($report, 'status_id',
                        [
                            2 => 'Принята',
                            3 => 'Отклонена'
                        ],
                        [
                            'prompt' => [
                                'text' => 'В обработке',
                                'options' => [
                                    'style' => 'display:none'
                                ]
                            ]
                        ]
                    );
                    $html .= Html::submitButton('Подтвердить', ['class' => 'btn btn-link']);
                
                    $html .= Html::endForm();
                    return $html;
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>