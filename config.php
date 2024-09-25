<?php
require_once('icons.php');

$device = array(
  'node' => 'indicator1',
  'banner' => 'StricklerHome',
);

$rows[] = array(
  'icon' => $icons['coach-lamp'],
  'label' => 'Front Porch Lights',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => 'switch.togglelinc_on_off_46_e4_15',
);

/*
$rows[] = array(
  'icon' => $icons['lamp'],
  'label' => 'Brenton Dresser Light',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => 'light.brenton_dresser',
);

$rows[] = array(
  'icon' => $icons['floor-lamp'],
  'label' => 'Office Lights',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => 'light.dining_room',
);
*/

$rows[] = array(
  'icon' => $icons['garage-variant'],
  'label' => 'Garage Door',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.garage_door',
);

$rows[] = array(
  'icon' => $icons['outdoor-lamp'],
  'label' => 'Driveway Light',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => 'switch.togglelinc_on_off_46_e5_13',
);

$rows[] = array(
  'icon' => $icons['lightning-bolt'],
  'label' => 'Tesla Charger',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.tesla_wall_connector_status',
);

$rows[] = array(
  'icon' => $icons['trash-can-outline'],
  'label' => 'Trash Service',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.garbage_pickup_desc',
);

$rows[] = array(
  'icon' => $icons['recycle-variant'],
  'label' => 'Recycling Service',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.recycling_pickup_desc',
);

/*
$rows[] = array(
  'icon' => $icons['thermometer'],
  'label' => 'Living Room Temp',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.downstairs_temperature',
  'format' => '%s°F',
);

$rows[] = array(
  'icon' => $icons['thermometer'],
  'label' => 'Upstairs Temp',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.upstairs_temperature',
  'format' => '%s°F',
);
*/
