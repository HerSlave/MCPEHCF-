<?php

namespace hcf\combat;

use hcf\combat\entity\LogoutVillager;
use hcf\HCF;
use pocketmine\entity\Entity;

class CombatManager {

    /** @var HCF */
    private $core;

    /**
     * CombatManager constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        Entity::registerEntity(LogoutVillager::class, true);
        $core->getServer()->getPluginManager()->registerEvents(new CombatListener($core), $core);
    }
}