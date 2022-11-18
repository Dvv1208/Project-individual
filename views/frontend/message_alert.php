<?php

use App\Libraries\MyClass;
?>

<?php if (MyClass::exists_flash('message')) : ?>
  <script>
    $.toast({
      text: <?php echo $arr_message['msg']; ?>,
      position: 'top-right',
      stack: false
    })
  </script>
<?php endif; ?>