<?php
/*
Template Name: Locations
*/
?>

<?php get_header() ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Locations</li>
</ul>
</div>
</div>

<div id="locations-map"></div>

</div><!-- #box -->

<div class="line-long"></div>

<p class="zero">We're hard at work adding future locations. We're currently available in <a href="http://www.hobokenmommies.com">Hoboken, NJ</a></p>

<div class="line-long"></div>

<div id="left">

<div class="small-box">

<h3>California</h3>
<p><a href="#" class="dark-button">San Francisco</a></p>

<h3>Connecticut</h3>
<p><a href="#" class="dark-button">Greenwich</a></p>

<h3>Florida</h3>
<p><a href="#" class="dark-button">Palm Beach</a></p>

<h3>New Jersey</h3>
<p><a href="#" class="dark-button">Bergen County</a> 
<a href="#" class="dark-button">Chatham</a> 
<a href="#" class="dark-button">Franklin Lakes</a> 
<a href="<?php echo site_url() ?>/" class="pink-button">Hoboken</a> 
<a href="#" class="dark-button">Jersey City</a>
<a href="#" class="dark-button">Jersey Shore</a>
<a href="#" class="dark-button">Marlboro</a> 
<a href="#" class="dark-button">Montclair</a> 
<a href="#" class="dark-button">Short Hills</a> 
<a href="#" class="dark-button">Westfield</a></p>

</div>
</div>

<div id="right">

<div class="small-box">

<h3>New York</h3>
<p><a href="#" class="dark-button">Brooklyn</a> 
<a href="#" class="dark-button">Central New York</a> 
<a href="#" class="dark-button">Five Towns</a> 
<a href="#" class="dark-button">Queens</a></p>

<h3>Texas</h3>
<p><a href="#" class="dark-button">Dallas</a></p>

<h3>Washington,DC</h3>
<p><a href="#" class="dark-button">DC</a></p>

</div>
</div>

</div><!-- #column-one -->

<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adspages') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>

</div><!-- #column-two -->


<?php get_footer(); ?>