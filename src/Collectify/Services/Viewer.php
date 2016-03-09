<?php


namespace Collectify\Services;


/**
 * Class Viewer
 * @package Collectify\Services
 */
class Viewer
{
    protected $controllerParameters;
    protected $viewParameters;
    protected $viewPath;
    protected $dynamizer;

    public function __construct()
    {
        $this->dynamizer = new Dynamizer();;
    }

    public function setControllerParameters($parameters)
    {
        $this->controllerParameters = $parameters;
        return $this;
    }

    public function setViewParameters($parameters)
    {
        $this->viewParameters = $parameters;
        return $this;
    }

    /**
     * Render the content view
     * @throws \Exception
     */
    public function render()
    {
        $viewPath = $this->createPath();
        $view =  file_get_contents($viewPath);
        echo $this->dynamizer
            ->setParameters($this->controllerParameters)
            ->setView($view)
            ->dynamize();

    }


    /**
     * Create the path of the view
     * @return string
     * @throws \Exception
     */
    private function createPath()
    {
        list($controller, $action) = $this->viewParameters;
        $viewPathString = sprintf('../src/Collectify/Views/%s/%s.html', $controller, $action);

        if (!file_exists($viewPathString)) {
            throw new \Exception("view $viewPathString not found");
        }
        return $this->viewPath =  $viewPathString;
    }

}