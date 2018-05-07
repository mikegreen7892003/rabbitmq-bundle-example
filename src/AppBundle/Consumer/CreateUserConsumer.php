<?php
/**
 * Created by PhpStorm.
 * User: 37239
 * Date: 2018/5/5
 * Time: 15:32
 */

namespace AppBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

class CreateUserConsumer implements ConsumerInterface
{
    private $logger = null;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        $body = unserialize($msg->getBody());
        $this->logger->info("name: " . strval($body['name']));
        $this->logger->warning("age: " . strval($body['age']));
        return true;
    }
}