<?php

namespace ServiceBundle\EventSubscriber;

use ServiceBundle\Event\FlashEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ServiceBundle\ServiceEvents;

/**
 * Description of BrandSubscriber
 *
 * @author michal
 */
class BrandSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        return array(
            ServiceEvents::BRAND_ADDED => 'onNewAction',
            ServiceEvents::CLIENT_ADDED => 'onNewAction',
            ServiceEvents::MACHINE_ADDED => 'onNewMachineAction',
            ServiceEvents::MODEL_ADDED => 'onNewAction',
            ServiceEvents::REPAIR_STATUS_ADDED => 'onNewAction',
            ServiceEvents::TYPE_ADDED => 'onNewAction',
            ServiceEvents::BRAND_EDITED => 'onEditAction',
            ServiceEvents::CLIENT_EDITED => 'onEditAction',
            ServiceEvents::MACHINE_EDITED => 'onEditMachineAction',
            ServiceEvents::MODEL_EDITED => 'onEditAction',
            ServiceEvents::REPAIR_STATUS_EDITED => 'onEditAction',
            ServiceEvents::TYPE_EDITED => 'onEditAction',
            ServiceEvents::BRAND_DELETED => 'onDeleteAction',
            ServiceEvents::CLIENT_DELETED => 'onDeleteAction',
            ServiceEvents::MACHINE_DELETED => 'onDeleteMachineAction',
            ServiceEvents::MODEL_DELETED => 'onDeleteAction',
            ServiceEvents::REPAIR_STATUS_DELETED => 'onDeleteAction',
            ServiceEvents::TYPE_DELETED => 'onDeleteAction',
            ServiceEvents::MACHINE_SEND => 'onSentMachineAction',
        );
    }

    private static $label = array(
        ServiceEvents::BRAND_ADDED => 'New brand',
        ServiceEvents::CLIENT_ADDED => 'New client',
        ServiceEvents::MACHINE_ADDED => 'New machine',
        ServiceEvents::MODEL_ADDED => 'New model',
        ServiceEvents::REPAIR_STATUS_ADDED => 'New repair status',
        ServiceEvents::TYPE_ADDED => 'New type',
        ServiceEvents::BRAND_EDITED => 'Brand',
        ServiceEvents::CLIENT_EDITED => 'Client',
        ServiceEvents::MACHINE_EDITED => 'Machine',
        ServiceEvents::MODEL_EDITED => 'Model',
        ServiceEvents::REPAIR_STATUS_EDITED => 'Repair status',
        ServiceEvents::TYPE_EDITED => 'Type',
        ServiceEvents::BRAND_DELETED => 'Brand',
        ServiceEvents::CLIENT_DELETED => 'Client',
        ServiceEvents::MACHINE_DELETED => 'Machine',
        ServiceEvents::MODEL_DELETED => 'Model',
        ServiceEvents::REPAIR_STATUS_DELETED => 'Repair status',
        ServiceEvents::TYPE_DELETED => 'Type',
        ServiceEvents::MACHINE_SEND => 'Machine',
    );

    public function onNewAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getName() . "\" has been added");
    }
    
    public function onEditAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getName() . "\" has been edited");
    }
    
    public function onDeleteAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getName() . "\" has been deleted");
    }
    
    public function onNewMachineAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getComplaintNumber() . "\" has been added");
    }
    
    public function onEditMachineAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getComplaintNumber() . "\" has been edited");
    }
    
    public function onDeleteMachineAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getComplaintNumber() . "\" has been deleted");
    }
    
    public function onSentMachineAction(FlashEvent $event, $eventName) {
        $entity = $event->getEntity();
        $request = $event->getRequest();

        $request->getSession()->getFlashbag()
                ->add('success', self::$label[$eventName] . ": \"" . $entity->getComplaintNumber() . "\" repair status has been set to \"sended\"");
    }

}
