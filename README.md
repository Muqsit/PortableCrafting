# PortableCrafting

| Command | Permission | Default |
| --- | --- | --- |
| `/workbench` | `portablecrafting.command.workbench` | operators (/op) |

## API
### Send crafting table window to a player
```php
/** @var Player $player */
PortableCrafting::WORKBENCH()->send($player);
```
