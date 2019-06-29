<form method="POST" enctype="multipart/form-data">
    <?php foreach ($form['fields'] as $field_id => $field): ?>
        <label>
            <span><?php print $field['label']; ?></span>

            <!-- Form field -->
            <?php if (in_array($field['type'], ['text', 'password', 'file'])): ?>
                <!-- Simple input field: text, password -->
                <input type="<?php print $field['type']; ?>" name="<?php print $field_id; ?>"
                       placeholder="<?php print $field['placeholder']; ?>"/>
            <?php elseif ($field['type'] == 'float'): ?>
                <input type="<?php print $field['type']; ?>" name="<?php print $field_id; ?>"
                       placeholder="<?php print $field['placeholder']; ?>" step="0.01"/>
            <?php elseif ($field['type'] == 'number'): ?>
                <?php if (isset($field['min']) && isset($field['max'])): ?>
                    <input type="<?php print $field['type']; ?>" name="<?php print $field_id; ?>"
                           placeholder="<?php print $field['placeholder']; ?>" min="<?php print $field['min']; ?>"
                           max="<?php print $field['max']; ?>"/>
                <?php else: ?>
                    <input type="<?php print $field['type']; ?>" name="<?php print $field_id; ?>"
                           placeholder="<?php print $field['placeholder']; ?>"/>
                <?php endif; ?>
            <?php elseif ($field['type'] == 'select'): ?>
                <!-- Select field -->
                <select name="<?php print $field_id; ?>">
                    <?php foreach ($field['options'] as $option_id => $option_label): ?>
                        <option value="<?php print $option_id; ?>"><?php print $option_label; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            <!-- Errors -->
            <?php if (isset($field['error_msg'])): ?>
                <p class="error"><?php print $field['error_msg']; ?></p>
            <?php endif; ?>
        </label>
    <?php endforeach; ?>

    <?php if (isset($form['error_msg'])): ?>
        <p class="error"><?php print $form['error_msg']; ?></p>
    <?php endif; ?>

    <!-- Buttons -->
    <?php foreach ($form['buttons'] as $button_id => $button): ?>
        <button class="btn btn-primary" name="action" value="<?php print $button_id; ?>">
            <?php print $button['text']; ?>
        </button>
    <?php endforeach; ?>
</form>