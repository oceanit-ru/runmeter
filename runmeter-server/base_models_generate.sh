#!/bin/bash

# Screenplay
php yii gii/model --tableName=screenplay --modelClass=BaseScreenplay --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=location --modelClass=BaseLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=scene --modelClass=BaseScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneButton --modelClass=BaseSceneButton --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionVisitLocation --modelClass=BaseConditionVisitLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionLoadScene --modelClass=BaseConditionLoadScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionPressedButton --modelClass=BaseConditionPressedButton --ns="common\models\db" --overwrite=1 --interactive=0

# User screenplay storeddata
php yii gii/model --tableName=userVisitLocation --modelClass=BaseUserVisitLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userLoadScene --modelClass=BaseUserLoadScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userPressedButton --modelClass=BaseUserPressedButton --ns="common\models\db" --overwrite=1 --interactive=0