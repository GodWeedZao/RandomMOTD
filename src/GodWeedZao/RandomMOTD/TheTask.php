<?php

namespace GodWeedZao\RandomMOTD;
/*
██████╗░░█████╗░███╗░░██╗██████╗░░█████╗░███╗░░░███╗  ███╗░░░███╗░█████╗░████████╗██████╗░
██╔══██╗██╔══██╗████╗░██║██╔══██╗██╔══██╗████╗░████║  ████╗░████║██╔══██╗╚══██╔══╝██╔══██╗
██████╔╝███████║██╔██╗██║██║░░██║██║░░██║██╔████╔██║  ██╔████╔██║██║░░██║░░░██║░░░██║░░██║
██╔══██╗██╔══██║██║╚████║██║░░██║██║░░██║██║╚██╔╝██║  ██║╚██╔╝██║██║░░██║░░░██║░░░██║░░██║
██║░░██║██║░░██║██║░╚███║██████╔╝╚█████╔╝██║░╚═╝░██║  ██║░╚═╝░██║╚█████╔╝░░░██║░░░██████╔╝
╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚══╝╚═════╝░░╚════╝░╚═╝░░░░░╚═╝  ╚═╝░░░░░╚═╝░╚════╝░░░░╚═╝░░░╚═════╝░
*/

use GodWeedZao\RandomMOTD\Main;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class TheTask extends Task
{
    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun($currentTick)
    {
        $allMessages = $this->plugin->settings->get("Messages");
        $Network = Server::getInstance()->getNetwork();
        if (in_array($Network->getName(), $allMessages)) {
            $messageNumber = array_search($Network->getName(), $allMessages);
            $Network->setName($allMessages[$messageNumber + 1] ?? $allMessages[0]);
        } else {
            $Network->setName($allMessages[0]);
        }
    }
}