<?php  

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { 	die('You are not allowed to call this page directly.'); }

class nggManageGallery {

	var $mode = 'main';
	var $gid = false;
	var $pid = false;
	var $base_page = 'admin.php?page=nggallery-manage-gallery';
	var $search_result = false;
	
	// initiate the manage page
	function nggManageGallery() {

		// GET variables
		if(isset($_GET['gid']))
			$this->gid  = (int) $_GET['gid'];
		if(isset($_GET['pid']))
			$this->pid  = (int) $_GET['pid'];	
		if(isset($_GET['mode']))
			$this->mode = trim ($_GET['mode']);
		// Should be only called via manage galleries overview
		if ( $_POST['page'] == 'manage-galleries' )
			$this->post_processor_galleries();
		// Should be only called via a edit single gallery page	
		if ( $_POST['page'] == 'manage-images' )
			$this->post_processor_images();
		//Look for other POST process
		if ( !empty($_POST) || !empty($_GET) )
			$this->processor();
	
	}

	function controller() {

		switch($this->mode) {
			case 'sort':
				include_once (dirname (__FILE__) . '/manage-sort.php');
				nggallery_sortorder($this->gid);
			break;
			case 'edit':
				include_once (dirname (__FILE__) . '/manage-images.php');
				nggallery_picturelist();	
			break;
			case 'main':
			default:
				include_once (dirname (__FILE__) . '/manage-galleries.php');
				nggallery_manage_gallery_main();
			break;
		}
	}

	function processor() {
	
		global $wpdb, $ngg, $nggdb;
		
		// Delete a gallery
		if ($this->mode == 'delete') {
		
			check_admin_referer('ngg_editgallery');
		
			// get the path to the gallery
			$gallerypath = $wpdb->get_var("SELECT path FROM $wpdb->nggallery WHERE gid = '$this->gid' ");
			if ($gallerypath){
		
				// delete pictures
				//TODO:Remove also Tag reference, look here for ids instead filename
				$imagelist = $wpdb->get_col("SELECT filename FROM $wpdb->nggpictures WHERE galleryid = '$this->gid' ");
				if ($ngg->options['deleteImg']) {
					if (is_array($imagelist)) {
						foreach ($imagelist as $filename) {
							@unlink(WINABSPATH . $gallerypath . '/thumbs/thumbs_' . $filename);
							@unlink(WINABSPATH . $gallerypath .'/'. $filename);
						}
					}
					// delete folder
						@rmdir( WINABSPATH . $gallerypath . '/thumbs' );
						@rmdir( WINABSPATH . $gallerypath );
				}
			}
	
			$delete_pic = $wpdb->query("DELETE FROM $wpdb->nggpictures WHERE galleryid = $this->gid");
			$delete_galllery = $wpdb->query("DELETE FROM $wpdb->nggallery WHERE gid = $this->gid");
			
			if($delete_galllery)
				nggGallery::show_message( _n( 'Gallery', 'Galleries', 1, 'nggallery' ) . ' \''.$this->gid.'\' '.__('deleted successfully','nggallery'));
				
		 	$this->mode = 'main'; // show mainpage
		}
	
		// Delete a picture
		if ($this->mode == 'delpic') {
		//TODO:Remove also Tag reference
			check_admin_referer('ngg_delpicture');
			$image = $nggdb->find_image( $this->pid );
			if ($image) {
				if ($ngg->options['deleteImg']) {
					@unlink($image->imagePath);
					@unlink($image->thumbPath);	
				} 
				$delete_pic = $wpdb->query("DELETE FROM $wpdb->nggpictures WHERE pid = $image->pid");
			}
			if($delete_pic)
				nggGallery::show_message( __('Picture','nggallery').' \''.$this->pid.'\' '.__('deleted successfully','nggallery') );
				
		 	$this->mode = 'edit'; // show pictures
	
		}
		
		// will be called after a ajax operation
		if (isset ($_POST['ajax_callback']))  {
				if ($_POST['ajax_callback'] == 1)
					nggGallery::show_message(__('Operation successful. Please clear your browser cache.',"nggallery"));
		}
		
		// show sort order
		if ( isset ($_POST['sortGallery']) )
			$this->mode = 'sort';
		
		if ( isset ($_GET['s']) )	
			$this->search_images();
		
	}
	
