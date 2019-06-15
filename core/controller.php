<?php

abstract class Controller 
{
    public static $renderName;

    public static $renderData;

    public static $pageName;

    protected $layout_name = 'template';
    protected $template_dir = '';


    public function renderLayout($view, $data = []) // принимать имя шаблона по имени лэйаута
    {
        //$data = [];
        require_once(ROOT.'/view/template/' . $view . 'View.php');
    }
    public function render($templateName, $renderData = 0) // принимать имя темплейта
    {
        ob_start();
        echo '>>>';
        require_once(ROOT.'/view/'. $this->template_dir. '/' . self::$renderName.'View.php');
        echo '<<<';
        $res = ob_get_clean();
        return $res;
    }

    public function getModel($modelName)
    {
        // foreach($modelsName as $modelName){
            include_once ROOT. '/models/'.$modelName.'.php';
            return new $modelName;
        // }    
        //return new $modelName;
    }
}