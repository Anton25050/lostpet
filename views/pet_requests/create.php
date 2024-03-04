<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pet_requests $model */

$this->title = 'Create Pet Requests';
$this->params['breadcrumbs'][] = ['label' => 'Pet Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
