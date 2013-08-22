
        <section id="proxies" title="proxies">
          <div class="page-header">
            <h1>Proxies</h1>
          </div>

<p class="lead">Objects to proxy, then inject</p>

<p>Proxy objects can be injected with exactly the same synatx as <code>gets</code>, the only difference being a proxy is injected instead of the actual object.</p>

<p>For example:</p>
<pre class="prettyprint linenums">
'my/zoo': {
    proxy: {
       lion: 'my/lion/module',
       tiger1: {
            base: 'my/tiger/module',
            params: {
                name: 'Toby'
       },
       tiger2: {
            base: 'my/tiger/module',
            params: {
                name: 'Alice'
       }
    }
}
</pre>

<p>For information on proxy object and why you might use them, see the Proxy Objects section.</p>

        </section>