<?php
// require_once __ROOT_PATH . '/admin/ckeditor/ckeditor.php';
// require_once __ROOT_PATH . '/admin/ckeditor/ckfinder.php';
// $ckeditor = new CKEditor();
// $ckeditor->returnOutput = true;
// $ckeditor->basePath = 'ckeditor/';
// CKFinder::SetupCKEditor($ckeditor, 'ckfinder/');

$formFieldRenderers = [
  'text' => function (string $key, array $field, $value) {
    return <<<END
    <div class="form-group">
      <label>{$field['label']}</label>
      <input type="text" name="$key" value="{$value['value']}" class="form-control" />
    </div>
    END;
  },
  'rich_text' => function (string $key, array $field, $value) {
    // global $ckeditor;
    //$id = $key . '_' . uniqid();
    $id = $key;
    // $js = $ckeditor->replace($id);
    return <<<END
    <div class="form-group">
      <label>{$field['label']}</label>
      <textarea name="$key" class="form-control" id="{$id}" rows="4">{$value['value']}</textarea>
    </div>
    END;
  },
  'image' => function (string $key, array $field, $value) {
    $image = '';

    $imageUrl = strpos($value['value'], 'http') === 0 ? $value['value'] : "/img_data/images/{$value['value']}";

    $api = $field['api'] ?: '/admin/api.php?func=uploadFile';

    if ($value && $value['value']) {
      $image = <<<END
      <img src="{$imageUrl}" alt="{$field['label']}" class="my-2" style="max-height:150px; max-width: 200px;" />
      END;
    }
    $id = $key . '_' . uniqid();
    return <<<END
    <div class="form-group" id="{$id}">
      <label>{$field['label']}</label> <button type="button" class="btn btn-sm btn-default btn-icon-sm js-image-remove" data-target="#{$id}">X</button>
      <div class="img-result">
        {$image}
      </div>
      <input type="hidden" name="$key" value="{$value['value']}" class="js-upload-result" />
      <input type="file" data-api="{$api}" class="js-image-field" data-result="#{$id}" />
    </div>
    END;
  },
];

if (!function_exists('renderFormField')) {
  function renderFormField($key, $field, $value)
  {
    global $formFieldRenderers;
    $renderFunc = $formFieldRenderers[$field['type']];

    if (!$renderFunc) {
      return '';
    }

    return $renderFunc($key, $field, $value);
  }
}

if (!function_exists('renderForm')) {
  function renderForm(array $fields, array $values)
  {
    foreach ($fields as $key => $field) {
      echo renderFormField($key, $field, $values[$key]);
    }
  }
}
