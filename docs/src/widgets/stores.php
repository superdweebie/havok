<section id="stores" title="Stores">
  <div class="page-header">
    <h1>Stores</h1>
  </div>

  <p>Many of the havok widgets can optionally use the <code>havok/widget/_StoreMixin</code> to manage lists of items. Stores allow great flexibility. Items may be fetched via ajax, filtered, sorted, and reused throughout your application.</p>

  <h2>Nav example</h2>

    <div class="bs-docs-example">
        <datalist id="navStore1">
            <option>home</option>
            <option href="#stores">#navs anchor</option>
            <option disabled=true>disabled pill</option>
        </datalist>
        <nav-pill
            mixins = "store"
            active = 0
            store  = "navStore1"
        ></nav-pill>
    </div>
<pre class="prettyprint linenums">

</pre>

          <h3>Nav dropdowns created from a store</h3>
          <p>Using a store, add dropdown menus with the <code>type: 'dropdown'</code> property.</p>
          <div class="bs-docs-example">
            <datalist id="navStore2">
                <option>home</option>
                <optgroup label="help <b class='caret'></b>">
                    <option>action</option>
                    <option>another action</option>
                    <option>something else</option>
                    <option type="divider">
                    <optgroup label="deeper submenu">
                        <option>deep menu 1</option>
                        <option>deep menu 2</option>
                    </optgroup>
                </optgroup>
            </datalist>
              <nav-pill store="navStore2" mixins="store" active=0></nav-pill>
          </div>
<pre class="prettyprint linenums">

</pre>

    <h4>Nested dropdown example</h4>
    <p>Use the <code>type: 'dropdown'</code> to mark parent items. Use <code>parent: id</code> property to specify child items in the store. Now that's nice syntax!</p>

    <div class="bs-docs-example bs-docs-example-submenus">
        <div class="dropdown clearfix">
            <datalist id="dropdownStore1">
                <option>Action</option>
                <option>Another Action</option>
                <option>Something else here</option>
                <option type="divider">
                <optgroup label="More options">
                    <option>Second level link</option>
                    <option>Second level link</option>
                    <option>Second level link</option>
                    <option>Second level link</option>
                </optgroup>
            </datalist>
            <dropdown
                mixins = "store"
                store  = "dropdownStore1"
            ></dropdown>
        </div>
    </div>

<pre class="prettyprint linenums">

</pre>

<
          <h3>Store nav list Example</h3>
          <p>If using a store, set <code>type: 'nav-header'</code> to create headers:</p>
          <div class="bs-docs-example">
            <div class="well" style="max-width: 340px; padding: 8px 0;">
                <datalist id="navListStore1">
                    <option type="nav-header">List header</option>
                    <option>Home</option>
                    <option>Library</option>
                    <option>Applications</option>
                    <option type="nav-header">Another list header</option>
                    <option>Profile</option>
                    <option>Settings</option>
                    <option type="divider">
                    <option>Help</option>
                </datalist>
              <nav-list mixins="store" store="navListStore1">
              </nav-list>
            </div>
          </div>
<pre class="prettyprint linenums">

</pre>


  <!--
  <h2>Examples</h2>

    <h3>Declative store</h3>
    <p>Store data may be passed in using the <code>data-dojo-props</code> attribute</p>
    <div class="bs-docs-example">
        <div class="dropdown clearfix">
          <ul data-dojo-type="havok/widget/Dropdown"
              data-dojo-props="store: {
                  data: [
                      {id: 0, text: 'Action'},
                      {id: 1, text: 'Another Action'},
                      {id: 2, text: 'Something else here'},
                      {id: 3, type: 'divider'},
                      {id: 4, href: '#dropdowns', text: 'Dropdowns'}
                  ]
              }"
              style="display: block; position: static; margin-bottom: 5px; *width: 180px;"
          ></ul>
        </div>
    </div>
<pre class="prettyprint linenums">
&lt;ul data-dojo-type=&quot;havok/widget/Dropdown&quot;
    data-dojo-props=&quot;store: {
        data: [
            {id: 0, text: 'Action'},
            {id: 1, text: 'Another Action'},
            {id: 2, text: 'Something else here'},
            {id: 3, type: 'divider'},
            {id: 4, href: '#dropdowns', text: 'Dropdowns'}
        ]
    }&quot;
