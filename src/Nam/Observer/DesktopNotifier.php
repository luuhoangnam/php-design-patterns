<?php


namespace Nam\Observer;


class DesktopNotifier implements ProductObserver
{

    /**
     * @var ProductSubject
     */
    private $subject;

    public function __construct(ProductSubject $subject)
    {
        $this->subject = $subject;
    }

    public function update()
    {
        $newPrice = $this->subject->getPrice();

        echo "Desktop Notification Pop-up: New Price: $newPrice\n";
    }
}