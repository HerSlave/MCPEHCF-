<?php

namespace hcf\area;

use pocketmine\level\Level;
use pocketmine\level\Position;

class Area {

    /** @var string */
    private $name;

    /** @var Position */
    private $firstPosition;

    /** @var Position */
    private $secondPosition;

    /** @var bool */
    private $pvpFlag;

    /** @var bool */
    private $editFlag;

    /** @var Level|null */
    private $level;

    /**
     * Area constructor.
     *
     * @param string $name
     * @param Position $firstPosition
     * @param Position $secondPosition
     * @param bool $pvpFlag
     * @param bool $editFlag
     *
     * @throws AreaException
     */
    public function __construct(string $name, Position $firstPosition, Position $secondPosition, bool $pvpFlag, bool $editFlag) {
        $this->firstPosition = $firstPosition;
        $this->secondPosition = $secondPosition;
        $this->name = $name;
        $this->level = $firstPosition->getLevel()->getName() === $secondPosition->getLevel()->getName() ? $firstPosition->getLevel() : null;
        if($this->level === null) {
            throw new AreaException("Area \"$name\"'s first position's level does not equal the second position's level.");
        }
        $this->pvpFlag = $pvpFlag;
        $this->editFlag = $editFlag;
    }

    /**
     * @param Position $position
     *
     * @return bool
     */
    public function isPositionInside(Position $position): bool {
        $level = $position->getLevel();
        $firstPosition = $this->firstPosition;
        $secondPosition = $this->secondPosition;
        $minX = min($firstPosition->getX(), $secondPosition->getX());
        $maxX = max($firstPosition->getX(), $secondPosition->getX());
        $minY = min($firstPosition->getY(), $secondPosition->getY());
        $maxY = max($firstPosition->getY(), $secondPosition->getY());
        $minZ = min($firstPosition->getZ(), $secondPosition->getZ());
        $maxZ = max($firstPosition->getZ(), $secondPosition->getZ());
        return $minX <= $position->getX() and $maxX >= $position->getFloorX() and $minY <= $position->getY() and
            $maxY >= $position->getY() and $minZ <= $position->getZ() and $maxZ >= $position->getFloorZ() and
            $this->level->getName() === $level->getName();
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

    /**
     * @return Level
     */
    public function getLevel(): Level {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getPvpFlag(): bool {
        return $this->pvpFlag;
    }

    /**
     * @return bool
     */
    public function getEditFlag(): bool {
        return $this->editFlag;
    }
}