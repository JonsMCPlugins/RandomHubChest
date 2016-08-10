<?php

namespace envoys;

use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\inventory\Inventory;
use pocketmine\tile\Chest;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\block\Block;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\inventory\InventoryOpenEvent;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\item\Item;

class ChestSpawn extends PluginBase implements Listener
{
           public function onEnable() {
        @mkdir($this->getDataFolder());
        $this->config = (new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
        "apply-for-world" => "world",
        "items" => array("264")
        )));
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("All has loaded");
        }
       
        public function onDisable() {
        $this->getLogger()->info("Stopped");
        $this->config->save();
        }
       
           public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
           $world = $this->getServer()->getLevelByName("world");
           $x = mt_rand(1673,1770);
           $z = mt_rand(-20,85);
           $y = 90;
           
            if(($command->getName()) == "chest") {
            
           if($sender->hasPermission("envoys.chest")) {
           $pos = new Vector3($x, $y, $z, $world);
           
           $world->setBlock($pos, Block::get(54,0));
           $chest = $world->getTile($pos);
           $slot = 0;
           $item = $this->config->get("items");
           if($chest instanceof Chest) {
             $chest->getInventory()->setItem($slot, Item::get($item));
           }
             $sender->sendMessage(TextFormat::GREEN ."New Chest spawn at ". $x .":". $y .":". $z);
             $this->getServer()->broadcastMessage(TextFormat::BLUE ."New Chest Spawn at Lobby, go look for it!");
             } else {
             $sender->sendMessage("You dont have permission");
             }
          }
        }
           
    }
