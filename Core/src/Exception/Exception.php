<?php
/**
 * Created by PhpStorm.
 * User: bobo
 * Date: 12/09/16
 * Time: 20:18
 */

namespace Core\Exception;


class Exception extends \Exception
{
    protected $view;

    public function notFound()
    {
        $viewPathString = '../Core/src/Exception/Views/404.html';

        if (!file_exists($viewPathString)) {
            throw new \Exception("view $viewPathString not found");
        }
        echo file_get_contents($viewPathString); die();
    }

}