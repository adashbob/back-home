<?php


namespace Collectify\Controller;


class HomeController
{
    public function homepageAction($user)
    {
        return array('user' => $user);
    }
}