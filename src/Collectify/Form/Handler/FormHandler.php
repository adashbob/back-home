<?php


namespace Collectify\Form\Handler;


class FormHandler
{
    protected $form;
    protected $repository;
    protected $data;
    protected $object;

    const CREATE = 1;
    const UPDATE = 2;

    public function __construct($type, $data = array())
    {
        $formClass = sprintf('\\Collectify\\Form\\%sForm', ucfirst($type));
        $repositoryClass = sprintf('\\Collectify\\Model\\%sRepository', ucfirst($type));

        if(!class_exists($formClass)){
            throw new \Exception("class $formClass not exist");
        }
        if(!class_exists($repositoryClass)){
            throw new \Exception("class $repositoryClass not exist");
        }

        $this->form = new $formClass();
        $this->repository = new $repositoryClass();
        $this->data = $data;

    }

    public function getFrom(){
        $form = $this->form->getForm();
        if(!empty($this->data)){
            $form->addData($this->data);
        }
        return $form;
    }

    public function setObject($object){
        $this->object = $object;
    }

    public function getData(){
        $data = $_POST['nibble_form'];
        unset($data['_crsf_token']);
        return $data;
    }

    public function isPosted()
    {
        return !empty($_POST);
    }

    public function dataExists()
    {
        return array_key_exists('nibble_form', $_POST);
    }

    public function handle($state){
        if($this->isPosted() && $this->dataExists()){
            if($this->getFrom()->validate()){
                $this->createOrUpdate($state);
                return true;
            }
        }
    }

    private function createOrUpdate($state)
    {
        $data = $this->getData();
        if(self::CREATE === $state){
            $this->repository->create($data);
        }else{
            $this->repository->update($data, $this->object);
        }
    }

}