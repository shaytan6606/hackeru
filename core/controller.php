<?php

abstract class Controller 
{
    public static $renderName;

    public static $renderData;

    public function renderLayout()
    {
        require_once(ROOT.'/view/templateView.php');
    }
    public function render($renderData = 0)
    {

        require_once(ROOT.'/view/'.self::$renderName.'View.php');
    }

    public function getModel($modelsName)
    {
        foreach($modelsName as $modelName){
            include_once ROOT. '/models/'.$modelName.'.php';
        }    
    }
}