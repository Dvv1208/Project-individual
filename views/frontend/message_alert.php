<?php

use App\Libraries\MyClass;
?>
<script>
  <?php if (MyClass::exists_flash('message')) : ?>
    <?php $arr_message = MyClass::get_flash('message'); ?>
    window.addEventListener('load', function() {
      toastr.success('<?php echo $arr_message['msg']; ?>');
    });
  <?php endif; ?>
</script>