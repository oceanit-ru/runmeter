#!/bin/bash

# Screenplay
php yii gii/model --tableName=screenplay --modelClass=BaseScreenplay --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=location --modelClass=BaseLocation --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=scene --modelClass=BaseScene --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneButton --modelClass=BaseSceneButton --baseClass="common\models\db\TranslatableModel" --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionVisitLocation --modelClass=BaseConditionVisitLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionLoadScene --modelClass=BaseConditionLoadScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionPressedButton --modelClass=BaseConditionPressedButton --ns="common\models\db" --overwrite=1 --interactive=0

# Translate
php yii gii/model --tableName=screenplayTranslation --modelClass=BaseScreenplayTranslation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=locationTranslation --modelClass=BaseLocationTranslation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneTranslation --modelClass=BaseSceneTranslation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneButtonTranslation --modelClass=BaseSceneButtonTranslation --ns="common\models\db" --overwrite=1 --interactive=0

# User screenplay storeddata
php yii gii/model --tableName=userVisitLocation --modelClass=BaseUserVisitLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userLoadScene --modelClass=BaseUserLoadScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=userPressedButton --modelClass=BaseUserPressedButton --ns="common\models\db" --overwrite=1 --interactive=0