<?php


namespace Collectify\Form;


use Nibble\NibbleForms\NibbleForm;

class CategoryForm
{

    private $form;

    public function __construct(){
        $this->form = NibbleForm::getInstance('category', '', true, 'post', 'Save', 'table');
        $this->buildForm();
    }

    public function buildForm(){
        $this->form
            ->addField('name', 'text', array('required' => true));
    }

    public function getForm(){
        return $this->form;
    }
}