&gt;&lt;/ul&gt;
</pre>

    <h3>Programatic store</h3>
    <p>A store can be created progamatically and passed to the widget. Eg:</p>
    <div class="bs-docs-example">
      <div id="dropdown2" class="dropdown clearfix"></div>
    <script type="text/javascript">
        require(
            ['dojo/dom', 'havok/widget/Dropdown', 'dojo/store/Memory', 'dojo/domReady!'],
            function(dom, Dropdown, Memory){
                var dropdown = new Dropdown({ //create a new instance of the Dropdown widget
                    store: new Memory({ //create a new instance of a Memory store for the dropdown widget to consume
                        data: [
                            {id: 0, text: 'Action'},
                            {id: 1, text: 'Another Action'},
                            {id: 2, text: 'Something else here'},
                            {id: 3, type: 'divider'},
                            {id: 4, href: '#dropdowns', text: 'Dropdowns'}
                        ]
                    }),
                    style: 'display: block; position: static; margin-bottom: 5px; *width: 180px;'
                });
                dom.byId('dropdown2').appendChild(dropdown.domNode); //add the dropdown to the dom
                dropdown.startup(); //call startup on the dropdown
            }
        )
    </script>
    </div>
<pre class="prettyprint linenums">
&lt;div id=&quot;dropdown2&quot;&gt;&lt;/div&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
  require(
      ['dojo/dom', 'havok/widget/Dropdown', 'dojo/store/Memory', 'dojo/domReady!'],
      function(dom, Dropdown, Memory){
          var dropdown = new Dropdown({ //create a new instance of the Dropdown widget
              store: new Memory({ //create a new instance of a Memory store for the dropdown widget to consume
                  data: [
                      {id: 0, text: 'Action'},
                      {id: 1, text: 'Another Action'},
                      {id: 2, text: 'Something else here'},
                      {id: 3, type: 'divider'},
                      {id: 4, href: '#dropdowns', text: 'Dropdowns'}
                  ]
              })
          });
          dom.byId('dropdown2').appendChild(dropdown.domNode); //add the dropdown to the dom
          dropdown.startup(); //call startup on the dropdown
      }
  )
&lt;/script&gt;

</pre>

          <h3>Store from the Store Manager</h3>
          <p>The store manager allows data store to be easily interchanged and injected into store consumers. To use a store from the manager, set the store property to the name used to register that store with the manager. Eg:</p>
          <div class="bs-docs-example">
            <div class="dropdown clearfix">
                <ul data-dojo-type="havok/widget/Dropdown"
                    data-dojo-props="store: 'dropdownStore'"
                    style="display: block; position: static; margin-bottom: 5px; *width: 180px;"
                ></ul>
                <script type="text/javascript">
                    require([
                        'havok/get!havok/store/manager', //get the store manager instance from the havok dependency injection container
                        'dojo/store/Memory'
                    ],
                        function(storeManager, Memory){
                            storeManager.stores.dropdownStore = new Memory({ //add a new store to the store manager
                                name: 'dropdownStore', //give the store a name so it can be fetched with that name
                                data: [
                                    {id: 0, text: 'Action'},
                                    {id: 1, text: 'Another Action'},
                                    {id: 2, text: 'Something else here'},
                                    {id: 3, type: 'divider'},
                                    {id: 4, href: '#dropdowns', text: 'Dropdowns'}
                                ]
                            })
                        }
                    )
                </script>
            </div>
          </div>
<pre class="prettyprint linenums">
&lt;ul data-dojo-type=&quot;havok/widget/Dropdown&quot;
    data-dojo-props=&quot;store: 'dropdownStore'&quot;
&gt;&lt;/ul&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
    require([
        'havok/get!havok/store/manager', //get the store manager instance from the havok dependency injection container
        'dojo/store/Memory'
    ],
        function(storeManager, Memory){
            storeManager.stores.push( //add a new store to the store manager
                new Memory({
                    name: 'dropdownStore', //give the store a name so it can be fetched with that name
                    data: [
                        {id: 0, text: 'Action'},
                        {id: 1, text: 'Another Action'},
                        {id: 2, text: 'Something else here'},
                        {id: 3, type: 'divider'},
                        {id: 4, href: '#dropdowns', text: 'Dropdowns'}
                    ]
                })
            );
        }
    )
