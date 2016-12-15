<?php

namespace ServiceBundleBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use ServiceBundle\Entity\Brand;


/**
 * Description of BrandEvent
 *
 * @author michal
 */
class BrandEvent extends Event{
    const NAME = 'brand.added';
    
    protected $brand;
    
    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }
    
    public function getBrand() {
        return $this->brand;
    }
}
