<?php

namespace hcf\area;

use hcf\HCF;
use pocketmine\level\Position;

class AreaManager {

    /** @var HCF */
    private $core;

    /** @var Area[] */
    private $areas = [];

    /**
     * AreaManager constructor.
     *
     * @param HCF $core
     *
     * @throws AreaException
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        $core->getServer()->getPluginManager()->registerEvents(new AreaListener($core), $core);
        $this->init();
    }

    /**
     * @throws AreaException
     */
    public function init(): void {
        $this->addArea(new Area("Spawn", new Position(-64, 0, -69, $this->core->getServer()->getDefaultLevel()), new Position(97, 256, 105, $this->core->getServer()->getDefaultLevel()), false, false));
        $this->addArea(new Area("(750, 750) End Portal", new Position(748, 0, 748, $this->core->getServer()->getDefaultLevel()), new Position(752, 256, 752, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("(-750, 750) End Portal", new Position(-748, 0, 748, $this->core->getServer()->getDefaultLevel()), new Position(-752, 256, 752, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("(-750, -750) End Portal", new Position(-748, 0, -748, $this->core->getServer()->getDefaultLevel()), new Position(-752, 256, -752, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("(750, -750) End Portal", new Position(748, 0, -748, $this->core->getServer()->getDefaultLevel()), new Position(752, 256, -752, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("End Spawn", new Position(-273, 0, 74, $this->core->getServer()->getLevelByName("ender")), new Position(-281, 256, 82, $this->core->getServer()->getLevelByName("ender")), false, false));
        $this->addArea(new Area("Nether Spawn", new Position(-73, 0, 53, $this->core->getServer()->getLevelByName("nether")), new Position(-47, 256, 79, $this->core->getServer()->getLevelByName("nether")), false, false));
        $this->addArea(new Area("Greek KOTH", new Position(484, 0, -485, $this->core->getServer()->getDefaultLevel()), new Position(515, 256, -516, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("Ruins KOTH", new Position(481, 0, -483, $this->core->getServer()->getDefaultLevel()), new Position(512, 256, 514, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("Sakura KOTH", new Position(-485, 0, 484, $this->core->getServer()->getDefaultLevel()), new Position(-516, 256, 515, $this->core->getServer()->getDefaultLevel()), true, false));
        $this->addArea(new Area("Medieval KOTH", new Position(-508, 0, -510, $this->core->getServer()->getDefaultLevel()), new Position(-477, 256, -479, $this->core->getServer()->getDefaultLevel()), true, false));
    }

    /**
     * @param Area $area
     */
    public function addArea(Area $area): void {
        $this->areas[] = $area;
    }

    /**
     * @param Position $position
     *
     * @return Area[]|null
     */
    public function getAreasInPosition(Position $position): ?array {
        $areas = $this->getAreas();
        $areasInPosition = [];
        foreach($areas as $area) {
            if($area->isPositionInside($position) === true) {
                $areasInPosition[] = $area;
            }
        }
        if(empty($areasInPosition)) {
            return null;
        }
        return $areasInPosition;
    }

    /**
     * @return Area[]
     */
    public function getAreas(): array {
        return $this->areas;
    }
}