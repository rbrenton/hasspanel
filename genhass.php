<?php
require_once('common.php');

printf('%s:', $device['node']);
echo "\n";
printf('  objects:');
echo "\n";
foreach ($hass_objs as $arr) {
  if (!isset($arr['entity'])) continue;

  // https://www.openhasp.com/0.7.0/design/objects/

  // properties.val
  switch($arr['type']) {
  case 'switch':
  case 'btn':
    $arr['properties']['val'] = sprintf("'{{ 1 if states(\"%s\") == \"on\" else 0 }}'", $arr['entity']);
    break;
  default:
  }

  // properties.text
  switch ($arr['type']) {
  case 'btn':
    if (!isset($arr['on_value']) || !isset($arr['off_value'])) break;
    $arr['properties']['text'] = sprintf("'{{ \"%s\" if is_state(\"%s\", \"on\") else \"%s\" | e }}'", $arr['on_value'], $arr['entity'], $arr['off_value']);
    break;

  case 'text':
    $format = isset($arr['format']) ? $arr['format'] : '%s';
    $arr['properties']['text'] = sprintf("'%s'", sprintf($format, "{{ states(\"{$arr['entity']}\") }}"));
    break;

  default:
  }

  // events
  switch ($arr['type']) {
  case 'btn':
    $arr['event']['down'] = array(
      'service' => 'homeassistant.toggle',
      'entity_id' => $arr['entity'],
    );
    break;

  case 'switch':
    $arr['event']['down'] = array(
      'service' => 'homeassistant.toggle',
      'entity_id' => $arr['entity'],
    );
    break;

  default:
  }

  # obj
  printf('    - obj: "%s" # %s', $arr['field_id'], $arr['label']);
  echo "\n";

  # properties
  if (isset($arr['properties'])) {
	printf('      properties:');
    echo "\n";

	foreach ($arr['properties'] as $key => $value) {
	  printf("        %s: %s", $key, $value);
      echo "\n";
	}
  }

  # event
  if (isset($arr['event'])) {
	printf('      event:');
    echo "\n";

	foreach ($arr['event'] as $key => $values) {
	  printf('        "%s":', $key);
      echo "\n";

      $dash = '-';
	  foreach($values as $k => $v) {
		printf('          %s %s: %s', $dash, $k, $v);
        echo "\n";

        $dash = ' ';
	  }
	}
  }
}
