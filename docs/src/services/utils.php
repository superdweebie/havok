        <section id="utils" title="Utils">
          <div class="page-header">
            <h1>Utils</h1>
          </div>

          <p class="lead">Small helper functions</p>

          <h2>array</h2>

          <p><code>havok/array</code> extends <code>dojo/_base/array</code> to add one new function: <code>substract(a, b)</code>. Array subtract will remove any elemnts in both a and b from a. Eg:</p>

<pre class="prettyprint linenums">
require(['havok/array', function(array){
    var removeFrom = [1, 2, 2, 3, 4, 5];
    var removeValues = [2, 3];

    var result = array.subtract(removeFrom, removeValues);
    //result is [1, 4, 5]
})
</pre>

          <h2>is</h2>

          <p><code>havok/is</code> constains comparison functions that will return a boolean value.</p>

<table class="table table-bordered table-striped">
  <thead>
   <tr>
     <th style="width: 100px;">function</th>
     <th>description</th>
   </tr>
  </thead>
  <tbody>
    <tr>
        <td>isInt(value)</td>
        <td>Is the value an integer?</td>
    </tr>
    <tr>
        <td>isFloat(value)</td>
        <td>Is the value a floating point number?</td>
    </tr>
    <tr>
        <td>isDeferred(value)</td>
        <td>Is the value an instance of <code>dojo/Deferred</code></td>
    </tr>
    <tr>
        <td>isStatic(value)</td>
        <td>Does the value contain any functions at all?</td>
    </tr>
  </tbody>
</table>

          <h2>lang</h2>

          <p><code>havok/lang</code> extends <code>dojo/_base/lang</code> with one new function. <code>mixinDeep</code> will mix objects together deep into their object tree.</p>

<pre class="prettyprint linenums">
require(['havok/lang', function(lang){
    var dest = {
        item: {
            a: 1,
            b: {bb: 1}
        }
    };
    var source = {
        item: {
            a: 0,
            b: {dd: 5},
            c: 3
        }
    }

    var result = lang.mixinDeep(dest, source);

    //result = {
    //    item: {
    //        a: 0,
    //        b: {bb: 1, dd:5},
    //        c: 3
    //    }
    //}
})
</pre>

          <h2>string</h2>

          <p><code>havok/string</code> extends <code>dojo/string</code> with one new function. <code>ucFirst</code> will make the first character in a string uppercase.</p>

<pre class="prettyprint linenums">
require(['havok/string', function(string){

    var result = string.ucFirst('abc');

    //result = 'Abc';
})
</pre>

        </section>
