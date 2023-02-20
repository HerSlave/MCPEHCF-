<?php

namespace hcf\crate;

use hcf\crate\types\AbilityCrate;
use hcf\crate\types\AncientCrate;
use hcf\crate\types\ExoticCrate;
use hcf\crate\types\MysteriousCrate;
use hcf\crate\types\RewardCrate;
use hcf\crate\types\UnknownCrate;
use hcf\HCF;
use pocketmine\level\Position;

class CrateManager {

    /** @var HCF */
    private $core;

    /** @var Crate[] */
    private $crates = [];

    /**
     * CrateManager constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        $core->getServer()->getPluginManager()->registerEvents(new CrateListener($core), $core);
        $this->init();
    }

    public function init() {
        $this->addCrate(new RewardCrate(new Position(-41, 70, 31, $this->core->getServer()->getDefaultLevel())));
        $this->addCrate(new MysteriousCrate(new Position(-38, 70, 34, $this->core->getServer()->getDefaultLevel())));
        $this->addCrate(new AncientCrate(new Position(-35, 70, 36, $this->core->getServer()->getDefaultLevel())));
        $this->addCrate(new ExoticCrate(new Position(-31, 70, 38, $this->core->getServer()->getDefaultLevel())));
        $this->addCrate(new UnknownCrate(new Position(-27, 70, 39, $this->core->getServer()->getDefaultLevel())));
        $this->addCrate(new AbilityCrate(new Position(-25, 70, 40, $this->core->getServer()->getDefaultLevel())));
    }

    /**
     * @return Crate[]
     */
    public function getCrates(): array {
        return $this->crates;
    }

    /**
     * @param string $identifier
     *
     * @return Crate|null
     */
    public function getCrate(string $identifier): ?Crate {
        return isset($this->crates[$identifier]) ? $this->crates[$identifier] : null;
    }

    /**
     * @param Crate $crate
     */
    public function addCrate(Crate $crate) {
        $this->crates[$crate->getName()] = $crate;
    }
}