<?php

namespace hcf\crate;

use pocketmine\item\Item;

class Reward {

    /** @var Item */
    private $item;

    /** @var callable */
    private $callback;

    /**
     * Reward constructor.
     *
     * @param Item $item
     * @param callable $callable
     */
    public function __construct(Item $item, callable $callable) {
        $this->item = $item;
        $this->callback = $callable;
    }

    /**
     * @return Item
     */
    public function getItem(): Item {
        return $this->item;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable {
        return $this->callback;
    }
}