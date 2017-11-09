<?php

/**
 * Mediator pattern is used to reduce communication complexity between multiple 
 * objects or classes. This pattern provides a mediator class which normally 
 * handles all the communications between different classes and supports easy 
 * maintenance of the code by loose coupling. Mediator pattern falls under 
 * behavioral pattern category.
 */
/**
 * We are demonstrating mediator pattern by example of a chat room where 
 * multiple users can send message to chat room and it is the responsibility 
 * of chat room to show the messages to all users. We have created two classes 
 * ChatRoom and User. User objects will use ChatRoom method to share their 
 * messages.
 */

namespace DesignPatterns\Behavioral\Mediator;

use DesignPatterns\Behavioral\Mediator\Colleague;

/**
 * Abstraction for AbstractChatroom
 */
abstract class MediatorAbstract
{

    abstract function register(Colleague ...$participant);

    abstract function send(Colleague $from, Colleague $to, string $message);
}