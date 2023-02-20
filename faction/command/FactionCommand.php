<?php

namespace hcf\faction\command;

use hcf\command\utils\Command;
use hcf\faction\command\subCommands\AllySubCommand;
use hcf\faction\command\subCommands\AnnounceSubCommand;
use hcf\faction\command\subCommands\ChatSubCommand;
use hcf\faction\command\subCommands\ClaimSubCommand;
use hcf\faction\command\subCommands\CreateSubCommand;
use hcf\faction\command\subCommands\DemoteSubCommand;
use hcf\faction\command\subCommands\DepositSubCommand;
use hcf\faction\command\subCommands\DisbandSubCommand;
use hcf\faction\command\subCommands\HelpSubCommand;
use hcf\faction\command\subCommands\HomeSubCommand;
use hcf\faction\command\subCommands\InfoSubCommand;
use hcf\faction\command\subCommands\InviteSubCommand;
use hcf\faction\command\subCommands\JoinSubCommand;
use hcf\faction\command\subCommands\KickSubCommand;
use hcf\faction\command\subCommands\LeaderSubCommand;
use hcf\faction\command\subCommands\LeaveSubCommand;
use hcf\faction\command\subCommands\ListSubCommand;
use hcf\faction\command\subCommands\PromoteSubCommand;
use hcf\faction\command\subCommands\SetHomeSubCommand;
use hcf\faction\command\subCommands\StuckSubCommand;
use hcf\faction\command\subCommands\TopSubCommand;
use hcf\faction\command\subCommands\UnallySubCommand;
use hcf\faction\command\subCommands\UnclaimSubCommand;
use hcf\faction\command\subCommands\WhoSubCommand;
use hcf\faction\command\subCommands\WithdrawSubCommand;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;

class FactionCommand extends Command {

    /**
     * FactionCommand constructor.
     */
    public function __construct() {
        parent::__construct("faction", "Manage faction", "/faction help <1-5>", ["f"]);
        $this->addSubCommand(new AllySubCommand());
        $this->addSubCommand(new AnnounceSubCommand());
        $this->addSubCommand(new ChatSubCommand());
        $this->addSubCommand(new ClaimSubCommand());
        $this->addSubCommand(new CreateSubCommand());
        $this->addSubCommand(new DemoteSubCommand());
        $this->addSubCommand(new DepositSubCommand());
        $this->addSubCommand(new DisbandSubCommand());
        $this->addSubCommand(new HelpSubCommand());
        $this->addSubCommand(new HomeSubCommand());
        $this->addSubCommand(new InfoSubCommand());
        $this->addSubCommand(new InviteSubCommand());
        $this->addSubCommand(new JoinSubCommand());
        $this->addSubCommand(new KickSubCommand());
        $this->addSubCommand(new LeaderSubCommand());
        $this->addSubCommand(new LeaveSubCommand());
        $this->addSubCommand(new ListSubCommand());
        $this->addSubCommand(new PromoteSubCommand());
        $this->addSubCommand(new SetHomeSubCommand());
        $this->addSubCommand(new StuckSubCommand());
        $this->addSubCommand(new TopSubCommand());
        $this->addSubCommand(new UnallySubCommand());
        $this->addSubCommand(new UnclaimSubCommand());
        $this->addSubCommand(new WhoSubCommand());
        $this->addSubCommand(new WithdrawSubCommand());
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(isset($args[0])) {
            $subCommand = $this->getSubCommand($args[0]);
            if($subCommand !== null) {
                $subCommand->execute($sender, $commandLabel, $args);
                return;
            }
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        $sender->sendMessage(Translation::getMessage("usageMessage", [
            "usage" => $this->getUsage()
        ]));
        return;
    }
}