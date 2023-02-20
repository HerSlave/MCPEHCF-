<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Ghast extends Monster {

    /** @var int */
    public const NETWORK_ID = self::GHAST;

    /** @var float */
    public $width = 2;

    /** @var float */
    public $height = 2;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Ghast";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::GHAST_TEAR, 0, mt_rand(0, 1))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}