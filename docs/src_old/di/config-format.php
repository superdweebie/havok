
        <section id="config-format" title="Config Format">
          <div class="page-header">
            <h1>Config Format</h1>
          </div>

<p>The property names of the config object are identifiers. They are used to retrieve configured objects from the di. The properies themselves define how the object will be injected. The property object can have the following sub properties. All sub properties are optional:</p>

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
        <td>base</td>
        <td>string</td>
        <td>Specify which module will be the base, or foundation for injection.</td>
    </tr>
    <tr>
        <td>params</td>
        <td>object</td>
        <td>Specifies static parameters to be injected.</td>
    </tr>
    <tr>
        <td>gets</td>
        <td>object</td>
        <td>Specifies objects that should be retrieved through the di and injected.</td>
    </tr>
    <tr>
        <td>proxies</td>
        <td>object</td>
        <td>Specifies object that should be proxied by the di and injected.</td>
    </tr>
    <tr>
        <td>directives</td>
        <td>object</td>
        <td>A set of flags that give fine grained control over di injection behaviour.</td>
    </tr>
    <tr>
        <td>proxyMethods</td>
        <td>array</td>
        <td>An array of methods that should be available when creating a proxy.</td>
    </tr>
  </tbody>
</table>

        </section>
