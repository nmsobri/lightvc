<?php
$this->setLayoutVar('pageTitle', 'LightVC Skeleton App');
?>

<h1>Skeleton App</h1>

<p>You have a skeleton app setup with reasonable defaults.</p>
<p>You can customize these defaults setting (specified in <span class="path">configs/application.php</span> file).</p>

<p>This skeleton app uses mod_rewrite (specified in the <span class="path">/.htaccess</span> file).</p>
<p>Routes (specified in <span class="path">configs/routes.php</span>) are sets up  out of the box:</p>

<ul>
	<li>"/" activate controller <b>Page Controller</b> and  action <b>ActionView</b> with "home" for the pageName parameter.</li>
	<li>"/page/about" activate controller <b>Page controller</b> and action <b>ActionView</b> with "about" for the pageName parameter.</li>
	<li>"/user/edit/22" activate controller <b>User controller</b>  and action <b>ActionEdit</b> with the remaining URL used to populate the action method's arguments.</li>
</ul>

<p>If you need to, consult LightVC documentation on <a href="http://lightvc.org/docs/user_guide/configuration/web_server/">configuring your web server</a>, such as how to setup lighttpd rewrite rules.</p>

<h2>Your action items:</h2>

<ul>
	<li>Customize and add layouts to <span class="path">views/layouts/</span>.</li>
	<li>Customize and add styles to <span class="path">assets/css/</span>.</li>
	<li>Customize and add static pages in <span class="path">views/page/</span>.</li>
	<li>
		Create new controllers in <span class="path">controllers/</span>.
		<ul class="note">
			<li>There is already an AppController (<span class="path">classes/AppController.class.php</span>) which is specifying the default layout and CSS to use across all controllers.</li>
		</ul>
	</li>
	<li>Add to your application level config in <span class="path">configs/application.php</span>.</li>
	<li>Add to your route config in <span class="path">configs/routes.php</span>.</li>
	<li>Add your own model/ORM (e.g. <a href="http://coughphp.anthonybush.com/">CoughPHP</a>, <a href="http://propel.phpdb.org/trac/">Propel</a>, <a href="http://en.wikipedia.org/wiki/List_of_object-relational_mapping_software#PHP">etc.</a>).</li>
</ul>

<p>Have Fun!<br /><a href="http://lightvc.org/">LightVC Website</a></p>
