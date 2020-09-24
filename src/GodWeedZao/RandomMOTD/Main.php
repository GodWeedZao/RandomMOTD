<?php

declare(strict_types=1);

namespace GodWeedZao\RandomMOTD;
/*
██████╗░░█████╗░███╗░░██╗██████╗░░█████╗░███╗░░░███╗  ███╗░░░███╗░█████╗░████████╗██████╗░
██╔══██╗██╔══██╗████╗░██║██╔══██╗██╔══██╗████╗░████║  ████╗░████║██╔══██╗╚══██╔══╝██╔══██╗
██████╔╝███████║██╔██╗██║██║░░██║██║░░██║██╔████╔██║  ██╔████╔██║██║░░██║░░░██║░░░██║░░██║
██╔══██╗██╔══██║██║╚████║██║░░██║██║░░██║██║╚██╔╝██║  ██║╚██╔╝██║██║░░██║░░░██║░░░██║░░██║
██║░░██║██║░░██║██║░╚███║██████╔╝╚█████╔╝██║░╚═╝░██║  ██║░╚═╝░██║╚█████╔╝░░░██║░░░██████╔╝
╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚══╝╚═════╝░░╚════╝░╚═╝░░░░░╚═╝  ╚═╝░░░░░╚═╝░╚════╝░░░░╚═╝░░░╚═════╝░
*/

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{
    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->saveResource("Settings.yml");
        $this->settings = new Config($this->getDataFolder() . "Settings.yml", Config::YAML);
        if ($this->settings->get("start-working") == false) {
            $this->getServer()->getPluginManager()->disablePlugin($this);
            $this->getLogger()->notice("Plugin Disabled");
        }
        if ($this->isEnabled()) {
            $this->getScheduler()->scheduleRepeatingTask(new TheTask($this), $this->settings->get("RepeatTime") ?? 100);
        }
    }
    
    public function onDisable()
    {
        $this->settings->save();
    }
}
