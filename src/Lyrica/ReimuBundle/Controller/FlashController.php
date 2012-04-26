<?php

namespace Lyrica\ReimuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlashController extends Controller
{
    /**
     * Displays flash then redirects to another page
     *
     * @param string $message
     * @param string $forward name of the forwarding route
     */
    public function displayAction($message, $forward)
    {
    }
}