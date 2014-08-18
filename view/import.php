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
            <h2>Address Book - Import XML</h2>
            <hr/>
            <br>
            <div id="alertDialog" style="width: 40%" class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" onclick="javascript:closeAlertDialog()">x</button>
                <span id="message" name="message" class="text-danger" ></span>
            </div>
            <br>
            <div style="width: 40%" class="well">
                <form id="importContactsForm" name="importContactsForm" action="../controller/ImportManager.php?from=XML" method="post" enctype="multipart/form-data" class="bs-example form-horizontal" >
                    <div class="form-group" >
                        <label for="file" class="control-label" >File</label>
                        <input type="file" id="file" name="file" class="form-control" />
                    </div>

                    <button type="submit" id="save" name="save" value="save" class="btn btn-primary">Upload</button>
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
        
    });

    //close alert dialog.
    function closeAlertDialog() {
        $('#alertDialog').hide();
        $('#message').text('');
    }
    
</script>