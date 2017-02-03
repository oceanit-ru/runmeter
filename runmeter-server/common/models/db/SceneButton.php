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
		ACTION_TYPE_SEGUE => 'Переход'
	];

	 /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneId', 'number', 'action', 'answerTextButtonId', 'segueLocationId', 'segueSceneId', 'showTextButtonId', 'cost'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
			[['action'], 'required'],
            [['answerTextButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => BaseSceneButton::className(), 'targetAttribute' => ['answerTextButtonId' => 'sceneButtonId']],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
            [['segueLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['segueLocationId' => 'locationId']],
            [['segueSceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['segueSceneId' => 'sceneId']],
            [['showTextButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => BaseSceneButton::className(), 'targetAttribute' => ['showTextButtonId' => 'sceneButtonId']],
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
				'translationAttributes' => ['text'],
			// translationRelation => 'translations',
			// translationLanguageAttribute => 'language',
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
			'answerTextButtonId' => 'Ответ',
			'segueLocationId' => 'Локация перехода',
			'segueSceneId' => 'Сцена перехода',
			'showTextButtonId' => 'Выбор текcта при переходе',
			'cost' => 'Цена',
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
			'answerTextButtonId' => $this->answerTextButtonId,
			'segueLocationId' => $this->segueLocationId,
			'segueSceneId' => $this->segueSceneId,
			'showTextButtonId' => $this->showTextButtonId,
			'cost' => $this->cost,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
			'conditionPressedButtons' => ConditionPressedButton::serializationOfArray($this->conditionPressedButtons),
			'conditionLoadScenes' => ConditionLoadScene::serializationOfArray($this->conditionLoadScenes),
			'conditionVisitLocations' => ConditionVisitLocation::serializationOfArray($this->conditionVisitLocations),
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
		return \common\components\StringHelper::truncate($this->sceneButtonId . '. ' . $this->text, 20);
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
    public function getAnswerTextButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'answerTextButtonId']);
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
