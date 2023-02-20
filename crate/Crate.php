<?php

namespace hcf\crate;

use hcf\crate\task\AnimationTask;
use hcf\HCF;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use muqsit\invmenu\InvMenu;
use pocketmine\item\Item;
use pocketmine\level\Position;

abstract class Crate {

    const REWARD = "Reward";

    const MYSTERIOUS = "Mysterious";

    const ANCIENT = "Ancient";

    const EXOTIC = "Exotic";

    const UNKNOWN = "Summer";

    const ABILITY = "Ability";

    /** @var string */
    private $name;

    /** @var Position */
    private $position;

    /** @var Reward[] */
    private $rewards = [];

    /** @var InvMenu */
    private $inventory;

    /**
     * Crate constructor.
     *
     * @param string $name
     * @param Position $position
     * @param Reward[] $rewards
     */
    public function __construct(string $name, Position $position, array $rewards) {
        $this->name = $name;
        $this->position = $position;
        $this->rewards = $rewards;
        $this->inventory = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
        $this->inventory->setName($name . " Crate");
        $this->inventory->readonly();
        for($i = 0; $i <= $this->inventory->getInventory()->getDefaultSize() - 1; $i++) {
            $reward = Item::get(Item::STAINED_GLASS);
            if(!empty($rewards)) {
                $reward = array_shift($rewards)->getItem();
            }
            $this->inventory->getInventory()->setItem($i, $reward);
        }
    }

    /**
     * @param HCFPlayer $player
     */
    abstract public function spawnTo(HCFPlayer $player): void;

    /**
     * @param HCFPlayer $player
     */
    abstract public function despawnTo(HCFPlayer $player): void;

    /**
     * @param HCFPlayer $player
     *
     * @throws TranslationException
     */
    public function try(HCFPlayer $player): void {
        if($player->isRunningCrateAnimation() === true) {
            $player->sendMessage(Translation::getMessage("animationAlreadyRunning"));
            $player->knockBack($player, 0, $player->getX() - $this->position->getX(), $player->getZ() - $this->position->getZ(), 1);
            return;
        }
        if($player->getInventory()->getSize() - count($player->getInventory()->getContents()) < 5) {
            $player->sendMessage(Translation::getMessage("fullInventory"));
            $player->knockBack($player, 0, $player->getX() - $this->position->getX(), $player->getZ() - $this->position->getZ(), 1);
            return;
        }
        $item = $player->getInventory()->getItemInHand();
        $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
        HCF::getInstance()->getScheduler()->scheduleRepeatingTask(new AnimationTask($this, $player), 5);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position {
        return $this->position;
    }

    /**
     * @return Reward[]
     */
    public function getRewards(): array {
        return $this->rewards;
    }

    /**
     * @return InvMenu
     */
    public function getInventory(): InvMenu {
        return $this->inventory;
    }
}
