<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

use creocoder\translateable\TranslateableBehavior;

define("ACTION_TYPE_TEXT", 0);
define("ACTION_TYPE_QUESTION", 1);
define("ACTION_TYPE_SEGUE", 2);
define("ACTION_TYPE_END", 4);

/**
 * Description of SceneButton
 *
 * @author gorohovvalerij
 */
class SceneButton extends BaseSceneButton
{

	protected $translateModelName = 'SceneButtonTranslation';

	const ACTION_TYPE = [
		ACTION_TYPE_TEXT => 'Текст',
		ACTION_TYPE_QUESTION => 'Вопрос',
		ACTION_TYPE_SEGUE => 'Переход',
		ACTION_TYPE_END => 'Конец'
	];

	 /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneId', 'number', 'action', 'segueLocationId', 'segueSceneId', 'showTextButtonId', 'cost'], 'integer'],
            [['createdAt', 'updateAt', 'product'], 'safe'],
			[['action'], 'required'],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
            [['segueLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['segueLocationId' => 'locationId']],
            [['segueSceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['segueSceneId' => 'sceneId']],
            [['showTextButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => BaseSceneButton::className(), 'targetAttribute' => ['showTextButtonId' => 'sceneButtonId']]
        ];
    }
	
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'translateable' => [
				'class' => TranslateableBehavior::className(),
				'translationAttributes' => ['text', 'answer'],
			]
		];
	}

	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
		];
	}

	public function getTranslations()
	{
		return $this->hasMany(SceneButtonTranslation::className(), ['sceneButtonId' => 'sceneButtonId']);
	}
	
	public function save($runValidation = true, $attributeNames = null)
	{
		if ($this->action != ACTION_TYPE_SEGUE) {
			$this->segueLocationId = NULL;
			$this->segueSceneId = NULL;
			$this->showTextButtonId = NULL;
		}
		return parent::save($runValidation, $attributeNames);
	}

		/**
	 * @inheritdoc
	 */
	public function insert($runValidation = true, $attributes = null)
	{
		$result = parent::insert($runValidation, $attributes);
		if ($result) {
			$defaultCondition = new ConditionPressedButton();
			$defaultCondition->sceneButtonId = $this->sceneButtonId;
			$defaultCondition->verifiableSceneButtonId = $this->sceneButtonId;
			$defaultCondition->condition = 0;
			$defaultCondition->save();
		}
		return $result;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'sceneButtonId' => 'ID',
			'sceneId' => 'Сцена',
			'number' => 'Прядковый номер',
			'text' => 'Текст',
			'action' => 'Тип',
			'answer' => 'Ответ',
			'segueLocationId' => 'Локация перехода',
			'segueSceneId' => 'Сцена перехода',
			'showTextButtonId' => 'Выбор текcта при переходе',
			'cost' => 'Цена',
			'product' => 'ID внутриигровой покупки',
			'createdAt' => 'Создан',
			'updateAt' => 'Обновлен',
		];
	}

	/**
	 * 
	 * @return mixed[]
	 */
	public function serializationToArray()
	{
		return [
			'sceneButtonId' => $this->sceneButtonId,
			'sceneId' => $this->sceneId,
			'number' => $this->number,
			'text' => ($this->translate(\Yii::$app->language)->text != null) ? $this->translate(\Yii::$app->language)->text : $this->translate(\Yii::$app->sourceLanguage)->text,
			'action' => $this->action,
			'answer' => ($this->translate(\Yii::$app->language)->answer != null) ? $this->translate(\Yii::$app->language)->answer : $this->translate(\Yii::$app->sourceLanguage)->answer,
			'segueLocationId' => $this->segueLocationId,
			'segueSceneId' => $this->segueSceneId,
			'showTextButtonId' => $this->showTextButtonId,
			'cost' => $this->cost,
			'product' => $this->product,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
			'conditionPressedButtons' => ConditionPressedButton::serializationOfArray($this->conditionPressedButtons),
			'conditionLoadScenes' => ConditionLoadScene::serializationOfArray($this->conditionLoadScenes),
			'conditionVisitLocations' => ConditionVisitLocation::serializationOfArray($this->conditionVisitLocations),
			'conditionShowButtons' => ConditionShowButton::serializationOfArray($this->conditionShowButtons)
		];
	}

	/**
	 * 
	 * @param SceneButton[] $array
	 * @return mixed[]
	 */
	public static function serializationOfArray($array)
	{
		$serializedArray = [];
		foreach ($array as $model) {
			$serializedArray[] = $model->serializationToArray();
		}
		return $serializedArray;
	}

	/**
	 * 
	 * @return string
	 */
	public function getShortText()
	{
		return \common\components\StringHelper::truncate($this->sceneButtonId . '. #'. $this->number . ' ' . $this->text, 20);
	}

	/**
	 * 
	 * @return string
	 */
	public function getActionAsString()
	{
		$actionTypes = static::ACTION_TYPE;
		return $actionTypes[$this->action];
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionButtons()
    {
        return $this->hasMany(SceneButton::className(), ['answerTextButtonId' => 'sceneButtonId']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getShowTextButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'showTextButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSegueButtons()
    {
        return $this->hasMany(SceneButton::className(), ['showTextButtonId' => 'sceneButtonId']);
    }

}
