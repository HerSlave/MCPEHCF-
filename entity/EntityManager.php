<?php

namespace hcf\entity;

use hcf\entity\mob\Blaze;
use hcf\entity\mob\CaveSpider;
use hcf\entity\mob\Cow;
use hcf\entity\mob\Creeper;
use hcf\entity\mob\Enderman;
use hcf\entity\mob\Ghast;
use hcf\entity\mob\Rabbit;
use hcf\entity\mob\Skeleton;
use hcf\entity\mob\Slime;
use hcf\HCF;
use pocketmine\entity\Entity;

class EntityManager {

    /** @var HCF */
    private $core;

    /**
     * EntityManager constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        $this->init();
    }

    public function init() {
        Entity::registerEntity(Blaze::class);
        Entity::registerEntity(CaveSpider::class);
        Entity::registerEntity(Cow::class);
        Entity::registerEntity(Creeper::class);
        Entity::registerEntity(Enderman::class);
        Entity::registerEntity(Ghast::class);
        Entity::registerEntity(Rabbit::class);
        Entity::registerEntity(Skeleton::class);
        Entity::registerEntity(Slime::class);
    }
}