<section id="download-havok" title="Download Havok">
  <div class="page-header">
    <h1>Download Havok</h1>
  </div>
  <p class="lead">Get havok files</p>

    <h2>Quick and Dirty</h2>
	<p>If you just want to take havok for a quick spin, the simplest way is to download the two havok distribution files. These contain all of havok, and much of dojo. They are big and heavy, but it's a simple way to try things out:</p>

    <ul>
        <li><a href="https://github.com/zoopcommerce/havok/blob/master/dist/havok.js">havok.js</a></li>
        <li><a href="https://github.com/zoopcommerce/havok/blob/master/dist/havok.css">havok.css</a></li>
    </ul>

	<h2>Full sources with composer (recommended)</h2>
    <p>Havok supports composer to install itself and all dependencies in the right locations ready to develop with havok. Get composer with:</p>

<pre>
curl -sS https://getcomposer.org/installer | php
</pre>

    <p>Then add the following composer.json file to the root of your project:</p>
<pre>
{
    "name": "my/project",
    "repositories": [{ "type": "composer", "url": "http://zoopcommerce.github.io/pixie"}],
    "require": {"havok/havok" : "~1.0"},
    "extra": {"zoop-js-path": "public/js"}
}
</pre>

    <p>Then run composer in your project root:</p>
<pre>
php composer.phar update
</pre>
    
    <p>Havok and dependencies will be insalled into <code>myproject/vendor</code> and symlinked to <code>myproject/public/js</code></p>

    <h2>Full sources manual install (advanced)</h2>

    <p>In your the folder where you want havok installed, run the following commands:</p>

<pre>
git clone http://github.com/zoopcommerce/havok
git clone http://github.com/dojo/dojo
git clone http://github.com/dojo/dijit
git clone http://github.com/dojo/util
git clone http://github.com/zoopcommerce/mystique
</pre>

    <p>Then go into each of the five repos and checkout the version tag you want.</p>

    <p>Then make <code>mystique/js/mystique</code> loadable by dojo. You may do this by deleting the rest of the mystique repo and moving to the same directory as havok and dojo, or by through a dojoConfig package path.</p>

</section>
