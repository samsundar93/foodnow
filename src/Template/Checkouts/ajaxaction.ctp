<?php if($action == 'selectAddress') { ?>
    <div class="">
        <input id="selectedAddress" name="selectedAddress" type="hidden" value="<?php echo $addressBooks['id']; ?>">
        <label for="selectedAddress"><?php echo $addressBooks['title'] ?></label>
        <div class="margin-top-5 col-xs-12 no-padding selectedAddress">
            <?php //echo $customerDetails['addressbooks'][0]['flatno'] ?>
            <?php echo $addressBooks['address'] ?>

            <?php echo ($addressBooks['landmark']) ? 'Landmark'.'-'.$addressBooks['landmark'] : '' ?>
        </div>
    </div>

<?php die(); } ?>

<?php if($action == 'selectAllAddress') { ?>

    <?php if(!empty($addressBookLists)) {
        foreach($addressBookLists as $key => $value) {
            ?>
            <div class="col-xs-12 select_add_popup">
                <div class="accordian_address_box">
                    <div class="radio-item">
                        <input onclick="return selectAddress('<?php echo $value['id']; ?>')" name="address" id="select-address-<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['id']; ?>">
                        <label for="select-address-<?php echo $value['id']; ?>">
                            <?php echo $value['title'] ?>
                        </label><br>
                        <?php echo $value['address'] ?>

                        <?php echo ($value['landmark']) ? 'Landmark'.'-'.$value['landmark'] : '' ?><br>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
<?php die(); } ?>

<?php if($action == 'getTiming') {
    if(!empty($array_of_time)) { ?>
        <select id="deliveryTime" class="form-control ui-timepicker-input" name="deliveryTime">
<?php
        foreach ($array_of_time as $key => $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $value ?></option>
<?php
        } ?>
        </select>
<?php
    }else { ?>
        <input type="text" readonly class="form-control" id="deliveryTime" value="Closed">
<?php }
    ?>

<?php die(); } ?>
