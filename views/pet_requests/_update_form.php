<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pet_requests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pet-requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'admin_message')->textarea() ?>

    <div class="d-none">
        <?= $form->field($model, 'status_id')->hiddenInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
