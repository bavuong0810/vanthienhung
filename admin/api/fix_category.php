<?php

function fixCategory()
{
    global $d;
    header('Content-type: application/json');


    $errorCats = $d->o_fet("SELECT * FROM `#_category` WHERE `module` IS NULL OR `level` IS NULL");
    $catsMap = getFlatCatsMap();

    $result = [
        'all' => count($errorCats),
        'fixed' => 0,
        'failed' => 0,
    ];
    foreach ($errorCats as $errorCat) {
        if (fixCategoryById($errorCat['id'], $errorCat, $catsMap)) {
            $result['fixed']++;
        } else {
            $result['failed']++;
        }
    }

    echo json_encode($result);
}

function fixCategoryById($id, $currentData, $catsMap)
{
    global $d;

    if (empty($currentData)) {
        $currentData = $d->simple_fetch("SELECT * FROM `#_category` WHERE `id` = {$id}");
    }

    $updateData = [
        'category_id' => 0,
        'level' => 0,
        'module' => 3,
    ];
    if (empty($currentData['alias_vi'])) {
        $updateData['alias_vi'] = strtolower($d->bodautv($currentData['name_vi']));

        if (empty($updateData['alias_vi'])) {
            return false;
        }
        if ($d->checkLink($updateData['alias_vi'], 'alias_vi', '')) {
            $updateData['alias_vi'] .= '-' . rand(0, 99) . '-' . $currentData['id'];
        }

        $currentData['alias_vi'] = $updateData['alias_vi'];
    }

    if (empty($currentData['alias_en'])) {
        $updateData['alias_en'] = $currentData['alias_vi'];
    }
    if (empty($currentData['alias_ch'])) {
        $updateData['alias_ch'] = $currentData['alias_vi'];
    }

    if (!empty($currentData['category_id'])) {
        unset($updateData['category_id']);
        $parentData = getParentCatLevelModule($currentData['category_id'], $catsMap);
        if (!empty($parentData)) {
            $updateData['module'] = $parentData['module'];
            $updateData['level'] = $parentData['level'] + 1;
        }
    }

    if (!empty($currentData['module'])) {
        unset($updateData['module']);
    }
    if (!empty($currentData['level'])) {
        unset($updateData['level']);
    }

    $d->reset();
    $d->setTable('#_category');
    $d->setWhere('id', $id);
    return $d->update($updateData);
}

function getParentCatLevelModule($parentId, $catsMap)
{
    global $d;

    if (empty($catsMap)) {
        $catsMap = getFlatCatsMap();
    }

    $result = [
        'module' => null,
        'level' => null,
    ];
    $parent = $catsMap[$parentId];
    // parent not found
    if (empty($parent)) {
        return null;
    }

    if (!empty($parent['module']) && !empty($parent['level'])) {
        $result = [
            'module' => $parent['module'],
            'level' => $parent['level'],
        ];

        return $result;
    }

    $parentResult = getParentCatLevelModule($parent['category_id'], $catsMap);
    if (!$parentResult) {
        return null;
    }

    $result = [
        'module' => $parentResult['module'],
        'level' => $parentResult['level'],
    ];

    if (!empty($result['level'])) {
        $result['level']++;
    }

    if (!empty($parent['module'])) {
        $result['module'] = $parent['module'];
    }

    if (!empty($parent['level'])) {
        $result['level'] = $parent['level'];
    }

    return $result;
}

function getFlatCatsMap()
{
    global $d;

    $allCats = $d->o_fet("SELECT * FROM `#_category` WHERE `name_vi` IS NOT NULL AND `name_vi` <> ''");
    $catsMap = [];
    foreach ($allCats as $cat) {
        $catsMap[$cat['id']] = $cat;
    }
}
