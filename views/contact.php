<?php

/** @var $this \ryan\lykacore\View */
/** @var $model \app\models\ContactForm */

use ryan\lykacore\form\TextAreaField;

$this->title = 'Contact';

?>

<h1>Contact</h1>

<?php $form = \ryan\lykacore\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'subject') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo new TextAreaField($model, 'body')?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \ryan\lykacore\form\Form::end(); ?>