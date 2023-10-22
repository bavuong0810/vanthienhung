<?php

function getCategories() {
  global $d;
  $data = [
      'term' => trim(!empty($_GET['term']) ? $_GET['term'] : ''),
      'type' => trim(!empty($_GET['type']) ? intval($_GET['type']) : 3),
      'page' => isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 0,
  ];

  $limit = 30;
  $offset = 0;
  if ($data['page'] > 0) {
      $offset = ($data['page'] - 1) * $limit;
  }
  $where = [];
  if (!empty($data['term'])) {
      $where[] = "name_vi LIKE '%{$data['term']}%'";
  }
  if (!empty($data['type'])) {
      $where[] = "module = {$data['type']}";
  }
  $where = implode(' AND ', $where);
  if ($where) {
    $where = 'WHERE ' . $where;
  }

  $d->reset();
  $parents = $d->o_fet("
      SELECT CONCAT(id, ' - ', name_vi) as text, id
      FROM #_category
      " . $where . "
      ORDER BY name_vi ASC
      LIMIT $offset, $limit
      ");
  $totalResult = $d->simple_fetch("
      SELECT COUNT(id) as total
      FROM #_category
      " . $where);

  echo json_encode([
      'results' => $parents,
      'pagination' => [
          'more' => $data['page'] * 30 < $totalResult['total'],
      ],
      'total' => intval($totalResult['total']),
  ]);
}
