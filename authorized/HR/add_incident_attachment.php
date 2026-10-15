<head>
    <script>
    $(document).ready(function (e) {
 //////////////////////////////////
          $("#ingizaattachment").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({url: "view/add_incident.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#messageattachmentt").html(data);
                },
                error: function () {
                }
            });
        }));
 ///////////////////////////////////
        });
</script>
</head>
    


<form  role="form" id="ingizaattachment" method="Post">
                <input  type="hidden" class="form-control" value="<?php echo $_GET['incident_id']; ?>"  name="incident_id">
                <input  type="hidden" class="form-control" value="<?php echo $emp_file_no; ?>"  name="attachment">
                    <div class="input-control file">
        <input type="file" name="file" />
        <button class="btn-file"></button>
    </div>
                <input type="submit"  class="btn btn-default" style=" margin-top: 2%;" value="Upload">

            </form>
