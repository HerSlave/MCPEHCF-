<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Skeleton extends Monster {

    /** @var int */
    public const NETWORK_ID = self::SKELETON;

    /** @var float */
    public $width = 0.6;

    /** @var float */
    public $height = 1.99;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Skeleton";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::BONE, 0, mt_rand(0, 2)),
            Item::get(Item::ARROW, 0, mt_rand(0, 2))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}