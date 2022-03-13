<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Class CommandController
 *
 * @package app\commands
 */
class CommandController extends Controller
{

    public $defaultAction = 'index';

    /**
     * Test console command
     */
    public function actionIndex() {
        echo "Test console command\n";
    }
}
