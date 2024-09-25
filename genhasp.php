<?php
require_once('common.php');

function echo_jsonl($arr) {
  echo preg_replace('%\\\\\\\\u%smi', '\\u', json_encode($arr));
  echo "\n";
}

foreach ($hasp_pages as $hasp_page) {
  foreach ($hasp_page as $hass_obj) {
    echo_jsonl($hass_obj);
  }
}
