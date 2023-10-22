<?php
    $currentLayout = isset($_COOKIE['productLayout']) ? $_COOKIE['productLayout'] : 'grid';
    $layouts = [
        [
            'layout' => 'grid',
            'name' => 'Dạng lưới',
            'icon' => 'glyphicon glyphicon-th',
        ],
        [
            'layout' => 'list',
            'name' => 'Dòng lớn',
            'icon' => 'glyphicon glyphicon-th-list',
        ],
        [
            'layout' => 'small_list',
            'name' => 'Dòng nhỏ',
            'icon' => 'glyphicon glyphicon-list',
        ],
    ];

    foreach ($layouts as $layout) {
        $isSelected = $layout['layout'] == $currentLayout;
        $btnClass = $isSelected ? 'btn-primary' : 'btn-default';
        $disabled = $isSelected ? 'disabled' : '';
        ?>
        <button
            onclick="changeProductLayout('<?php echo $layout['layout']; ?>')"
            data-current="<?php echo $currentLayout; ?>"
            class="btn btn-sm <?php echo $btnClass; ?>"
            <?php echo $disabled; ?>>
            <span class="glyphicon <?php echo $layout['icon']; ?>"></span> <?php echo $layout['name']; ?>
        </button>
        <?php
    }
?>