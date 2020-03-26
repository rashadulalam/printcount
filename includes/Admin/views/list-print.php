<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Print Count' ); ?></h1>

	<a href="<?php echo admin_url( 'admin.php?page=print-count&action=new' ) ?>" class="page-title-action"><?php _e( 'Add new' ); ?> </a>

	<?php if (isset( $_GET['inserted'])) : ?>
		<div class="notice notice-success">
			<p><?php _e( 'Data inserted successfully!', 'print-count' ); ?></p>
		</div>
	<?php endif; ?>

	<form action="" method="post">
		<?php
			$printing_table = new PrintCount\Admin\Printing_List();

			$printing_table->prepare_items();
			$printing_table->search_box( 'search', 'search_id' );
			$printing_table->display();

		?>
	</form>

</div>