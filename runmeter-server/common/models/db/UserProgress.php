<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of UserProgress
 *
 * @author gorohovvalerij
 */
class UserProgress extends BaseUserProgress
{
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userProgressId' => 'User Progress ID',
            'userId' => 'User ID',
            'screenplayId' => 'Screenplay ID',
            'currentLocationId' => 'Current Location ID',
            'currentSceneId' => 'Current Scene ID',
            'currentButtonId' => 'Current Button ID',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }
	
	/**
	 * 
	 * @return mixed[]
	 */
	public function serializationToArray()
	{
		return [
			'userProgressId' => $this->userProgressId,
			'screenplayId' => $this->screenplayId,
			'currentLocationId' => $this->currentLocationId,
			'currentSceneId' => $this->currentSceneId,
			'currentButtonId' => $this->currentButtonId,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
			'loadedScenes' => $this->loadedScenes(),
			'visitedLocations' => $this->visitedLocations(),
			'pressedButtons' => $this->pressedButtons(),
			'buttonsPayments' => UserButtonsPayments::serializationOfArray($this->userButtonsPayments)
		];
	}
	
	/**
	 * 
	 * @return []
	 */
	function loadedScenes()
	{
		$scenes = [];
		$loadedScenes = $this->userLoadedScenes;
		foreach ($loadedScenes as $scene) {
			$scenes[] = $scene->sceneId;
		}
		return $scenes;
	}
	
	/**
	 * 
	 * @return []
	 */
	function visitedLocations()
	{
		$locations = [];
		$visitedLocations = $this->userVisitedLocations;
		foreach ($visitedLocations as $location) {
			$locations[] = $location->locationId;
		}
		return $locations;
	}
	
	/**
	 * 
	 * @return []
	 */
	function pressedButtons()
	{
		$buttons = [];
		$pressedButtons = $this->userPressedButtons;
		foreach ($pressedButtons as $button) {
			$buttons[] = $button->buttonId;
		}
		return $buttons;
	}

}