	function post_processor_galleries() {
		global $wpdb, $ngg, $nggdb;
		
		// bulk update in a single gallery
		if (isset ($_POST['bulkaction']) && isset ($_POST['doaction']))  {

			check_admin_referer('ngg_bulkgallery');
			
			switch ($_POST['bulkaction']) {
				case 'no_action';
				// No action
					break;
				case 'set_watermark':
				// Set watermark
					// A prefix 'gallery_' will first fetch all ids from the selected galleries
					nggAdmin::do_ajax_operation( 'gallery_set_watermark' , $_POST['doaction'], __('Set watermark','nggallery') );
					break;
				case 'import_meta':
				// Import Metadata
					// A prefix 'gallery_' will first fetch all ids from the selected galleries
					nggAdmin::do_ajax_operation( 'gallery_import_metadata' , $_POST['doaction'], __('Import metadata','nggallery') );
					break;
			}
		}

		if (isset ($_POST['addgallery']) && isset ($_POST['galleryname'])){
			
			check_admin_referer('ngg_addgallery');

			// get the default path for a new gallery
			$defaultpath = $ngg->options['gallerypath'];
			$newgallery = esc_attr( $_POST['galleryname']);
			if ( !empty($newgallery) )
				nggAdmin::create_gallery($newgallery, $defaultpath);
		}

		if (isset ($_POST['TB_bulkaction']) && isset ($_POST['TB_ResizeImages']))  {
			
			check_admin_referer('ngg_thickbox_form');
			
			//save the new values for the next operation
			$ngg->options['imgWidth']  = (int) $_POST['imgWidth'];
			$ngg->options['imgHeight'] = (int) $_POST['imgHeight'];
			// What is in the case the user has no if cap 'NextGEN Change options' ? Check feedback
			update_option('ngg_options', $ngg->options);
			
			$gallery_ids  = explode(',', $_POST['TB_imagelist']);
			// A prefix 'gallery_' will first fetch all ids from the selected galleries
			nggAdmin::do_ajax_operation( 'gallery_resize_image' , $gallery_ids, __('Resize images','nggallery') );
		}

		if (isset ($_POST['TB_bulkaction']) && isset ($_POST['TB_NewThumbnail']))  {
			
			check_admin_referer('ngg_thickbox_form');
			
			//save the new values for the next operation
			$ngg->options['thumbwidth']  = (int)  $_POST['thumbwidth'];
			$ngg->options['thumbheight'] = (int)  $_POST['thumbheight'];
			$ngg->options['thumbfix']    = (bool) $_POST['thumbfix']; 
			// What is in the case the user has no if cap 'NextGEN Change options' ? Check feedback
			update_option('ngg_options', $ngg->options);
			
			$gallery_ids  = explode(',', $_POST['TB_imagelist']);
			// A prefix 'gallery_' will first fetch all ids from the selected galleries
			nggAdmin::do_ajax_operation( 'gallery_create_thumbnail' , $gallery_ids, __('Create new thumbnails','nggallery') );
		}

	}

