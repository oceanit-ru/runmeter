#!/bin/bash

# Base
php yii gii/model --tableName=user --modelClass=BaseUser --ns="common\models\db" --overwrite=1 --interactive=0

# Screenplay
php yii gii/model --tableName=screenplay --modelClass=BaseScreenplay --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=location --modelClass=BaseLocation --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=scene --modelClass=BaseScene --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneButton --modelClass=BaseSceneButton --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionVisitLocation --modelClass=BaseConditionVisitLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionLoadScene --modelClass=BaseConditionLoadScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionPressedButton --modelClass=BaseConditionPressedButton --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionShowButton --modelClass=BaseConditionShowButton --ns="common\models\db" --overwrite=1 --interactive=0

# Translate
php yii gii/model --tableName=screenplayTranslation --modelClass=BaseScreenplayTranslation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=locationTranslation --modelClass=BaseLocationTranslation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneTranslation --modelClass=BaseSceneTranslation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneButtonTranslation --modelClass=BaseSceneButtonTranslation --ns="common\models\db" --overwrite=1 --interactive=0

# User screenplay storeddata
php yii gii/model --tableName=userProgress --modelClass=BaseUserProgress --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userLoadedScenes --modelClass=BaseUserLoadedScenes --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userVisitedLocations --modelClass=BaseUserVisitedLocations --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userPressedButtons --modelClass=BaseUserPressedButtons --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userButtonsPayments --modelClass=BaseUserButtonsPayments --ns="common\models\db" --overwrite=1 --interactive=0