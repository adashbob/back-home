<?php


namespace Collectify\Controller;

use Collectify\Model\ItemRepository;
use RedBeanPHP\Facade as R;
class HomeController
{
    public function homepageAction()
    {
        $item = R::load(ItemRepository::TYPE, 9);
        return array('item' => 'bobo');
    }
}