<?php


use Nam\Observer\DesktopNotifier;
use Nam\Observer\HardDisk;
use Nam\Observer\EmailNotifier;

class ObserverTest extends PHPUnit_Framework_TestCase
{

    public function testItCanNotify()
    {
        $product      = new HardDisk;
        $mailNotifier = new EmailNotifier($product);
        $desktopNotifier = new DesktopNotifier($product);
        $product->register($mailNotifier);
        $product->register($desktopNotifier);

        $product->setPrice(6969);

        $this->expectOutputRegex('/New Price: 6969\nDesktop Notification Pop-up: New Price: 6969\n/');
    }
}
 