<?php

// get the root menu item  
    function remove_folders_from_url($url) {
        $info = parse_url($url);
        $new_path = dirname($info['path']);

        $new_url = "";

        if (!empty($info["host"]))     $new_url .= "http://" . $info["host"];
        if (!empty($info["path"]))     $new_url .= $new_path . "/";        
        if (!empty($info["query"]))    $new_url .= "?".$info["query"];
        if (!empty($info["fragment"])) $new_url .= "#".$info["fragment"];

        return $new_url;
    }
 
    function get_root_menu_item() {
        /* try a bunch of urls to find what we need */
        $menu = wp_get_nav_menu_items('Main Menu');

        $urls = array (
            $_SERVER['REQUEST_URI'],
            site_url() . $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_URI'] . '/',
            site_url() . $_SERVER['REQUEST_URI'] . '/' 
        );

        foreach($urls as $url) {
            $menu_item = get_root_menu_item_for_url( $menu, $url );
            if ($menu_item) return $menu_item;
        }

        // nothing? try chopping a folder off the end and see if that page exists
        foreach($urls as $url) {
            $menu_item = get_root_menu_item_for_url( $menu, remove_folders_from_url( $url ) );
            if ($menu_item) return $menu_item;
        }

        // still nothing? sad :<
    }

    function get_root_menu_item_for_url($menu, $url) {
	    
        //$menu_item = array_pop ( wp_filter_object_list( (array) $menu, array( 'url' => $url ) ) );
        $menu_item = wp_filter_object_list( (array) $menu, array( 'url' => $url ) );
        $menu_item = array_pop($menu_item);
        //$menu_item = wp_filter_object_list( (array) $menu, array( 'url' => $url ) );
        

		if ($menu_item) {
	        while($menu_item->menu_item_parent != 0) {
	            $menu_item = array_pop ( wp_filter_object_list( (array) $menu, array( 'ID' => $menu_item->menu_item_parent ) ) );
	        }
	
	        return $menu_item;
		}
    }

// add support for submenu filtering with wp_nav_menu
    add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

    function submenu_limit( $items, $args ) {
        if ( empty($args->submenu) )
            return $items;

        $parent_id = $args->submenu; //array_pop( wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' ) );
        $children  = submenu_get_children_ids( $parent_id, $items );

        foreach ( $items as $key => $item ) {
            if ( ! in_array( $item->ID, $children ) )
                unset($items[$key]);
        }

        return $items;
    }

    function submenu_get_children_ids( $id, $items ) {
        $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );

        foreach ( $ids as $id ) {
            $ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
        }

        return $ids;
    }
