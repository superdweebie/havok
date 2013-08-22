<!-- Subhead
================================================== -->
<header class="jumbotron subhead" id="overview">
  <div class="container">
    <h1>Getting started</h1>
    <p class="lead">An overview of Havok.</p>
  </div>
</header>


  <div class="container">

    <!-- Docs nav
    ================================================== -->
    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <ul data-dojo-type="havok/widget/NavList"
            data-dojo-mixins="havok/widget/_AffixMixin, havok/widget/_ScrollSpyMixin"
            data-dojo-props="
               linkTemplate: '&lt;a role=&quot;navitem&quot; href=&quot;${href}&quot;&gt;&lt;i class=&quot;icon-chevron-right&quot;&gt;&lt;/i&gt; ${text}&lt;/a&gt;',
               viewportOffset: {top: 40, bottom: 0},
               affixTarget: 'mainContent',
               spyTarget: 'mainContent'
            "
            class="nav-stacked bs-docs-sidenav"
        >
        </ul>
      </div>
    <div class="span9" id="mainContent">

        <?php
        include 'getting-started/download-havok.php';
        include 'getting-started/file-structure.php';
        include 'getting-started/whats-included.php';
        include 'getting-started/loading.php';
        include 'getting-started/using-havok.php';				
        include 'getting-started/what-next.php';
        ?>
      </div>
    </div>

  </div>
