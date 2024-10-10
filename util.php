<?php
function map_to_rows($T, $D) {
  global $rows, $icons;

  foreach ($D as $arr) {
    $row = $T;
    foreach ($row as $k => $v) {
      preg_match_all('/%([0-9]+)%/', $v, $m);
      foreach ($m[0] as $i => $j) 
        $v = preg_replace("/%{$m[1][$i]}%/", $arr[$m[1][$i]], $v);
      if ($k == 'icon') $v = $icons[$v];
      $row[$k] = $v;
    }
    $rows[] = $row;
  }
}
