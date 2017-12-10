<?php if($action == 'restaurantMenuStatus' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <div class="label label-table label-success">
        <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $id ?>', '0', 'status', 'menus/ajaxaction', 'restaurantMenuStatus')"><i class="fa fa-check"></i></a>
        </div>
    <?php }else {?>
        <div class="label label-table label-danger">
            <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $id ?>', '1', 'status', 'menus/ajaxaction', 'restaurantMenuStatus')"><i class="fa fa-close"></i></a>
        </div>
    <?php }?>

<?php exit();} ?>

<?php if($action == 'getAddons') {
    $priceAppend = 1;
    $j = '';
    foreach($addonsList as $keyword => $value) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">&nbsp;</label>

            <div class="col-md-9">
                <div class="mainProductHead bold"><?php echo $value['mainaddons_name'] ?> <span class="caret"></span></div> <?php
                echo $this->Form->input('Mainaddon.id', [
                    'type' => 'hidden',
                    'name' => 'data[MenuAddon][' . $keyword . '][mainaddons_id]',
                    'value' => $value['id']
                ]);
                $i = (!empty($j)) ? $j + 1 : 1;
                foreach ($value['subaddons'] as $key => $val) { ?>
                <div class="col-xs-12 productAddonsMenu"
                     id="data[MenuAddon][<?php echo $keyword; ?>][Subaddon][<?php echo $key; ?>][subaddons_price]">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <input type="checkbox" id="data[MenuAddon][<?php echo $keyword ?>][Subaddon][<?php echo $key ?>][subaddons_id]" name="data[MenuAddon][<?php echo $keyword ?>][Subaddon][<?php echo $key ?>][subaddons_id]" value="<?php echo $val['id'];?>" class="checkboxes test appendMultipleSubAddons" <?php echo ((in_array($val['id'], $selectedAddons) == 1) ? 'checked' : '');?> >
                            <label for="data[MenuAddon][<?php echo $keyword ?>][Subaddon][<?php echo $key ?>][subaddons_id]"><?php echo $val['subaddons_name']?></label>
                        </div>

                        <div class="appendMultiplePrice" id="appendMultiplePrice_<?php echo $i; ?>"> <?php
                            if (!empty($menuID)) {
                                if ($priceOption == 'multiple') {
                                    //$AddonList = $this->Restaurants->getSubAddonsMultiplePrice($productId, $val['id'], 'single');
                                    if (!empty($val['menuAddons'])) {
                                        $len = '';
                                        foreach ($val['menuAddons'] as $k => $v) { ?>
                                            <div class="col-md-3 col-lg-3 removeAppendAddon_<?php echo $k; ?>"><?php
                                                echo $this->Form->input('', [
                                                    'class' => 'form-control singleValidate',
                                                    'placeholder' => 'Price',
                                                    'type' => 'text',
                                                    'name' => 'data[MenuAddon][' . $keyword . '][Subaddon][' . $key . '][subaddons_price][]',
                                                    'value' => $v['subaddons_price'],
                                                    'label' => false
                                                ]); ?>
                                            </div> <?php
                                        }
                                    } else {
                                        for ($menu = 1; $menu <= $menuLength; $menu++) { ?>
                                            <div
                                                    class="col-md-3 col-lg-3 removeAppendAddon_<?php echo $menu - 1; ?>"><?php
                                                echo $this->Form->input('', [
                                                    'class' => 'form-control singleValidate',
                                                    'placeholder' => 'Price',
                                                    'type' => 'text',
                                                    'name' => 'data[MenuAddon][' . $keyword . '][Subaddon][' . $key . '][subaddons_price][]',
                                                    'value' => $val['subaddons_price'],
                                                    'label' => false
                                                ]); ?>
                                            </div> <?php
                                        }
                                    }
                                } else {
                                    //$AddonList = AjaxActionController::getSubAddonsMultiplePrice($productId, $val['id'], 'single');
                                    if (!empty($val['menuAddons'])) {
                                        foreach ($val['menuAddons'] as $singlekey => $singleValue) {
                                            ?>
                                            <div class="col-md-3 col-lg-3"><?php
                                                echo $this->Form->input('', [
                                                    'class' => 'form-control singleValidate',
                                                    'placeholder' => 'Price',
                                                    'type' => 'text',
                                                    'name' => 'data[MenuAddon][' . $keyword . '][Subaddon][' . $key . '][subaddons_price][]',
                                                    'value' => $singleValue['subaddons_price'],
                                                    'label' => false
                                                ]); ?>
                                            </div> <?php
                                        }
                                    } else { ?>
                                        <div class="col-md-3 col-lg-3"><?php
                                            echo $this->Form->input('', [
                                                'class' => 'form-control singleValidate',
                                                'placeholder' => 'Price',
                                                'type' => 'text',
                                                'name' => 'data[MenuAddon][' . $keyword . '][Subaddon][' . $key . '][subaddons_price][]',
                                                'value' => $val['subaddons_price'],
                                                'label' => false
                                            ]); ?>
                                        </div> <?php
                                    }
                                }
                            } else {
                                if ($priceOption == 'multiple') { ?>
                                    <div class="col-md-3 col-lg-3"><?php
                                        echo $this->Form->input('', [
                                            'class' => 'form-control singleValidate',
                                            'placeholder' => 'Price',
                                            'type' => 'text',
                                            'name' => 'data[MenuAddon][' . $keyword . '][Subaddon][' . $key . '][subaddons_price][]',
                                            'value' => $val['subaddons_price'],
                                            'label' => false
                                        ]); ?>
                                    </div> <?php
                                } else { ?>
                                    <div class="col-md-3 col-lg-3"><?php
                                        echo $this->Form->input('', [
                                            'class' => 'form-control singleValidate',
                                            'placeholder' => 'Price',
                                            'type' => 'text',
                                            'name' => 'data[MenuAddon][' . $keyword . '][Subaddon][' . $key . '][subaddons_price]',
                                            'value' => $val['subaddons_price'],
                                            'label' => false
                                        ]); ?>
                                    </div> <?php
                                }
                            } ?>
                        </div>
                    </div>
                    </div><?php
                    $j = $i++;
                } ?>
            </div>
        </div>

    <?php } die(); } ?>
