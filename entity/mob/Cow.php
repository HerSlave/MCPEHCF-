<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Cow extends Monster {

    /** @var int */
    public const NETWORK_ID = self::COW;

    /** @var float */
    public $width = 0.9;

    /** @var float */
    public $height = 1.3;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Cow";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::STEAK, 0, mt_rand(1, 3)),
            Item::get(Item::LEATHER, 0, mt_rand(0, 2)),
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}