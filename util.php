<?php
/**
 * Utility functions for hasspanel
 */

/**
 * Map template with data rows to create panel row definitions
 *
 * @param array $template Template with %N% placeholders
 * @param array $data Array of data rows
 * @throws Exception If icon name is not found
 */
function map_to_rows($template, $data) {
  global $rows, $icons;

  foreach ($data as $rowIndex => $arr) {
    $row = $template;
    foreach ($row as $key => $value) {
      // Replace %N% placeholders with data values
      preg_match_all('/%([0-9]+)%/', $value, $matches);
      foreach ($matches[0] as $i => $placeholder) {
        $dataIndex = $matches[1][$i];
        if (!isset($arr[$dataIndex])) {
          throw new Exception(sprintf(
            "Data index %d not found in row %d. Available indices: 0-%d",
            $dataIndex, $rowIndex, count($arr) - 1
          ));
        }
        $value = str_replace($placeholder, $arr[$dataIndex], $value);
      }

      // Resolve icon name to unicode character
      if ($key === 'icon') {
        if (!isset($icons[$value])) {
          $suggestions = get_icon_suggestions($value, array_keys($icons));
          $errorMsg = sprintf("Unknown icon '%s' in row %d.", $value, $rowIndex);
          if (!empty($suggestions)) {
            $errorMsg .= sprintf(" Did you mean: %s?", implode(', ', $suggestions));
          }
          $errorMsg .= " See icons.php for available icons.";
          throw new Exception($errorMsg);
        }
        $value = $icons[$value];
      }

      $row[$key] = $value;
    }
    // Validate required fields
    validate_row($row, $rowIndex);

    $rows[] = $row;
  }
}

/**
 * Validate that a row has all required fields
 *
 * @param array $row The row to validate
 * @param int $rowIndex The index for error messages
 * @throws Exception If required fields are missing
 */
function validate_row($row, $rowIndex) {
  $required = ['icon', 'label', 'type', 'entity'];
  $missing = [];

  foreach ($required as $field) {
    if (!isset($row[$field]) || $row[$field] === '') {
      $missing[] = $field;
    }
  }

  if (!empty($missing)) {
    throw new Exception(sprintf(
      "Row %d is missing required field(s): %s",
      $rowIndex, implode(', ', $missing)
    ));
  }

  // Validate type value
  $validTypes = ['switch', 'text', 'btn'];
  if (!in_array($row['type'], $validTypes)) {
    throw new Exception(sprintf(
      "Row %d has invalid type '%s'. Valid types: %s",
      $rowIndex, $row['type'], implode(', ', $validTypes)
    ));
  }

  // Validate entity format (domain.entity_id)
  if (!preg_match('/^[a-z_]+\.[a-z0-9_]+$/i', $row['entity'])) {
    throw new Exception(sprintf(
      "Row %d has invalid entity format '%s'. Expected format: domain.entity_id (e.g., switch.living_room, sensor.temperature)",
      $rowIndex, $row['entity']
    ));
  }
}

/**
 * Get similar icon name suggestions using Levenshtein distance
 *
 * @param string $input The input icon name
 * @param array $iconNames Available icon names
 * @return array Up to 3 similar icon names
 */
function get_icon_suggestions($input, $iconNames) {
  $suggestions = [];

  foreach ($iconNames as $name) {
    $distance = levenshtein(strtolower($input), strtolower($name));
    if ($distance <= 3) {
      $suggestions[$name] = $distance;
    }
  }

  asort($suggestions);
  return array_slice(array_keys($suggestions), 0, 3);
}
