<?php

class PagenotfoundController extends Controller
{
    public function actionNotfound()
    {
        self::$renderName = 'notfound';
        self::renderLayout();
    }
}