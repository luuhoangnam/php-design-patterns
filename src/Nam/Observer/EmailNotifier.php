<?php


namespace Nam\Observer;


class EmailNotifier implements ProductObserver
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

        echo "New Price: $newPrice\n";
    }
}