<?php

function loadmore_ajax_handler(){
   //Prepare our arguments for the query
    $args = json_decode(stripslashes($_POST["query"]), true);
    $args["paged"] = $_POST["page"] + 1; // we need next page to be loaded
    $args["post_status"] = "publish";

    //It is always better to use WP_Query but not here
    query_posts($args);
    if (have_posts()):
        //Run the loop
        while (have_posts()):
            the_post();
            //Look into your theme code and how the posts are inserted, but you can use your own HTML of course
            // do you remember? - my example is adapted for Twenty Seventeen theme
            get_template_part("template-parts/post/content", get_post_format());
            //For the purposes comment on the line above and uncomment the below one
            // the_title();
        endwhile;
    endif;
    die(); // here we exit the script and even no wp_reset_query() required!
}

add_action("wp_ajax_loadmore", "loadmore_ajax_handler"); // wp_ajax_{action}
add_action("wp_ajax_nopriv_loadmore", "loadmore_ajax_handler"); // wp_ajax_nopriv_{action}
