
        <section id="router" title="Router">
          <div class="page-header">
            <h1>Router</h1>
          </div>

          <p class="lead">Dynamically manage page state with the havok router.</p>

          <p>The router lets you manage the browser location for simple dynamic page loading, without having to use # hacks.</p>

          <h2>Example</h2>

          <p>These docs pages use the router. The first page you load will deliver a full html page. Any links you click after that will only load new content. It will not reload the top menu footer, css, or js. Moreover, if you go back to a page you have already visited, it will load very quickly because the havok documentation controller caches previously loaded content. And, all this is done with static pages, no logic on the server at all.</p>

          <p>Try it out. Click on 'Getting Started' in the site, menu, and then click 'Services' to get back here.</p>

          <h2>How it works</h2>

          <p>Once a router is started, it will listen to every click event that bubbles up to <code>document.body</code>. If the click event is on a link (<code>A</code> tag) then it will be processed by the router.</p>

          <p>The router will attempt to match the <code>href</code> attribute of the tag with one of it's configured routes. If a match is found, the controller on the configured route is called. If a match is not found, the click event is allowed to continue bubbling.</p>

          <h2>Router Configuration</h2>

          <p>The router is configured through a <code>havok/di/di</code> instance. See the DI docs for general di info.</p>

          <p>The router can be configured with an array of routes. The routes will be evaluated in reverse order (fifo). The first matching route will be used. Each route has these properties:</p>

<table class="table table-bordered table-striped">
  <thead>
   <tr>
     <th style="width: 100px;">name</th>
     <th style="width: 50px;">type</th>
     <th>description</th>
   </tr>
  </thead>
  <tbody>
    <tr>
        <td>regex</td>
        <td>string</td>
        <td>Used to test if the requested href matches with this route.</td>
    </tr>
    <tr>
        <td>controller</td>
        <td>string</td>
        <td>The name of a controller instance that can be retrieved through the di container.</td>
    </tr>
    <tr>
        <td>defaultMethod</td>
        <td>string</td>
        <td>The name of the method to call on the controller if there is no method match.</td>
    </tr>
    <tr>
        <td>methods</td>
        <td>object</td>
        <td>An array of route to method name pairs.</td>
    </tr>
  </tbody>
</table>

          <h3>Example</h3>

          <p>A router config:</p>
<pre class="prettyprint linenums">
di: {
    'havok/router/router': {
        params: {
            routes: [
                {
                    regex: /index.html/,
                    controller: 'my/index/controller',
                    defaultMethod: 'home'
                },
                {
                    regex: /login/,
                    controller: 'my/login/controller',
                    defaultMethod: 'login',
                    methods: [
                        {'logout': 'logout'}
                    ]
                },
                {
                    regex: /albums/,
                    controller: 'my/albums/controller',
                    defaultMethod: 'list',
                    methods: {
                        'new': 'create',
                        'update': 'update'
                    }
                }
            ]
        }
    }
}
</pre>

          <p>The above router config will call the methods in the following way:</p>

<pre class="prettyprint linenums">
index.html -> myIndexController.home()
user -> myLoginController.user()
user/login -> myLoginController.login()
user/logout -> myLoginController.logout()
albums -> myAlbumController.list()
albums/list -> myAlbumController.list()
albums/new -> myAlbumController.new()
albums/new/newAlbumName -> myAlbumController.list('newAlbumName')
albums/update -> myAlbumController.update()
albums/update/oldAlbumName -> myAlbumController.list('oldAlbumName')
</pre>

          <h2>Starting the router</h2>

          <p>The router can be started like this:</p>
<pre class="prettyprint linenums">
require(['havok/get!havok/router/router'],
function (router){
    router.startup();
});
</pre>

          <p>Alternately, the router can be started with the AMD plugin:</p>
<pre class="prettyprint linenums">
require(['havok/router/started!'],
function (){
    //do something
});
</pre>

          <p>Note: if you are using the router, it is recommended you start it up when the page first loads.</p>

          <h2>Base Url</h2>

          <p>Router routes are evaluated relative to the Base Url. By default the base url is set when you first start the router to whatever the current page address is. However, this will not work if the first page you load on your site is not a the top level of the site's directory structure. In such cases, you will need to specify the Base Url in config:</p>
<pre class="prettyprint linenums">
di: {
    'havok/router/router': {
        params: {
            baseUrl: 'my/site',
            ...
        }
    }
}
</pre>

          <p>You can retrieve the baseUrl in code using the baseUrl AMD plugin:</p>
<pre class="prettyprint linenums">
require(['havok/router/baseUrl!'],
function (baseUrl){
    //do something
});
</pre>

          <h2>Arguments</h2>

          <p>Arguments can be passed to a controller method through the route. Routes take the following form:</p>

<pre class="prettyprint linenums">
&lt;controllerRegexMatch&gt;/&lt;method&gt;/&lt;arg1&gt;/&lt;arg2&gt;/&lt;arg3&gt;
</pre>

          <p>For example, this config and controller could be used to add numbers together:</p>

          <p>The config:</p>
<pre class="prettyprint linenums">
di: {
    'havok/router/router': {
        params: {
            routes: [
                {
                    regex: /math/,
                    controller: 'my/math',
                    methods: {
                        'add': 'add'
                    }
                }
            ]
        }
    }
}
</pre>

          <p>The controller:</p>
<pre class="prettyprint linenums">
define(['dojo/_base/declare'],
function(declare){
    return declare([], {
        add: function(a, b){
            console.debug(a + b);
        }
    )
})
</pre>

          <p>The markup:</p>
<pre class="prettyprint linenums">
&lt;a href=&quot;math/add/1/6&quot;&gt;Add 1 and 6&lt;/a&gt;
</pre>

          <p>If the link were clicked, the number 7 would be printed in the console.</p>

          <h2>Exit methods</h2>

          <p>Exit methods can be defined for controllers. They are methods which will be called when a route is being left. Eg:</p>
<pre class="prettyprint linenums">
di: {
    'havok/router/router': {
        params: {
            routes: [
                {
                    regex: /math/,
                    controller: 'my/math',
                    defaultMethod: {
                        enter: 'add',
                        exit: 'cleanup'
                    }
                    methods: {
                        'subtract': {
                            enter: 'subtract',
                            exit: 'anotherMethod'
                        }
                    }
                }
            ]
        }
    }
}
</pre>

          <h2>Scripting a page change</h2>
          <p>The router can be triggered in code using the <code>go</code> function:</p>
<pre class="prettyprint linenums">
require(['havok/router/started!'],
function (router){
    router.go('my/route');
});
</pre>

          <h2>Forward and Back</h2>

          <p>The router can go forward and back in history by passing an integer to <code>go</code>. Eg:</p>
<pre class="prettyprint linenums">
require(['havok/router/started!'],
function (router){
    router.go(-1); //go back one
    router.go(-3); //go back three
    router.go(1); //go forward one
});
</pre>

        </section>
