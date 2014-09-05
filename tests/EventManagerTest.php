<?php


use Nam\EventDispatcher\BlogPublisher;
use Nam\EventDispatcher\EventManager;

class EventManagerTest extends PHPUnit_Framework_TestCase
{

    public function testItCanDispatchEventOccur()
    {
        $eventManager = new EventManager;
        $eventManager->listen(
            'blog_title_update',
            function (BlogPublisher $blog) {
                echo $blog->getTitle();
            }
        );

        $blog = new BlogPublisher($eventManager);
        $blog->setTitle('The Title Changed');

        $this->expectOutputRegex('/The Title Changed/');
    }
}
 