	function post_processor_images() {
		global $wpdb, $ngg, $nggdb;
		
		// bulk update in a single gallery
		if (isset ($_POST['bulkaction']) && isset ($_POST['doaction']))  {
			
			check_admin_referer('ngg_updategallery');
			
			switch ($_POST['bulkaction']) {
				case 'no_action';
					break;
				case 'rotate_cw':
					nggAdmin::do_ajax_operation( 'rotate_cw' , $_POST['doaction'], __('Rotate images', 'nggallery') );
					break;
				case 'rotate_ccw':
					nggAdmin::do_ajax_operation( 'rotate_ccw' , $_POST['doaction'], __('Rotate images', 'nggallery') );
					break;					
				case 'set_watermark':
					nggAdmin::do_ajax_operation( 'set_watermark' , $_POST['doaction'], __('Set watermark', 'nggallery') );
					break;
				case 'delete_images':
					if ( is_array($_POST['doaction']) ) {
						foreach ( $_POST['doaction'] as $imageID ) {
							$image = $nggdb->find_image( $imageID );
							if ($image) {
								if ($ngg->options['deleteImg']) {
									@unlink($image->imagePath);
									@unlink($image->thumbPath);	
								} 
								$delete_pic = nggdb::delete_image( $image->pid );
							}
						}
						if($delete_pic)
							nggGallery::show_message(__('Pictures deleted successfully ', 'nggallery'));
					}
					break;
				case 'import_meta':
					nggAdmin::do_ajax_operation( 'import_metadata' , $_POST['doaction'], __('Import metadata', 'nggallery') );
					break;
			}
		}

		if (isset ($_POST['TB_bulkaction']) && isset ($_POST['TB_ResizeImages']))  {
			
			check_admin_referer('ngg_thickbox_form');
			
			//save the new values for the next operation
			$ngg->options['imgWidth']  = (int) $_POST['imgWidth'];
			$ngg->options['imgHeight'] = (int) $_POST['imgHeight'];
			
			update_option('ngg_options', $ngg->options);
			
			$pic_ids  = explode(',', $_POST['TB_imagelist']);
			nggAdmin::do_ajax_operation( 'resize_image' , $pic_ids, __('Resize images','nggallery') );
		}

		if (isset ($_POST['TB_bulkaction']) && isset ($_POST['TB_NewThumbnail']))  {
			
			check_admin_referer('ngg_thickbox_form');
			
			//save the new values for the next operation
			$ngg->options['thumbwidth']  = (int)  $_POST['thumbwidth'];
			$ngg->options['thumbheight'] = (int)  $_POST['thumbheight'];
			$ngg->options['thumbfix']    = (bool) $_POST['thumbfix']; 
			update_option('ngg_options', $ngg->options);
			
			$pic_ids  = explode(',', $_POST['TB_imagelist']);
			nggAdmin::do_ajax_operation( 'create_thumbnail' , $pic_ids, __('Create new thumbnails','nggallery') );
		}
		
		if (isset ($_POST['TB_bulkaction']) && isset ($_POST['TB_SelectGallery']))  {
			
			check_admin_referer('ngg_thickbox_form');
			
			$pic_ids  = explode(',', $_POST['TB_imagelist']);
			$dest_gid = (int) $_POST['dest_gid'];
			
			switch ($_POST['TB_bulkaction']) {
				case 'copy_to':
				// Copy images
					nggAdmin::copy_images( $pic_ids, $dest_gid );
					break;
				case 'move_to':
				// Move images
					nggAdmin::move_images( $pic_ids, $dest_gid );
					break;
			}
		}
		
		if (isset ($_POST['TB_bulkaction']) && isset ($_POST['TB_EditTags']))  {
			// do tags update
	
			check_admin_referer('ngg_thickbox_form');
	
			// get the images list		
			$pic_ids = explode(',', $_POST['TB_imagelist']);
			$taglist = explode(',', $_POST['taglist']);
			$taglist = array_map('trim', $taglist);
			
			if (is_array($pic_ids)) {

				foreach($pic_ids as $pic_id) {
					
					// which action should be performed ?
					switch ($_POST['TB_bulkaction']) {
						case 'no_action';
						// No action
							break;
						case 'overwrite_tags':
						// Overwrite tags
							wp_set_object_terms($pic_id, $taglist, 'ngg_tag');
							break;					
						case 'add_tags':
						// Add / append tags
							wp_set_object_terms($pic_id, $taglist, 'ngg_tag', TRUE);
							break;
						case 'delete_tags':
						// Delete tags
							$oldtags = wp_get_object_terms($pic_id, 'ngg_tag', 'fields=names');
							// get the slugs, to vaoid  case sensitive problems
							$slugarray = array_map('sanitize_title', $taglist);
							$oldtags = array_map('sanitize_title', $oldtags);
							// compare them and return the diff
							$newtags = array_diff($oldtags, $slugarray);
							wp_set_object_terms($pic_id, $newtags, 'ngg_tag');
							break;
					}
				}
		
				nggGallery::show_message( __('Tags changed', 'nggallery') );
			}
		}
	
		if (isset ($_POST['updatepictures']))  {
		// Update pictures	
		
			check_admin_referer('ngg_updategallery');
		
			$gallery_title   = esc_attr($_POST['title']);
			$gallery_path    = esc_attr($_POST['path']);
			$gallery_desc    = esc_attr($_POST['gallerydesc']);
			$gallery_pageid  = (int) $_POST['pageid'];
			$gallery_preview = (int) $_POST['previewpic'];
			
			$wpdb->query("UPDATE $wpdb->nggallery SET title= '$gallery_title', path= '$gallery_path', galdesc = '$gallery_desc', pageid = '$gallery_pageid', previewpic = '$gallery_preview' WHERE gid = '$this->gid'");
	
			if (isset ($_POST['author']))  {		
				$gallery_author  = (int) $_POST['author'];
				$wpdb->query("UPDATE $wpdb->nggallery SET author = '$gallery_author' WHERE gid = '$this->gid'");
			}
	
			$this->update_pictures();
	
			//hook for other plugin to update the fields
			do_action('ngg_update_gallery', $this->gid, $_POST);
	
			nggGallery::show_message(__('Update successful',"nggallery"));
		}
	
		if (isset ($_POST['scanfolder']))  {
		// Rescan folder
			check_admin_referer('ngg_updategallery');
		
			$gallerypath = $wpdb->get_var("SELECT path FROM $wpdb->nggallery WHERE gid = '$this->gid' ");
			nggAdmin::import_gallery($gallerypath);
		}
	
		if (isset ($_POST['addnewpage']))  {
		// Add a new page
		
			check_admin_referer('ngg_updategallery');
			
			$parent_id      = esc_attr($_POST['parent_id']);
			$gallery_title  = esc_attr($_POST['title']);
			$gallery_name   = $wpdb->get_var("SELECT name FROM $wpdb->nggallery WHERE gid = '$this->gid' ");
			
			// Create a WP page
			global $user_ID;
	
			$page['post_type']    = 'page';
			$page['post_content'] = '[nggallery id=' . $this->gid . ']';
			$page['post_parent']  = $parent_id;
			$page['post_author']  = $user_ID;
			$page['post_status']  = 'publish';
			$page['post_title']   = $gallery_title == '' ? $gallery_name : $gallery_title;
			$page = apply_filters('ngg_add_new_page', $page, $this->gid);
	
			$gallery_pageid = wp_insert_post ($page);
			if ($gallery_pageid != 0) {
				$result = $wpdb->query("UPDATE $wpdb->nggallery SET title= '$gallery_title', pageid = '$gallery_pageid' WHERE gid = '$this->gid'");
				nggGallery::show_message( __('New gallery page ID','nggallery'). ' ' . $pageid . ' -> <strong>' . $gallery_title . '</strong> ' .__('created','nggallery') );
			}
		}
	}
	
