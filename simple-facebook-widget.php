<?php
/* Plugin Name: Simple Facebook Widget
Plugin URI: http://wordpress.org/plugins/simple-facebook-widget/
Description: Simple Facebook Widget Plugin lets you easily embed and promote your Facebook Page on your website. You can easily collect fan for your pages.
Version: 1.0
Author: MonjurulHoque
Author URI: http://monjurulhoque.com
*/

class SimpleFacebookWidget extends WP_Widget{
    
    public function __construct() {
        $params = array(
            'description' => 'Thanks for installing Facebook Widget',
            'name' => 'Simple Facebook Widget'
        );
        parent::__construct('SimpleFacebookWidget','',$params);
    }
    
    public function form($instance) {
        extract($instance);
        
        ?>


<p>
    <label for="<?php echo $this->get_field_id('title');?>">Title : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('title');?>"
	name="<?php echo $this->get_field_name('title');?>"
        value="<?php echo !empty($title) ? $title : "Simple Facebook Widget"; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('sfbw_url');?>">Facebook Page URL : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('sfbw_url');?>"
	name="<?php echo $this->get_field_name('sfbw_url');?>"
        value="<?php echo !empty($sfbw_url) ? $sfbw_url : "https://www.facebook.com/MonjurulHoquePhoto"; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('width');?>">Width : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('width');?>"
	name="<?php echo $this->get_field_name('width');?>"
        value="<?php echo !empty($width) ? $width : "300"; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('height');?>">Height : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('height');?>"
	name="<?php echo $this->get_field_name('height');?>"
        value="<?php echo !empty($height) ? $height : "600"; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'face' ); ?>">Show Faces:</label> 
    <select id="<?php echo $this->get_field_id( 'face' ); ?>"
        name="<?php echo $this->get_field_name( 'face' ); ?>"
        class="widefat" style="width:100%;">
            <option value="true" <?php if ($face == 'true') echo 'selected="true"'; ?> >Yes</option>
            <option value="false" <?php if ($face == 'false') echo 'selected="false"'; ?> >No</option>	
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'header' ); ?>">Hide Cover:</label> 
    <select id="<?php echo $this->get_field_id( 'header' ); ?>"
        name="<?php echo $this->get_field_name( 'header' ); ?>"
        class="widefat" style="width:100%;">
            <option value="false" <?php if ($face == 'header') echo 'selected="header"'; ?> >No</option>
            <option value="true" <?php if ($face == 'header') echo 'selected="header"'; ?> >Yes</option>	
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'post' ); ?>">Show Post:</label> 
    <select id="<?php echo $this->get_field_id( 'post' ); ?>"
        name="<?php echo $this->get_field_name( 'post' ); ?>"
        class="widefat" style="width:100%;">
            <option value="true" <?php if ($post == 'true') echo 'selected="true"'; ?> >Yes</option>
            <option value="false" <?php if ($post == 'false') echo 'selected="false"'; ?> >No</option>	
    </select>
</p>

<?php
    }
    
    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        $title = apply_filters('widget_title', $title);
        $description = apply_filters('widget_description', $description);
		if(empty($title)) $title = "Simple Facebook Widget";
        if(empty($sfbw_url)) $sfbw_url = "https://www.facebook.com/MonjurulHoquePhoto";
        if(empty($width)) $width = "300";
        if(empty($height)) $height = "600";
        if(empty($face)) $face = "true";
        if(empty($header) || $header == '') $header = "false";
        if(empty($post)) $post = "true";
        
        
        echo $before_widget;
            echo $before_title . $title . $after_title;
            
            ?>

  <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
         <div class="facebook_widget_plus">

	     <div class="fb-page" data-href="<?php echo $sfbw_url;?>"
             data-width="<?php echo $width;?>"
             data-height="<?php echo $height;?>" 
             data-small-header="false" data-adapt-container-width="true" 
             data-hide-cover="<?php echo $header; ?>" 
             data-show-facepile="<?php echo $face; ?>" 
             data-show-posts="<?php echo $post; ?>"><div class="fb-xfbml-parse-ignore">
                <blockquote cite="<?php echo $sfbw_url;?>">
                    <a href="<?php echo $sfbw_url;?>">Facebook</a></blockquote></div></div>
		
	</div>
	<?php
        echo $after_widget;
    }
}

add_action('widgets_init','register_SimpleFacebookWidget');
function register_SimpleFacebookWidget(){
    register_widget('SimpleFacebookWidget');
}