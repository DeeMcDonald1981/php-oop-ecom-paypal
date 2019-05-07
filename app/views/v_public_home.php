<?php include('includes/public_header.php')?>
<div id="content">
    <h2>All Products</h2>

    <ul>
        <?php $this->get_alerts();?>
    </ul>
    
    <h3><?php $this->get_data('header') ?></h3>
    <ul class="products">
        <?php $this->get_data('products')?>
    </ul>
</div>
<?php include('includes/public_footer.php')?>