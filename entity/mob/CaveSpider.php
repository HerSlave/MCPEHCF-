<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class CaveSpider extends Monster {

    /** @var int */
    public const NETWORK_ID = self::CAVE_SPIDER;

    /** @var float */
    public $width = 1;

    /** @var float */
    public $height = 0.5;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Cave Spider";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::SPIDER_EYE, 0, mt_rand(0, 1))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}