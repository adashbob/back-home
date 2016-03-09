<?php


namespace Collectify\Services;


/**
 * Class Helper
 * @package Collectify\Services
 */
class Helper
{
    public function sayHello(){
        return 'Bonjout tout le monde';
    }

    public function getList($type){
        $repositoryClass = sprintf('\Collectify\Model\%sRepository', $type);
        $repository = new $repositoryClass();
        $objects =  $repository->getAll();

        $html = '';
        foreach ($objects as $object) {
            $name = $object->name;
            $editLink = sprintf('<a href="app.php?controller=category&action=edit&id=%s">Edit</a>', $object->id);
            $showLink = sprintf('<a href="app.php?controller=category&action=show&id=%s">Show</a>', $object->id);
            $removeLink = sprintf('<a href="app.php?controller=category&action=remove&id=%s">Remove</a>', $object->id);
            $html .=<<<EOF
<tr>
    <td>$name</td>
    <td>$editLink - $showLink - $removeLink</td>
</tr>
EOF;

        }
        return $html;
    }
}