<?php

namespace nightvision;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->notice("Le plugin a bien été lancé !");
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $commandname = $command->getName();
        if ($commandname === "nightvision") {
            if ($sender instanceof Player) {
                if ($sender->getEffects()->has(VanillaEffects::NIGHT_VISION())) {
                    $sender->getEffects()->remove(VanillaEffects::NIGHT_VISION());
                    $sender->sendMessage("§l§6> §r§fVous n'avez désormais plus l'éffet de Night Vision !");
                } else {
                    $effect = new EffectInstance(VanillaEffects::NIGHT_VISION(), 20 * 10000,0, false);
                    $sender->getEffects()->add($effect);
                    $sender->sendMessage("§l§6> §r§fVous avez désormais l'éffet de Night Vision !");
                }
            }
        }
        return true;
    }
}