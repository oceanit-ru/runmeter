<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\Model;
use common\models\db\Language;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model Model */
/* @var $attribute */
/* @var $languageList mixed[] */
/* @var $label string */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
	$sourceLang = Yii::$app->sourceLanguage;
	$modalName = 'translateModal' . (new \ReflectionClass($model))->getShortName() . $attribute;
	$attributeLabel = $model->getAttributeLabel($attribute);
			echo $form->field($model->translate($sourceLang), "[$sourceLang]$attribute", [
				'template'=>""
				. "{label}\n"
				. "<div class=\"input-group\">"
					. "{input}\n"
					. "<span class=\"input-group-addon btn btn-default modalButton\" type=\"button\" data-modal=\"$modalName\">"
							. "<i class=\"fa fa-globe\" aria-hidden=\"true\"></i>"
					. "</span>"
				. "</div>\n"
				. "{hint}\n"
				. "{error}"])->label(isset($label) ? $label : $attributeLabel . " [$sourceLang]")->textInput(['placeholder' => "Введите $attributeLabel ..."]);
	Modal::begin([
		'id' => "$modalName",
		'options' => [
			'class' => 'translateModal'
		],
		'header' => "<h2>Перевод для $attributeLabel</h2>",
		'footer' => "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">OK</button>"
	]);
		foreach ($languageList as $language) {
			$lang = $language['language'];
			if (Yii::$app->sourceLanguage !== $lang) {
				echo $form->field($model->translate($lang), "[$lang]$attribute",['enableClientValidation' => false])->label($language['label'] . " [$lang]")->textInput();
			}
		}
	Modal::end();
?>


