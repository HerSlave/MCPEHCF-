<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class DepositSubCommand extends SubCommand {

    /**
     * DepositSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("deposit", "/faction deposit <amount>", ["d"]);
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
        if($sender->getFaction() === null) {
            $sender->sendMessage(Translation::getMessage("beInFaction"));
            return;
        }
        if(!isset($args[1])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        if($args[1] === "all") {
            $amount = $sender->getBalance();
        }
        else {
            $amount = (int)$args[1];
        }
        if(!is_numeric($amount)) {
            $sender->sendMessage(Translation::getMessage("notNumeric"));
            return;
        }
        $amount = max(0, $amount);
        if($sender->getBalance() < $amount) {
            $sender->sendMessage(Translation::getMessage("notEnoughMoney"));
            return;
        }
        $sender->subtractFromBalance($amount);
        $sender->getFaction()->addMoney($amount);
        foreach($sender->getFaction()->getOnlineMembers() as $member) {
            $member->sendMessage(Translation::getMessage("deposit", [
                "name" => TextFormat::GREEN . $sender->getName(),
                "amount" => TextFormat::LIGHT_PURPLE . "$$amount"
            ]));
        }
    }
}