<?php

namespace WHMCS\Module\Addon\TicketTag\Admin;

use WHMCS\Module\Addon\TicketTag\Admin\Controller;

/**
 * Sample Admin Area Dispatch Handler
 */
class AdminDispatcher {

    /**
     * Dispatch request.
     *
     * @param string $action
     * @param array $parameters
     *
     * @return string
     */
    public function dispatch($action, $parameters)
    {

        
        $controller = new Controller();

        // Verify requested action is valid and callable
        if (is_callable(array($controller, $action))) {
            return $controller->$action($parameters);
        }

        return '<p>Invalid action requested. Please go back and try again.</p>';
    }
}