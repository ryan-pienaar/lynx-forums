<?php

/** @var $this \ryanp\lykacore\View */
/** @var $model \app\models\ContactForm */

use ryanp\lykacore\form\TextAreaField;

$this->title = 'Contact';

?>

<h1>Contact</h1>

<?php $form = \ryanp\lykacore\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'subject') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo new TextAreaField($model, 'body')?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \ryanp\lykacore\form\Form::end(); ?>