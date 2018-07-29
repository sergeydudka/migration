<?php

namespace crudschool\migrik;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($app->hasModule('gii')) {
            if (!isset($app->getModule('gii')->generators['migrik'])) {
                $app->getModule('gii')->generators['migrik'] = 'crudschool\migrik\gii\StructureGenerator';
                //$app->getModule('gii')->generators['migrikdata'] = 'crudschool\migrik\gii\DataGenerator';
                $app->getModule('gii')->generators['migrikdoc'] = 'crudschool\migrik\gii\ByModelGenerator';
            }
            \Yii::$container->set('crudschool\migrik\contracts\IMigrationTableResolver', 'crudschool\migrik\resolver\TableResolver');
            \Yii::$container->set('crudschool\migrik\contracts\IPhpdocResolver', 'crudschool\migrik\resolver\PhpDocResolver');
            \Yii::$container->set('crudschool\migrik\contracts\IModelResolver', 'crudschool\migrik\resolver\ModelResolver');
        }
    }
}
