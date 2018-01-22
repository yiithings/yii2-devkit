<?php

namespace yiithings\devkit\commands;

use jamband\schemadump\SchemaDumpController;
use yii\base\Action;
use yii\db\Connection;

class SchemaDropAction extends Action
{
    /**
     * @var string a migration table name
     */
    public $migrationTable = 'migration';

    /**
     * @var Connection|string the DB connection object or the application component ID of the DB connection.
     */
    public $db = 'db';

    /**
     * Generates the 'dropTable' code.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        $controller = \Yii::createObject([
            'class' => SchemaDumpController::className(),
            'db' => $this->db,
            'migrationTable' => $this->migrationTable,

        ], ['schemaCreate', $this->controller]);
        $controller->beforeAction('drop');

        $controller->actionDrop();
    }
}