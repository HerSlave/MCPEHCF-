<?php

namespace hcf\entity\mob;

use pocketmine\entity\Monster;
use pocketmine\item\Item;
use pocketmine\nbt\tag\IntTag;

class Rabbit extends Monster {

    /** @var int */
    public const NETWORK_ID = self::RABBIT;

    const TAG_RABBIT_TYPE = 18;

    /** @var float */
    public $width = 0.4;

    /** @var float */
    public $height = 0.5;

    public function initEntity(): void {
        parent::initEntity();
        if(!$this->namedtag->hasTag(self::TAG_RABBIT_TYPE, IntTag::class)){
            $this->namedtag->setInt(self::TAG_RABBIT_TYPE, 0);
        }
        $this->getDataPropertyManager()->setByte(self::TAG_RABBIT_TYPE, 0);
        $this->setMaxHealth(20);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Rabbit";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::RABBIT_FOOT, 0, mt_rand(0, 1))
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return mt_rand(3, 8);
    }
}