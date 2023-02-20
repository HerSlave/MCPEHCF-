<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Creeper extends Monster {

    /** @var int */
    public const NETWORK_ID = self::CREEPER;

    /** @var float */
    public $width = 0.6;

    /** @var float */
    public $height = 1.7;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Creeper";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::GUNPOWDER, 0, mt_rand(0, 1))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}