<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ServiceBundle;

/**
 * Description of ServiceEvents
 *
 * @author michal
 */
class ServiceEvents {
    const BRAND_ADDED = 'brand.added';
    const BRAND_EDITED = 'brand.edited';
    const BRAND_DELETED = 'brand.deleted';
    
    const CLIENT_ADDED = 'client.added';
    const CLIENT_EDITED = 'client.edited';
    const CLIENT_DELETED = 'client.deleted';
    
    const MACHINE_ADDED = 'machine.added';
    const MACHINE_EDITED = 'machine.edited';
    const MACHINE_DELETED = 'machine.deleted';
    const MACHINE_SEND = 'machine.sent';
    
    const MODEL_ADDED = 'model.added';
    const MODEL_EDITED = 'model.edited';
    const MODEL_DELETED = 'model.deleted';
    
    const REPAIR_STATUS_ADDED = 'repair_status.added';
    const REPAIR_STATUS_EDITED = 'repair_status.edited';
    const REPAIR_STATUS_DELETED = 'repair_status.deleted';
    
    const TYPE_ADDED = 'type.added';
    const TYPE_EDITED = 'type.edited';
    const TYPE_DELETED = 'type.deleted';

}
