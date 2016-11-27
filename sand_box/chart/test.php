<?php
    if (isset($_GET['var_PHP_data'])) {
      echo $_GET['var_PHP_data'];
    } else {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <script src="../../javascript/jquery.js">
        <script>
            $(document).ready(function() {
                $('#sub').click(function() {
                    var var_data = "Hello World";
                    $.ajax({
                        url: 'http://localhost/see_me/sand_box/chart/test.php',
                        type: 'GET',
                         data: { var_PHP_data: var_data },
                         success: function(data) {
                             // do something;
                            $('#result').html(data)
                         }
                     });
                 });
             });
        </script>
      </head>
      <body>
        <input type="submit" value="Submit" id="sub"/>
        <div id="result">
      </body>
    </html>
    <?php } ?>