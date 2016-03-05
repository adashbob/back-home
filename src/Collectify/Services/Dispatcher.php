<?php


namespace Collectify\Services;


/**
 * Dispatcher the controller and the action
 *
 * Class Dispatcher
 * @package Collectify\Services *
 *
 */
class Dispatcher
{
    protected $parameters;
    protected $viewer;
    protected $controller;
    protected $action;

    public function __construct(){
        $this->parameters = $_GET;
        $this->viewer     = new Viewer();
    }

    /**
     * get the controller and action and return a view
     */
    public function dispatch(){
        $viewParameters = $this->extractControllerAndActionParameter();
        $controllerParameters =  $this->executeAction();
        $this->viewer
            ->setViewParameters($viewParameters)
            ->setControllerParameters($controllerParameters)
            ->render();
    }

    /**
     * Extract the controller and action
     * @return array
     */
    private function extractControllerAndActionParameter(){
        $this->controller =  array_key_exists('controller', $this->parameters) ? $this->parameters['controller'] : DEFAULT_CONTROLLER;
        $this->action =  array_key_exists('action', $this->parameters) ? $this->parameters['action'] : DEFAULT_ACTION;
        return array($this->controller, $this->action);
    }

    /**
     * Execute the controller's action
     * @throws \Exception
     */
    public function executeAction(){
        $controllerClass = sprintf('\\Collectify\\Controller\\%sController', ucfirst($this->controller));

        if(!class_exists($controllerClass)){
            throw new \Exception("Controller $controllerClass not found");
        }
        $controller = new $controllerClass();

        $action = sprintf('%sAction', $this->action);
        if(!method_exists($controller, $action)){
            throw new \Exception("Action $action not exist on $controllerClass");
        }

        $this->cleanGetParameters();

        // Call $controller->$action($this->$parameters)
        return call_user_func_array(array($controller, $action), $this->parameters);
    }

    /**
     * Clean controller et action parametes in $_GET[]
     */
    public function cleanGetParameters()
    {
        switch (true){
            case array_key_exists('controller', $this->parameters):
                unset($this->parameters['controller']);
            case array_key_exists('action', $this->parameters):
                unset($this->parameters['action']);
        }
    }

}