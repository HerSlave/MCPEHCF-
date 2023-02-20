<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Slime extends Monster {

    /** @var int */
    public const NETWORK_ID = self::SLIME;

    /** @var float */
    public $width = 2.04;

    /** @var float */
    public $height = 2.04;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Slime";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::SLIME_BALL, 0, mt_rand(1, 2))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}