<?php

/** @var $this \ryanp\lykacore\View */

$this->title = 'Register';

?>

<h1>Register</h1>

<?php $form = \ryanp\lykacore\form\Form::begin('', "post") ?>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>

    <?php echo $form->field($model, 'username') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Register</button>
<?php \ryanp\lykacore\form\Form::end() ?>
