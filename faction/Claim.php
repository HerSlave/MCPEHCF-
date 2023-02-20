<?php

namespace hcf\faction;

use hcf\HCF;
use hcf\HCFPlayer;
use pocketmine\level\Level;
use pocketmine\level\Position;

class Claim {

    /** @var Faction */
    private $faction;

    /** @var Position */
    private $firstPosition;

    /** @var Position */
    private $secondPosition;

    /** @var string[] */
    private $chunkHashes = [];

    /**
     * Claim constructor.
     *
     * @param Faction $faction
     * @param Position $firstPosition
     * @param Position $secondPosition
     */
    public function __construct(Faction $faction, Position $firstPosition, Position $secondPosition) {
        $this->firstPosition = $firstPosition;
        $this->secondPosition = $secondPosition;
        $firstPosition = $this->firstPosition;
        $secondPosition = $this->secondPosition;
        $minX = min($firstPosition->getX(), $secondPosition->getX());
        $maxX = max($firstPosition->getX(), $secondPosition->getX());
        $minZ = min($firstPosition->getZ(), $secondPosition->getZ());
        $maxZ = max($firstPosition->getZ(), $secondPosition->getZ());
        $this->faction = $faction;
        for($x = $minX; ($x - $maxX) <= 16; $x += 16) {
            for($z = $minZ; ($z - $maxZ) <= 16; $z += 16) {
                $this->chunkHashes[] = Level::chunkHash($x >> 4, $z >> 4);
            }
        }
    }

    /**
     * @return string[]
     */
    public function getChunkHashes(): array  {
        return $this->chunkHashes;
    }

    /**
     * @param Position $position
     *
     * @return bool
     */
    public function isInClaim(Position $position): bool {
        $level = $position->getLevel();
        $firstPosition = $this->firstPosition;
        $secondPosition = $this->secondPosition;
        $minX = min($firstPosition->getX(), $secondPosition->getX());
        $maxX = max($firstPosition->getX(), $secondPosition->getX());
        $minY = 0;
        $maxY = Level::Y_MAX;
        $minZ = min($firstPosition->getZ(), $secondPosition->getZ());
        $maxZ = max($firstPosition->getZ(), $secondPosition->getZ());
        return $minX <= $position->getX() and $maxX >= $position->getFloorX() and $minY <= $position->getY() and
            $maxY >= $position->getY() and $minZ <= $position->getZ() and $maxZ >= $position->getFloorZ() and
            $level->getName() === HCF::getInstance()->getServer()->getDefaultLevel()->getFolderName() ? true : false;
    }

    /**
     * @param Position $firstPosition
     * @param Position $secondPosition
     * @param float $epsilon
     *
     * @return bool
     */
    public function intersectsWith(Position $firstPosition, Position $secondPosition, float $epsilon = 0.00001) : bool{
        $minX = min($this->firstPosition->getFloorX(), $this->secondPosition->getFloorX());
        $maxX = max($this->firstPosition->getFloorX(), $this->secondPosition->getFloorX());
        $minY = 0;
        $maxY = Level::Y_MAX;
        $minZ = min($this->firstPosition->getFloorZ(), $this->secondPosition->getFloorZ());
        $maxZ = max($this->firstPosition->getFloorZ(), $this->secondPosition->getFloorZ());
        if(max($firstPosition->getFloorX(), $secondPosition->getFloorX()) - $minX > $epsilon and $maxX - min($firstPosition->getFloorX(), $secondPosition->getFloorX()) > $epsilon){
            if(max($firstPosition->getFloorY(), $secondPosition->getFloorY()) - $minY > $epsilon and $maxY - min($firstPosition->getFloorY(), $secondPosition->getFloorY()) > $epsilon){
                return max($firstPosition->getFloorZ(), $secondPosition->getFloorZ()) - $minZ > $epsilon and $maxZ - min($firstPosition->getFloorZ(), $secondPosition->getFloorZ()) > $epsilon;
            }
        }
        return false;
    }

    /**
     * @param HCFPlayer $player
     *
     * @return bool
     */
    public function canAccess(HCFPlayer $player): bool {
        if($player->getFaction() === null) {
            return false;
        }
        return $player->getFaction()->getName() === $this->faction->getName() or $this->faction->isAlly($player->getFaction()) ?? false;
    }

    /**
     * @return Faction
     */
    public function getFaction(): Faction {
        return $this->faction;
    }

    /**
     * @return Position
     */
    public function getFirstPosition(): Position {
        return $this->firstPosition;
    }

    /**
     * @return Position
     */
    public function getSecondPosition(): Position {
        return $this->secondPosition;
    }
}
