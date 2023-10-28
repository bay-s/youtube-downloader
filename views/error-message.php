
<?php if(!empty($Exception)) { ?>
  <?php if($Exception['error']) { ?>
<div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
  <p class="mt-2 text-sm text-red-700 font-bold">
  <?php echo $Exception['message'] ?>
  </p>
</div>
    <?php } ?>
<?php }  ?> 