&lt;/script&gt;
</pre>

    <h3>Implicit store</h3>
    <p>If no store is set by one of the above methods, a store is created implicitly from the markup. For example, in the Dropdown widget each <code>li</code> becomes an item in the store.</p>


    <h2>Store queries</h2>
    <p>Any store can be filtered by setting a query on the store.</p>

    <h3>Basic example</h3>
    <p>This query will filter so only items with <code>A</code> in the text will display:</p>
    <div class="bs-docs-example">
      <div class="dropdown clearfix">
        <ul data-dojo-type="havok/widget/Dropdown"
            data-dojo-props="
              query: {text: /^.*A.*$/},
              store: {
                  data: [
                      {id: 0, text: 'Action'},
                      {id: 1, text: 'Another Action'},
                      {id: 2, text: 'Something else here'},
                      {id: 3, type: 'divider'},
                      {id: 4, text: 'Separated Link'}
                  ]
              }
            "
            style="display: block; position: static; margin-bottom: 5px; *width: 180px;"
        >
        </ul>
      </div>
    </div>
<pre class="prettyprint linenums">
&lt;ul data-dojo-type=&quot;havok/widget/Dropdown&quot;
    data-dojo-props=&quot;
      query: {text: /^.*A.*$/},
      store: {
          data: [
              {id: 0, text: 'Action'},
              {id: 1, text: 'Another Action'},
              {id: 2, text: 'Something else here'},
              {id: 3, type: 'divider'},
              {id: 4, text: 'Separated Link'}
          ]
      }
    &quot;
&gt;
&lt;/ul&gt;
</pre>

    <h3>Queries on an implicit store</h3>
    <p>Implicitly created stores can also be queried. Eg:</p>
    <div class="bs-docs-example">

      <div class="dropdown clearfix">
        <ul data-dojo-type="havok/widget/Dropdown"
          data-dojo-props="
              query: {text:  /^.*A.*$/}
          "
          style="display: block; position: static; margin-bottom: 5px; *width: 180px;"
        >
          <li><a href="">Action</a></li>
          <li><a href="">Another action</a></li>
          <li><a href="">Something else here</a></li>
          <hr />
          <li><a href="">Separated link</a></li>
        </ul>
      </div>
    </div>
<pre class="prettyprint linenums">
&lt;ul data-dojo-type=&quot;havok/widget/Dropdown&quot;
  data-dojo-props=&quot;
      query: {text:  /^.*A.*$/}
  &quot;
&gt;
  &lt;li&gt;&lt;a href=&quot;&quot;&gt;Action&lt;/a&gt;&lt;/li&gt;
  &lt;li&gt;&lt;a href=&quot;&quot;&gt;Another action&lt;/a&gt;&lt;/li&gt;
  &lt;li&gt;&lt;a href=&quot;&quot;&gt;Something else here&lt;/a&gt;&lt;/li&gt;
  &lt;br /&gt;
  &lt;li&gt;&lt;a href=&quot;&quot;&gt;Separated link&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
</pre>

         <h2>Store query options</h2>

          <p>Query options can be set to control <code>start</code> <code>count</code> and <code>sort</code>. Eg:</p>
          <div class="bs-docs-example">
            <div class="dropdown clearfix">
              <ul data-dojo-type="havok/widget/Dropdown"
                  data-dojo-props="
                    queryOptions: {
                        start: 1,
                        count: 3,
                        sort: [{attribute: 'text', descending: true}]
                    },
                    store: {
                        data: [
                            {id: 0, text: '0'},
                            {id: 1, text: '1'},
                            {id: 2, text: '2'},
                            {id: 3, text: '3'},
                            {id: 4, text: '4'},
                            {id: 5, text: '5'},
                            {id: 6, text: '6'}
                        ]
                    }
                  "
                style="display: block; position: static; margin-bottom: 5px; *width: 180px;"
              >
              </ul>
            </div>
          </div>
<pre class="prettyprint linenums">
&lt;ul data-dojo-type=&quot;havok/widget/Dropdown&quot;
    data-dojo-props=&quot;
      queryOptions: {
          start: 1,
          count: 3,
          sort: [{attribute: 'text', descending: true}]
      },
      store: {
          data: [
              {id: 0, text: '0'},
              {id: 1, text: '1'},
              {id: 2, text: '2'},
              {id: 3, text: '3'},
              {id: 4, text: '4'},
              {id: 5, text: '5'},
              {id: 6, text: '6'}
          ]
      }
    &quot;
&gt;
&lt;/ul&gt;
</pre>
-->
</section>
