
        <section id="modals" title="Modals">
          <div class="page-header">
            <h1>Modals</h1>
          </div>

          <p>For simple modals use <code>havok/widget/Modal</code>.</p>

          <h3>Live Demo</h3>
          <div class="bs-docs-example">
              <script>
                  require(['dojo/on', 'dojo/dom', 'dijit/registry', 'dojo/domReady!'],
                       function(on, dom, registry){
                            on(dom.byId('modalButton1'), 'click', function(){
                                var modal = registry.byId('modal1');
                                    modal.show().then(function(){
                                        var button = modal.get('button'),
                                            result = button;
                                        if (button.innerHTML){
                                            result = button.innerHTML;
                                        }
                                        dom.byId('modalButtonValue1').innerHTML = result;
                                })
                            })
                       }
                   )
              </script>
              <button class="btn" id="modalButton1">Show modal</button>
            <div class="well well-small">
                <p><b>button:</b></p>
                <pre id="modalButtonValue1"></pre>
            </div>

              <div class="hidden" data-dojo-type="havok/widget/Modal" id="modal1" title="Modal Heading">
                <h4>Text in a modal</h4>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem.</p>

                <h4>Dropdown in a modal</h4>
                <p>This dropdown should trigger a dropdown on click:</p>
                <button class="btn" data-dojo-type="havok/widget/DropdownToggle">
                    dropdown <span class="caret"></span>
                    <ul class="hidden" data-dojo-type="havok/widget/Dropdown">
                      <li><a>Action</a></li>
                      <li><a>Another action</a></li>
                      <li><a>Something else here</a></li>
                      <hr />
                      <li><a>Separated link</a></li>
                    </ul>
                </button>

                <h4>Tooltips in a modal</h4>
                <p><a data-dojo-type="havok/widget/Tooltip" title="Tooltip">This link</a> and <a data-dojo-type="havok/widget/Tooltip" title="Tooltip">that link</a> should have tooltips on hover.</p>

                <hr>

                <h4>Overflowing text to show optional scrollbar</h4>
                <p>If the modal is too high for the viewport, a scrollbar on the window will appear.</p>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
              </div>
          </div>

<pre class="prettyprint linenums">
&lt;div data-dojo-type=&quot;havok/widget/Modal&quot; title=&quot;Modal Heading&quot;&gt;
    ...
&lt;/div&gt;
</pre>

          <h3>Custom footer</h3>

          <p>Change the modal footer by using <code>data-dojo-attach-point="footer"</code>. Button names and keys can also be set. (This modal can be closed with ctrl-y)</p>

          <div class="bs-docs-example">
              <script>
                  require(['dojo/on', 'dojo/dom', 'dijit/registry', 'dojo/domReady!'],
                       function(on, dom, registry){
                            on(dom.byId('modalButton2'), 'click', function(){
                                var modal = registry.byId('modal2');
                                    modal.show().then(function(){
                                        var button = modal.get('button'),
                                            result = button;
                                        if (button.innerHTML){
                                            result = button.innerHTML;
                                        }
                                        dom.byId('modalButtonValue2').innerHTML = result;
                                    })
                            })
                       }
                   )
              </script>
              <button class="btn" id="modalButton2">Show custom modal</button>
            <div class="well well-small">
                <p><b>button:</b></p>
                <pre id="modalButtonValue2"></pre>
            </div>
              <div data-dojo-type="havok/widget/Modal" id="modal2" title="Custom footer">
                <h4>Text in a modal</h4>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem.</p>
                <div data-dojo-attach-point="footer">
                    <button class="btn" data-dojo-attach-event="click: onCloseClick">Something</button>
                    <button data-dojo-type="havok/widget/Button"
                            data-dojo-attach-event="click: onCloseClick"
                            data-dojo-props="keys: 'ESCAPE', keyTarget: false">No Thanks</button>
                    <button class="btn-info"
                            data-dojo-type="havok/widget/Button"
                            data-dojo-attach-event="click: onOkClick"
                            data-dojo-props="keys: ['ENTER', {char: 'y', ctrl: true}], keyTarget: false">Yeah!</button>
                </div>
              </div>
          </div>
<pre class="prettyprint linenums">
&lt;div data-dojo-type=&quot;havok/widget/Modal&quot; id=&quot;modal2&quot; title=&quot;Custom footer&quot;&gt;
  &lt;h4&gt;Text in a modal&lt;/h4&gt;
  &lt;p&gt;Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem.&lt;/p&gt;
  &lt;div data-dojo-attach-point=&quot;footer&quot;&gt;
      &lt;button class=&quot;btn&quot; data-dojo-attach-event=&quot;click: onCloseClick&quot;&gt;Something&lt;/button&gt;
      &lt;button data-dojo-type=&quot;havok/widget/Button&quot;
              data-dojo-attach-event=&quot;click: onCloseClick&quot;
              data-dojo-props=&quot;keys: 'ESCAPE', keyTarget: false&quot;&gt;No Thanks&lt;/button&gt;
      &lt;button class=&quot;btn-info&quot;
              data-dojo-type=&quot;havok/widget/Button&quot;
              data-dojo-attach-event=&quot;click: onOkClick&quot;
              data-dojo-props=&quot;keys: ['ENTER', {char: 'y', ctrl: true}], keyTarget: false&quot;&gt;Yeah!&lt;/button&gt;
  &lt;/div&gt;
&lt;/div&gt;
</pre>


  <h2>Properties</h2>

            <table class="table table-bordered table-striped">
              <thead>
               <tr>
                 <th style="width: 100px;">Name</th>
                 <th style="width: 50px;">type</th>
                 <th style="width: 50px;">default</th>
                 <th>description</th>
               </tr>
              </thead>
              <tbody>
               <tr>
                 <td>button</td>
                 <td>string</td>
                 <td></td>
                 <td>When the modal is closed, this property will be set to the button that was used to close it.</td>
               </tr>
               <tr>
                 <td>value</td>
                 <td>object</td>
                 <td></td>
                 <td>A modal can be used like a form. Inputs inside a modal will populate the modal's value object.</td>
               </tr>
               <tr>
                 <td>hidden</td>
                 <td>boolean</td>
                 <td>true</td>
                 <td>If a modal is hidden or not.</td>
               </tr>
               <tr>
                 <td>footerTemplate</td>
                 <td>string</td>
                 <td></td>
                 <td>The markup to add into the modal footer.</td>
               </tr>
              </tbody>
            </table>

          <h2>Methods</h2>

<table class="table table-bordered table-striped">
  <thead>
   <tr>
     <th style="width: 100px;">name</th>
     <th style="width: 100px;">args</th>
     <th>description</th>
   </tr>
  </thead>
  <tbody>
    <tr>
        <td>.show(value)</td>
        <td>value set's a modal form's value</td>
        <td>Shows the modal. Also returns a Deferred which will resolve when the modal is closed.</td>
    </tr>
    <tr>
        <td>.hide()</td>
        <td>-</td>
        <td>Hides the modal.</td>
    </tr>
    <tr>
        <td>.toggle()</td>
        <td>-</td>
        <td>Toggles the modal.</td>
    </tr>
  </tbody>
</table>

        </section>
