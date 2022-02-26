# PortableCrafting

| Command | Permission | Default |
| --- | --- | --- |
| `/workbench` | `portablecrafting.command.workbench` | everyone |

[![](https://poggit.pmmp.io/shield.state/PortableCrafting)](https://poggit.pmmp.io/p/PortableCrafting)

## API
### Send crafting table window to a player
```php
/** @var Player $player */
PortableCrafting::WORKBENCH()->send($player);
```

### Handle opening portable crafting table window
```php
public functon onOpenWorkbench(OpenWorkbenchPortableCraftingEvent $event) : void{
	$event->getPlayer()->sendMessage("You can't launch /workbench in this region.");
	$event->cancel();
}
```
