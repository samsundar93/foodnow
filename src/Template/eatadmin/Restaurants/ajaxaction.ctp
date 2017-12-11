<?php
if($action == 'showMap'){
    echo $this->GoogleMap->map(['id'=>$map['map_id'],'height'=>'400px']);
    echo "**********";
    echo $this->GoogleMap->addMarker($map['map_id'],
        'custome_markerid',
        ['latitude' => $map['latitude'], 'longitude' => $map['longitude']],
        [
            //'markerIcon' => LOCATION_IMG,
            'windowText' => $map['address']]
    );
    echo $addCircle  =  $this->GoogleMap->addCircle(
        $map['map_id'],
        $map['map_id']."Circle".$map['id'],
        array(
            "latitude"  => $map['latitude'],
            "longitude" => $map['longitude']
        ),
        $map['miles'],
        array(
            "fillColor"   => $map['color'],
            "fillOpacity" => 0.3
        )
    );
    exit();
}
?>

<?php if($action == 'restaurantStatus' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $id ?>', '0', '<?= $field ?>', 'restaurants/ajaxaction', 'restaurantStatus')">
            <i class="fa fa-check"></i>
        </button>
    <?php }else {?>
        <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $id ?>', '1', '<?= $field ?>', 'restaurants/ajaxaction', 'restaurantStatus')">
            <i class="fa fa-close"></i>
        </button>
    <?php }?>
<?php exit();} ?>


<?php if($action == 'restaurantMenuStatus' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $id ?>', '0', '<?= $field ?>', 'restaurants/ajaxaction', 'restaurantMenuStatus')">
            <i class="fa fa-check"></i>
        </button>
    <?php }else {?>
        <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $id ?>', '1', '<?= $field ?>', 'restaurants/ajaxaction', 'restaurantMenuStatus')">
            <i class="fa fa-close"></i>
        </button>
    <?php }?>
<?php exit();} ?>

<?php if($action == 'Restaurants') { ?>
    <table id="catTable" class="table table-striped">
        <thead>
        <tr>
            <th>S. No</th>
            <th>Restaurant Name</th>
            <th>Email</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($restaurantList) && !empty($restaurantList)) {
            foreach($restaurantList as $key => $value) { ?>
                <tr>
                    <td><?php echo $key +1; ?></td>
                    <td><?php echo $value['restaurant_name']; ?></td>
                    <td><?php echo $value['contact_email']; ?></td>
                    <td><?php
                        echo date("d-M-Y H:i:s", strtotime($value['created'])); ?></td>
                    <td align="center" id="status_<?php echo $value['id'];?>">
                        <?php if($value['status'] == 1){?>
                            <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'restaurants/ajaxaction', 'restaurantStatus')">
                                <i class="fa fa-check "></i>
                            </button>
                        <?php }else {?>
                            <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'restaurants/ajaxaction', 'restaurantStatus')">
                                <i class="fa fa-close"></i>
                            </button>
                        <?php }?>
                    </td>
                    <td>
                        <a href="<?php echo ADMIN_BASE_URL; ?>restaurants/addedit/<?php echo $value['id'];?>" class="btn btn-icon-toggle" data-original-title="Edit" data-placement="top" data-toggle="tooltip" id="<?php echo $value['id']; ?>" >
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-icon-toggle" data-original-title="Delete" data-placement="top" data-toggle="tooltip" type="button" id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'restaurants/deleteRestaurant', 'Restaurants', '', 'catTable')">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <?php exit(); } ?>


<?php if($action == 'getCategory') { ?>
    <?= $this->Form->input('category_id',[
        'type' => 'select',
        'id'   => 'category_id',
        'class' => 'form-control',
        'options' => $categoryList,
        'label' => false,
        'value'   => isset($menuDetails['category_id']) ? $menuDetails['category_id'] :  '',
        'empty'   =>'Please Choose Category'
    ]) ?>
    <span class="categoryErr"></span>
<?php die(); } ?>

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
                                            <div class="col-md-3 col-lg-2 removeAppendAddon_<?php echo $k; ?>"><?php
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
                                                    class="col-md-3 col-lg-2 removeAppendAddon_<?php echo $menu - 1; ?>"><?php
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
                                            <div class="col-md-3 col-lg-2"><?php
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
                                        <div class="col-md-3 col-lg-2"><?php
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
                                    <div class="col-md-3 col-lg-2"><?php
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
                                    <div class="col-md-3 col-lg-2"><?php
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

<?php if($action == 'Menus') { ?>
    <table id="catTable" class="table table-striped">
        <thead>
        <tr>
            <th>S. No</th>
            <th>Menu Name</th>
            <th>Category Name</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($menuDetails) && !empty($menuDetails)) {
            foreach($menuDetails as $key => $value) { ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $value['menu_name']; ?></td>
                    <td><?php echo $value['category']['catname']; ?></td>
                    <td><?php
                        echo date("d-M-Y H:i:s", strtotime($value['created'])); ?></td>
                    <td align="center" id="status_<?php echo $value['id']; ?>">
                        <?php if ($value['status'] == 1) { ?>
                            <button class="btn btn-icon-toggle active" type="button"
                                    onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'restaurants/ajaxaction', 'restaurantMenuStatus')">
                                <i class="fa fa-check "></i>
                            </button>
                        <?php } else { ?>
                            <button class="btn btn-icon-toggle deactive" type="button"
                                    onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'restaurants/ajaxaction', 'restaurantMenuStatus')">
                                <i class="fa fa-close"></i>
                            </button>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo ADMIN_BASE_URL; ?>restaurants/menuedit/<?php echo $value['id']; ?>"
                           class="btn btn-icon-toggle" data-original-title="Edit"
                           data-placement="top" data-toggle="tooltip"
                           id="<?php echo $value['id']; ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-icon-toggle" data-original-title="Delete"
                                data-placement="top" data-toggle="tooltip" type="button"
                                id="<?php echo $value['id']; ?>"
                                onclick="return deleteRecord(<?php echo $value['id']; ?>, 'restaurants/deleteMenu', 'Restaurants', '', 'catTable')">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
<?php die(); } ?>

