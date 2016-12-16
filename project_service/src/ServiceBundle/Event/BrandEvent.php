<?php

namespace ServiceBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use ServiceBundle\Entity\Brand;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of BrandEvent
 *
 * @author michal
 */
class BrandEvent extends Event {

    const NAME = 'brand.added';

    protected $brand;
    protected $request;

    public function __construct(Brand $brand, Request $request) {
        $this->brand = $brand;
        $this->request = $request;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getRequest() {
        return $this->request;
    }

}
