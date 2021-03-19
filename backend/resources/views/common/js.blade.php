<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css">
<script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy年mm月dd日",
      minDate: new Date(2020, 1 - 1, 1),
      maxDate: new Date(2025, 12 - 1, 31),
    });
  } );
</script>