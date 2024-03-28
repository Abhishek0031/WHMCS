<?php

namespace WHMCS\Module\Addon\agency_dashboard_pro\Admin;

use WHMCS\Module\Addon\agency_dashboard_pro\Admin\Controller;

class AdminDispatcher {
    public function dispatch($action, $vars)
    {
        
        if (!$action) {
            // Default to index if no action specified
            $action = 'index';
        }
        
        $controller = new Controller($vars);
        if (is_callable(array($controller, $action))) {
            return $controller->$action($vars);
        }

        return '<p>Invalid action requested. Please go back and try again.</p>';
    }
}