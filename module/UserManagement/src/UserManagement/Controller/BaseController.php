<?php

namespace UserManagement\Controller;

use UserManagement\Exception\ExceptionInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;

abstract class BaseController extends AbstractActionController
{
    /**
     *
     * @param MvcEvent $event
     * @return JsonModel
     * @throws \RuntimeException
     */
    public function onDispatch(MvcEvent $event)
    {
        try {
            $allowedMethods = $this->params()->fromRoute('allowed-methods', []);
            $request = $this->getRequest();

            if (!in_array($request->getMethod(), $allowedMethods)) {
                throw new \RuntimeException('The request method is not allowed.');
            }
            return parent::onDispatch($event);
        } catch (ExceptionInterface $e) {
            return $this->handleException($event, $e->getMessage());
        }
    }

    /**
     * Parse error messages from InputFilter
     *
     * @param InputFilter $filter
     */
    protected function parseFilterError(InputFilter $filter)
    {
        $errorMessage = [];

        foreach ($filter->getMessages() as $inputName => $errors) {
            foreach ($errors as $field => $message) {
                $errorMessage[] = $message;
            }
        }

        return implode(',', $errorMessage);
    }

    /**
     *
     * @param MvcEvent $event
     * @param type $message
     * @return type
     */
    private function handleException(MvcEvent $event, $message)
    {
        $result = new JsonModel(['code' => 400, 'data' => $message]);;
        $event->setResult($result);
        $event->getResponse()->setStatusCode(400);

        return $result;
    }
}
