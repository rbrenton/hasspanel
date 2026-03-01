<?php
// Show help if requested
if (in_array('--help', $argv ?? []) || in_array('-h', $argv ?? [])) {
  echo "Usage: php genhasp.php > pages.jsonl\n\n";
  echo "Generate OpenHASP JSONL configuration from config.php\n";
  echo "Output should be uploaded to your OpenHASP device.\n";
  exit(0);
}

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
