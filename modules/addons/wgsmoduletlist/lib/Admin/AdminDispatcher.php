<?php

namespace WHMCS\Module\Addon\wgsmoduletlist\Admin;

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
       
        
        if ($action == 'index') {
            // Default to index if no action specified
            $action = 'index';
        }
        elseif($action == 'setting' || $action == 'savenotes')
        {
            $action = 'setting';
        } elseif($action == 'pro_dashboard_setting')
        {
            $action = 'pro_dashboard_setting';
        }

        $controller = new Controller();

        // Verify requested action is valid and callable
        if (is_callable(array($controller, $action))) {
            return $controller->$action($parameters);
        }

        return '<p>Invalid action requested. Please go back and try again.</p>';
    }
}
