<?php
$sidebar = chillnews_mikado_get_sidebar();
?>
<div class="mkdf-column-inner">
    <aside class="mkdf-sidebar">
        <?php
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        ?>
    </aside>
</div>
