<?php
namespace OneThink\OrmBundle\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseListener{

    public function onKernelResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $response->headers->set('Symfony-Debug-Toolbar-Replace', 1);
    }
}
