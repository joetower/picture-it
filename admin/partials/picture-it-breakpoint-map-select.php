<?php
/**
 * @file
 *   Handling markup for Breakpoint Maps. 
 */
$groups = get_option( 'pi_breakpoint_groups' );
$selected_group = $_GET['group'] ?? '';
?>
<h2>Breakpoint Image Maps</h2>
<p>Map each custom image size (by name) to the appropriate breakpoint in which you would like it applied.</p>
<table>
    <tr>
        <th scope="row">Select Breakpoint Group</th>
        <td>
            <form>
            <input type="hidden" name="page" value="picture-it" />
            <input type="hidden" name="tab" value="breakpointmap" />
            <select name="group" id="group-select">
                <option value="">-- Select --</option>
                <?php foreach($groups as $key => $group) {
                    $checked = '';
                    if ('' !== $selected_group && $key == $selected_group) {
                        $checked = ' selected';
                    }
                    ?>
                    <option value="<?php echo $key; ?>"<?php echo $checked; ?>><?php echo $group['name'];?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Select Group">
            </form>
        </td>
    </tr>
</table>
