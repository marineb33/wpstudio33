<div class="mkdf-bnl-navigation-holder">
    <div class="mkdf-bnl-navigation">
        <a class="mkdf-bnl-nav-icon mkdf-bnl-nav-prev"><span></span></a>
        <div class="mkdf-bnl-slider-paging">
            <?php
            $counter = 1;
            while($counter <= $max_pages){ ?>
                <a class="mkdf-paging-button-holder" href="#"><span class="mkdf-paging-button"></span></a>
            <?php $counter++; } ?>
        </div>
        <a class="mkdf-bnl-nav-icon mkdf-bnl-nav-next"><span></span></a>
    </div>
</div>