	function update_pictures() {
		global $wpdb;

		//TODO:Error message when update failed
		//TODO:Combine update in one query per image
		
		$description = 	$_POST['description'];
		$alttext = 		$_POST['alttext'];
		$exclude = 		$_POST['exclude'];
		$taglist = 		$_POST['tags'];
		$pictures = 	$_POST['pid'];
		
		if ( is_array($description) ) {
			foreach( $description as $key => $value ) {
				$desc = $wpdb->escape($value);
				$wpdb->query( "UPDATE $wpdb->nggpictures SET description = '$desc' WHERE pid = $key");
			}
		}
		if ( is_array($alttext) ){
			foreach( $alttext as $key => $value ) {
				$alttext = $wpdb->escape($value);
				$wpdb->query( "UPDATE $wpdb->nggpictures SET alttext = '$alttext' WHERE pid = $key");
			}
		}

		if ( is_array($pictures) ){
			foreach( $pictures as $pid ){
				$pid = (int) $pid;
				if (is_array($exclude)){
					if ( array_key_exists($pid, $exclude) )
						$wpdb->query("UPDATE $wpdb->nggpictures SET exclude = 1 WHERE pid = '$pid'");
					else 
						$wpdb->query("UPDATE $wpdb->nggpictures SET exclude = 0 WHERE pid = '$pid'");
				} else {
					$wpdb->query("UPDATE $wpdb->nggpictures SET exclude = 0 WHERE pid = '$pid'");
				}
			}
		}

		if ( is_array($taglist) ){
			foreach($taglist as $key=>$value) {
				$tags = explode(',', $value);
				wp_set_object_terms($key, $tags, 'ngg_tag');
			}
		}
		
		return;
	}

	// Check if user can select a author
	function get_editable_user_ids( $user_id, $exclude_zeros = true ) {
		global $wpdb;
	
		$user = new WP_User( $user_id );
	
		if ( ! $user->has_cap('NextGEN Manage others gallery') ) {
			if ( $user->has_cap('NextGEN Manage gallery') || $exclude_zeros == false )
				return array($user->id);
			else
				return false;
		}
	
		$level_key = $wpdb->prefix . 'user_level';
		$query = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = '$level_key'";
		if ( $exclude_zeros )
			$query .= " AND meta_value != '0'";
	
		return $wpdb->get_col( $query );
	}
	
	function search_images() {
		global $nggdb;
		
		if ( empty($_GET['s']) )
			return;
		//on what ever reason I need to set again the query var
		set_query_var('s', $_GET['s']);
		$request = get_search_query();
		// looknow for the images
		$this->search_result = $nggdb->search_for_images( $request );
		// show pictures page
		$this->mode = 'edit'; 
	}
}
?>