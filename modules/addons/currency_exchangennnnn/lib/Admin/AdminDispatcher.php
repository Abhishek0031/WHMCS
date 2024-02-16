<?php

namespace WHMCS\Module\Addon\currency_exchange\Admin;

use WHMCS\Module\Addon\currency_exchange\Admin\Controller;

class AdminDispatcher {
    public function dispatch($action, $vars)
    {
        $controller = new Controller($vars);
        if (is_callable(array($controller, $action))) {
            return $controller->$action($vars);
        }

        return '<p>Invalid action requested. Please go back and try again.</p>';
    }
}