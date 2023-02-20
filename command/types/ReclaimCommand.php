<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\crate\Crate;
use hcf\groups\Group;
use hcf\HCFPlayer;
use hcf\item\types\CrateKey;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ReclaimCommand extends Command {

    /**
     * ReclaimCommand constructor.
     */
    public function __construct() {
        parent::__construct("reclaim", "Reclaim rewards for each season.");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if($sender->hasReclaimed()) {
            $sender->sendMessage(Translation::getMessage("alreadyReclaimed"));
            return;
        }
        switch($sender->getGroup()->getIdentifier()) {
            case Group::PLAYER:
                $sender->sendMessage(Translation::getMessage("noPermission"));
                return;
                break;
            case Group::JUNIOR:
                $sender->addLives(3);
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::MYSTERIOUS)))->setCount(3));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::ANCIENT)))->setCount(1));
                break;
            case Group::GRAND:
                $sender->addLives(5);
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::MYSTERIOUS)))->setCount(5));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::ANCIENT)))->setCount(3));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::EXOTIC)))->setCount(1));
                break;
            case Group::PRIME:
                $sender->addLives(8);
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::MYSTERIOUS)))->setCount(8));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::ANCIENT)))->setCount(5));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::EXOTIC)))->setCount(3));
                break;
            case Group::PRIMAL:
                $sender->addLives(10);
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::MYSTERIOUS)))->setCount(10));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::ANCIENT)))->setCount(8));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::EXOTIC)))->setCount(5));
                break;
            default:
                $sender->addLives(15);
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::MYSTERIOUS)))->setCount(12));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::ANCIENT)))->setCount(10));
                $sender->getInventory()->addItem((new CrateKey($this->getCore()->getCrateManager()->getCrate(Crate::EXOTIC)))->setCount(8));
                break;
        }
        $sender->setReclaimed();
        $sender->getServer()->broadcastMessage(Translation::getMessage("reclaim", [
            "name" => TextFormat::GREEN . $sender->getName(),
            "rank" => $sender->getGroup()->getColoredName()

        ]));
        $sender->sendMessage(Translation::getMessage("lives", [
            "amount" => TextFormat::GREEN . $sender->getLives()
        ]));
    }
}