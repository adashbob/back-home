<?php


namespace Collectify\Controller;


use Collectify\Form\CategoryForm;
use Collectify\Form\Handler\FormHandler;
use Collectify\Model\CategoryRepository;

class CategoryController
{
    public function listAction()
    {
        $repository = new CategoryRepository();

        return array('categories' => $repository->getAll());
    }

    public function showAction($id)
    {
        $repository = new CategoryRepository();
        $cateogry = $repository->load($id);

        return array('category' => $cateogry);
    }

    public function addAction()
    {
        $handler = new FormHandler(CategoryRepository::TYPE);
        $form = $handler->getFrom();

        if($handler->handle(FormHandler::CREATE)){
            $this->redirect();
        }

        return array('form' => $form->render());
    }

    public function editAction($id)
    {
        $repository = new CategoryRepository();
        $category = $repository->load($id);
        $data = $category->getProperties();

        $handler = new FormHandler(CategoryRepository::TYPE, $data);
        $form = $handler->getFrom();
        $handler->setObject($category);

        if($handler->handle(FormHandler::UPDATE)){
            $this->redirect();
        }

        return array('form' => $form->render());
    }

    public function removeAction($id){
        $repository = new CategoryRepository();
        $repository->remove($id);

        $this->redirect();
    }

    private function redirect()
    {
        $redirect = sprintf('Location: app.php?controller=%s&action=list', CategoryRepository::TYPE);
        header($redirect);
    }
}