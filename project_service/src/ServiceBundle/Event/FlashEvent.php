<?php

namespace ServiceBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of BrandEvent
 *
 * @author michal
 */
class FlashEvent extends Event {

    //const NAME = 'flash.add';

    protected $entity;
    protected $request;

    public function __construct($entity, Request $request) {
        $this->entity = $entity;
        $this->request = $request;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function getRequest() {
        return $this->request;
    }
    
}
