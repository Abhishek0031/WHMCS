<?php

namespace WHMCS\Module\Addon\MyAddon\Client;

use WHMCS\Module\Addon\MyAddon\Client\Controller;

/**
 * Sample Client Area Dispatch Handler
 */
// include('Controller.php');


class ClientDispatcher {


    
    /**
     * Dispatch request.
     *
     * @param string $action
     * @param array $parameters
     *
     * @return array
     */
    public function dispatch($action, $parameters)
    {
        
        if (!$action) {
            // Default to index if no action specified
            $action = 'index';
        }
        
        $controller = new Controller();
        
        
        
        // Verify requested action is valid and callable
        if (is_callable(array($controller, $action))) {
            return $controller->$action($parameters);
        }
    }
}