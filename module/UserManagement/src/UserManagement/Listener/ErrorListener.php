<?php

namespace UserManagement\Listener;

use Zend\View\Model\JsonModel;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class ErrorListener extends AbstractListenerAggregate
{

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError']);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER_ERROR, [$this, 'onRenderError']);

        return $this;
    }

    public function onDispatchError($e)
    {
        return $this->getJsonModelError($e);
    }

    public function onRenderError($e)
    {
        return $this->getJsonModelError($e);
    }

    /**
     * Manages error's and return response_code and error message
     *
     * @param type $e
     * @return JsonModel
     */
    public function getJsonModelError($e)
    {
        $error = $e->getError();

        if (!$error) {
            return;
        }

        $exception = $e->getParam('exception');
        $exceptionJson = [];

        if ($exception) {
            $exceptionJson = [
                'message' => $exception->getMessage(),
            ];
        }

        $errorJson = [
            'message' => 'An error occurred during execution; please try again later.',
            'error' => $error,
            'exception' => $exceptionJson,
        ];

        if ($error == 'error-router-no-match') {
            $errorJson['message'] = 'Resource not found.';
        }

        $model = new JsonModel(['code' => 400, 'data' => [$errorJson]]);
        $e->setResult($model);

        return $model;
    }
}
