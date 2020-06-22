<?php if (sizeof($scripts)>0):?>
<?php foreach ($scripts as $script):?>
    <script src="<?=base_url()?>assets/js/<?=$script?>.js"></script>
<?php endforeach;?>
<?php endif;?>
</body>
</html>