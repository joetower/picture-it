<?php
/**
 * @file
 *   Handling for group mapping form.
 */
?>
<h2><?php echo $group['name']; ?></h2>
<table>
    <?php foreach ($group['sizes'] as $key => $size) { ?>
        <tr>
            <th scope="row"><?php echo $size['name'] . '/' . $size['width'] . 'px'; ?></th>
            <td>
                <select name="<?php echo $args['name']; ?>[<?php echo $group_id; ?>][size][<?php echo $key; ?>]">
                <option value>-- Select --</option>
                <?php if (!empty($args['image_sizes'])) {
                    foreach($args['image_sizes'] as $k => $size) {
                        $selected = (isset($args['value'][$group_id]['size'][$key]) && $args['value'][$group_id]['size'][$key] == $k) ? ' selected' : '';
                        ?>
                    <option value="<?php echo $k;?>"<?php echo $selected;?>><?php echo $size['name'];?></option>
                <?php }} ?>
                </select>
            </td>
        </tr>
    <?php } ?>
</table>