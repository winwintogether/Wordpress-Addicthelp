<div class="grid-x align-stretch">
    <div class="cell medium-offset-1 medium-3">
        <label for="state" class="ah-state-selector__label middle">Select your site</label>
    </div>
    <div class="cell medium-6">
        <?php
        $field_name = "states";
        $field = _acf_get_field_by_name($field_name);
        if ($field) {
            echo '<select name="state" id="state" class="ah-state-selector__select">';
            foreach ($field['choices'] as $k => $v) {
                echo '<option value="' . $k . '">' . $v . '</option>';
            }
            echo '</select>';
        }
        ?>
    </div>
</div>