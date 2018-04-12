<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module (Parent topic) update form
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_modules
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div class="container">
    <h2 class="title-section"><?php echo $this->lang->line('title_module_add'); ?></h2>
    <div class="row">
        <?php
            $attributes = array("class" => "form-group",
                "id" => "addModuleForm",
                "name" => "addModuleForm");
            echo form_open('Module/form_validate', $attributes);
                
            if($error == true) {
                echo "<p class='alert alert-warning'>" . $this->lang->line('add_module_form_err') . "</p>";
            }
        ?>
        <div class="form-group col-xs-12 col-sm-8">
            <h4 for="title"><?php echo $this->lang->line('add_title_module'); ?></h4>
            <input type="text" name="title" class="form-control" id="title" value="">
            <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
        </div>
        <div class="col-xs-12 col-sm-4">
            <input type="submit" class="btn btn-success col-xs-12 xs-space" />
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
