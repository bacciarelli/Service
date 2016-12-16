<?php
namespace ServiceBundle\EventListener;

use ServiceBundle\Event\BrandEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;


/**
 * Description of BrandListener
 *
 * @author michal
 */
class BrandListener {
    
    
    public function onBrandAdded(BrandEvent $event) {
        $brand = $event->getBrand();
        $request = $event->getRequest();
        
        $request->getSession()->getFlashbag()
                    ->add('success', "New brand: \"" . $brand->getName() . "\" has been added");
    }
}
