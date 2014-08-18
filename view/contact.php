<!DOCTYPE html>
<!-- View of the entity Contact (contact info page) -->
<html>
    <head>
        <title>Address Book</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
        <script type="text/javascript" src="../js/generic.js" ></script>
    </head>
    <body>
        <div class="container" >
            <h2>Address Book - 
                <?php
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'new':
                            echo "New Contact";
                            break;
                        case 'edit':
                            echo "Contact ID: ";
                            if (isset($_GET['id'])) {
                                echo $_GET['id'];
                            }
                            break;
                    }
                }
                ?>
            </h2>
            <hr/>
            <br>
            <div id="alertDialog" style="width: 40%" class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" onclick="javascript:closeAlertDialog()">x</button>
                <span id="message" name="message" class="text-danger" ></span>
            </div>
            <br>
            <?php
            require_once '../entity/Contact.php';
            require_once '../entity/City.php';
            require_once '../controller/ContactManager.php';

            if (isset($_GET['id'])) { //if there is an 'id'...
                //try to get the contact.
                try {
                    $contact = ContactManager::getContact($_GET['id']);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            } else {
                //if there is no contact with 'id', set an empty contact.
                $contact = new Contact();
            }
            ?>
            <div style="width: 40%" class="well">
                <form id="contactSaveForm" name="contactSaveForm" action="../controller/ContactManager.php?action=save" method="post" onsubmit="return validateContactSaveForm()" class="bs-example form-horizontal" >
                    <input type="hidden" id="id" name="id" value="<?php echo $contact->getId(); ?>" />

                    <div class="form-group" >
                        <label for="firstName" class="control-label" >First Name</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $contact->getFirstName(); ?>" maxlength="64" class="form-control" />
                    </div>

                    <div class="form-group" >
                        <label for="lastName" class="control-label">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="<?php echo $contact->getLastName(); ?>" maxlength="64" class="form-control" />
                    </div>

                    <div class="form-group" >
                        <label for="street" class="control-label" >Street</label>
                        <input type="text" id="street" name="street" value="<?php echo $contact->getStreet(); ?>" maxlength="64" class="form-control" />
                    </div>

                    <div class="form-group" >
                        <label for="zipCode" class="control-label" >ZIP Code</label>
                        <input type="text" id="zipCode" name="zipCode" value="<?php echo $contact->getZipCode(); ?>" maxlength="5" onkeydown="javascript:return validateInputNumber(event);" class="form-control" />
                    </div>

                    <div class="form-group" >
                        <label for="city" class="control-label" >City</label>
                        <select id="city" name="city" class="form-control" >
                            <option value="">[Select...]</option>
                            <?php
                            require_once '../entity/City.php';
                            require_once '../controller/CityManager.php';

                            //get the city list available.
                            try {
                                $cities = CityManager::getCityList();
                            } catch (Exception $ex) {
                            }

                            if (isset($cities)) { //if there is a city list...
                                //set cities to the combo-box.
                                foreach ($cities as $id => $city) {
                                    echo "<option value=\"" . $id . "\">" . $city->getName() . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" id="save" name="save" value="save" class="btn btn-primary">Save</button>
                    <button type="button" id="cancel" name="cancel" value="cancel" onclick="javascript:location.href = '../view/list.php';" class="btn btn-primary">Cancel</button>

                </form>            
            </div>

        </div>
    </body>
</html>

<script type="text/javascript" >
    
    $(function() {
        
        //initialize the alert dialog as hidden.
        $('#alertDialog').hide();
        
        //select the city of the current contact (for editing).
        $('#city').val('<?php echo $contact->getCity()->getId(); ?>');
        
    });

    //form validation of the save contact action.
    function validateContactSaveForm() {
        var firstName = $('#firstName');
        var lastName = $('#lastName');
        var street = $('#street');
        var zipCode = $('#zipCode');
        var city = $('#city');
        var valid = true;

        valid = valid && checkRange(firstName, 1, firstName.prop('maxlength'));
        valid = valid && checkRange(lastName, 1, lastName.prop('maxlength'));
        valid = valid && checkRange(street, 1, street.prop('maxlength'));
        valid = valid && checkRegexp(zipCode, /^[0-9]{5}$/);
        valid = valid && checkSelected(city);

        return valid;
    }

    //close alert dialog.
    function closeAlertDialog() {
        $('#alertDialog').hide();
        $('#message').text('');
    }
    
</script>