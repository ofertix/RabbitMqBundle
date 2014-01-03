<?php

namespace OldSound\RabbitMqBundle\RabbitMq;

use OldSound\RabbitMqBundle\RabbitMq\BaseAmqp;
use PhpAmqpLib\Message\AMQPMessage;

class Producer extends BaseAmqp
{
    protected $contentType = 'text/plain';
    protected $deliveryMode = 2;
    protected $appId = null;
    protected $type = null;

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function setDeliveryMode($deliveryMode)
    {
        $this->deliveryMode = $deliveryMode;

        return $this;
    }

    public function setAppId($appId)
    {
        $this->appId = $appId;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function publish($msgBody, $routingKey = '')
    {
        if ($this->autoSetupFabric) {
            $this->setupFabric();
        }

        $msg = new AMQPMessage($msgBody, array('content_type' => $this->contentType, 'delivery_mode' => $this->deliveryMode,'app_id' => $this->appId,'type' => $this->appId));
        $this->getChannel()->basic_publish($msg, $this->exchangeOptions['name'], $routingKey);
    }
}
