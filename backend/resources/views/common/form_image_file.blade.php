<script>
  function previewImage(obj)
  {
    var fileReader = new FileReader();
    fileReader.onload = (function() {
      document.getElementById('img').src = fileReader.result;
    });
    fileReader.readAsDataURL(obj.files[0]);
  }
</script>