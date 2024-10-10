<?php
$device = array(
  'node' => null,
  'banner' => null,
);

$rows = array();

require_once('icons.php');
require_once('util.php');
require_once('config.php');

$viewport_width = 480;
$viewport_height = 480;

$header_height = 60;
$row_height = 44;
$text_color = 'black';
$offset_x = 10;
$offset_y = 10;

$text_height = floor($row_height * 0.85);
$text_size = ceil($text_height / 2);

// font_size
$icon_size = $row_height - 2;
$label_size = $text_size;
$switch_size = null;
$value_size = $text_size;

// align
$icon_align = 1;
$label_align = 0;
$value_align = 2;

// color
$icon_color = $text_color;
$label_color = $text_color;
$switch_color = null;
$value_color = $text_color;

// w
$icon_width = $icon_size + 4;
$label_width = $viewport_width - $icon_width - $offset_x * 2;
$switch_width = floor($row_height * 1.7);
$value_width = $viewport_width - $offset_x * 2;

// h
$icon_height = $icon_size + 4;
$label_height = $text_height;
$switch_height = floor($row_height * 0.80);
$value_height = $text_height;

// x
$icon_offset_x = 0 + $offset_x;
$label_offset_x = $icon_offset_x + ceil($icon_width * 1.1);
$switch_offset_x = $viewport_width - $switch_width - $offset_x;
$value_offset_x = 0 + $offset_x;

// y
$icon_offset_y = 0 + $offset_y;
$label_offset_y = floor($row_height * 0.3) + $offset_y;
$value_offset_y = floor($row_height * 0.3) + $offset_y;
$switch_offset_y = floor($row_height * 0.1) + $offset_y;


// radius
$switch_radius = floor($row_height * 0.4); // slot
$switch_radius20 = floor($row_height * 0.4); // knob

$hasp_pages = array();
$hass_objs = array();

$id_offset = 10;
$id_step = 10;
$page_num = 1;
$y = $header_height;

$hasp_lines = array();
$hasp_lines[] = array(
  'page' => $page_num,
  'id' => 1,
  'obj' => 'btn',
  'x' => 0,
  'y' => 0,
  'w' => $viewport_width,
  'h' => $header_height,
  'text' => $device['banner'],
  'value_font' => 22,
  'bg_color' => '#2C3E50',
  'text_color' => '#FFFFFF',
  'radius' => 0,
  'border_side' => 0,
  'click' => 0
);
$hasp_lines[] = array(
  'page' => $page_num,
  'id' => 2,
  'obj' => 'obj',
  'x' => 0,
  'y' => $header_height,
  'w' => $viewport_width,
  'h' => $viewport_height - $header_height,
  'click' => 0
);


foreach ($rows as $i => $row) {
  $hass_obj = $row;

  // icon
  $id = $id_offset + 1;
  $hasp_lines[] = array(
    'page'  => $page_num,
    'id'    => $id,
    'obj'   => 'label',
    'x' => $icon_offset_x,
    'y' => $icon_offset_y + $y,
    'w' => $icon_width,
    'h' => $icon_height,
    'align' => $icon_align,
    'text_font' => $icon_size,
    'text_color'    => $icon_color,
    'text'  => ($row['icon']),
  );
  $hass_obj['icon_id'] = "p{$page_num}b{$id}";

  // label
  $id = $id_offset + 2;
  $hasp_lines[] = array(
    'page'  => $page_num,
    'id'    => $id,
    'obj'   => 'label',
    'x' => $label_offset_x,
    'y' => $label_offset_y + $y,
    'w' => $label_width,
    'h' => $label_height,
    'align' => $label_align,
    'text_font' => $label_size,
    'text_color'    => $label_color,
    'text'  => $row['label'],
  );
  $hass_obj['label_id'] = "p{$page_num}b{$id}";

  $id = $id_offset + 3;
  switch ($row['type']) {
  case 'switch':
    $hasp_lines[] = array(
      'page'  => $page_num,
      'id'    => $id,
      'obj'   => 'switch',
      'x' => $switch_offset_x,
      'y' => $switch_offset_y + $y,
      'w' => $switch_width,
      'h' => $switch_height,
      'radius' => $switch_radius,
      'radius20' => $switch_radius20,
    );
    $hass_obj['field_id'] = "p{$page_num}b{$id}";
    break;

  case 'text':
    $hasp_lines[] = array(
      'page'  => $page_num,
      'id'    => $id,
      'obj'   => 'label',
      'x' => $value_offset_x,
      'y' => $value_offset_y + $y,
      'w' => $value_width,
      'h' => $value_height,
      'align' => $value_align,
      'text_font' => $value_size,
      'text_color'    => $value_color,
      'text'  => $row['default'],
    );
    $hass_obj['field_id'] = "p{$page_num}b{$id}";
    break;
  }

  $hass_objs[] = $hass_obj;
  unset($hass_obj);

  $y += $row_height;
  $id_offset += $id_step;
}
$hasp_pages[] = $hasp_lines;
