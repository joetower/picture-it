<?php
/**
 * @file
 *   Handling markup for Breakpoint Maps. 
 */
$groups = $args['groups'];
?>
<table>
    <tr>
        <td>
            <select name="group" id="group">
                <option value="">-- Select --</option>
                <?php foreach($groups as $key => $group) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $group['name'];?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
</table>