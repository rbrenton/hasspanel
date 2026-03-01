# hasspanel

Generate configuration files for [OpenHASP](https://www.openhasp.com/) (JSONL) and [Home Assistant](https://www.home-assistant.io/) (YAML) from a single PHP configuration file.

Designed for use with the [SenseCAP Indicator D1](https://www.seeedstudio.com/SenseCAP-Indicator-D1-p-5643.html) (480x480px display) running [openHASP firmware](https://github.com/HASwitchPlate/openHASP/releases).

## Requirements

- PHP 7.4 or higher (CLI)
- OpenHASP device with firmware installed
- Home Assistant with OpenHASP integration

## Installation

```bash
git clone https://github.com/yourusername/hasspanel.git
cd hasspanel
```

## Usage

### 1. Configure your panel

Copy the example configuration and customize it:

```bash
cp config.example.php config.php
```

Edit `config.php` to define your device and entities:

```php
<?php
require_once('icons.php');
require_once('util.php');

// Panel identification
$device = array(
  'node' => 'your_panel_name',    // OpenHASP device name
  'banner' => 'Your Home Panel',  // Header text displayed on panel
);

// Define switches (toggleable entities)
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => '%2%',
], array(
  [ 'lightbulb', 'Living Room', 'switch.living_room_light' ],
  [ 'ceiling-light', 'Kitchen', 'light.kitchen' ],
));

// Define sensors (read-only text display)
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => '%2%',
], array(
  [ 'thermometer', 'Temperature', 'sensor.indoor_temperature' ],
  [ 'water-percent', 'Humidity', 'sensor.indoor_humidity' ],
));
```

### 2. Generate configuration files

Generate the OpenHASP JSONL file (upload to your device):

```bash
php genhasp.php > pages.jsonl
```

Generate the Home Assistant YAML (add to your HA configuration):

```bash
php genhass.php > openhasp.yaml
```

### 3. Deploy

1. Upload `pages.jsonl` to your OpenHASP device via its web interface
2. Add the contents of `openhasp.yaml` to your Home Assistant configuration
3. Restart Home Assistant

## Available Icons

See `icons.php` for a full list of available icons. Common icons include:

| Icon Name | Use Case |
|-----------|----------|
| `lightbulb` | General lights |
| `ceiling-light` | Ceiling fixtures |
| `outdoor-lamp` | Outdoor lighting |
| `thermometer` | Temperature sensors |
| `door-closed` | Door sensors |
| `garage-variant` | Garage doors |
| `fan` | Fan controls |
| `power-plug` | Smart plugs |

## Entity Types

### Switch
Interactive toggle for `switch.*` and `light.*` entities:
```php
'type' => 'switch'
```

### Text
Read-only display for sensors:
```php
'type' => 'text',
'format' => '%s°F',  // Optional format string
```

## File Structure

```
hasspanel/
├── config.php          # Your panel configuration
├── config.example.php  # Example configuration
├── common.php          # Layout engine and object generation
├── genhasp.php         # OpenHASP JSONL generator
├── genhass.php         # Home Assistant YAML generator
├── icons.php           # Icon name to Unicode mapping
├── util.php            # Utility functions
└── README.md
```

## License

MIT
