<?php

/** @var $model app\models\User */
/** @var $this \ryan\lykacore\View */

$this->title = 'Home';

?>

<h1>Login</h1>

<?php $form = \ryan\lykacore\form\Form::begin('', "post") ?>

<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>

<button type="submit" class="btn btn-primary">Login</button>
<?php \ryan\lykacore\form\Form::end() ?>