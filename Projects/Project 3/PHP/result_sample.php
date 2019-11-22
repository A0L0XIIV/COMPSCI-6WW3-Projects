<?php
    require "head.php";
?>

<!-- LeafletJS CSS -->
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""
/>
<!-- LeafletJS JavaScript -->
<script
    src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""
></script>

<?php 
    require "header.php";
?>

<!-- Centered main-->
<main class="main">
    <!-- Breadcrum: Navigation -->
    <div class="breadcrumb" role="navigation">
    <ul>
        <li>
        <a href="./index.php">Home</a>
        </li>
        <li>></li>
        <li>
        <a href="./result_sample.php">Search Results</a><!--DYNAMIC!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
        </li>
    </ul>
    </div>

    <!-- Tabs for map and tabular results -->
    <ul class="nav nav-tabs">
    <li>
        <a
        class="nav-link active"
        id="tabular-results"
        data-toggle="tab"
        href="#tabularResults"
        role="tab"
        aria-controls="tabular-results"
        aria-selected="true"
        >Tabular</a
        >
    </li>
    <li>
        <a
        class="nav-link"
        id="map-results"
        data-toggle="tab"
        href="#mapResults"
        role="tab"
        aria-controls="map-results"
        aria-selected="false"
        >Map</a
        >
    </li>
    </ul>

    <div class="tab-content">
    <!-- Tabular results -->
    <div
        class="tab-pane fade show active"
        id="tabularResults"
        role="tabpanel"
        aria-labelledby="tabular-results-tab"
    >
        <table>
        <!-- Result 1 -->
        <tr>
            <!-- Name of the park -->
            <th colspan="3">Park 1</th>
        </tr>
        <tr class="parkData">
            <!-- Main image of the park -->
            <td class="resultTableMap">
            <div id="map1" class="map"></div>
            </td>
            <!-- Basic information of the park -->
            <td class="resultTableInfo">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                nec orci augue. In at quam lacus. Proin in erat a neque tempus
                pharetra. In ante nibh, luctus quis risus vitae, molestie
                porta justo. Fusce leo neque, tincidunt nec justo in, egestas
                mollis arcu. Aliquam erat volutpat. In pharetra commodo augue
                non commodo. Nullam ultrices, tortor ac imperdiet tempor, quam
                mi placerat enim, viverra porta erat urna nec arcu. Maecenas
                auctor nulla nec maximus convallis. Nunc lacinia risus in diam
                interdum feugiat. Vivamus vehicula nisi ut ornare semper.
            </p>
            </td>
            <td class="resultTableLink">
            <!-- Link to park's individual page -->
            <a href="./individual_sample.html">Detailed info</a>
            </td>
        </tr>

        <!-- Result 2 -->
        <tr>
            <th colspan="3">Park 2</th>
        </tr>
        <tr class="parkData">
            <!-- Main image of the park -->
            <td class="resultTableMap">
            <div id="map2" class="map"></div>
            </td>
            <!-- Basic information of the park -->
            <td class="resultTableInfo">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                nec orci augue. In at quam lacus. Proin in erat a neque tempus
                pharetra. In ante nibh, luctus quis risus vitae, molestie
                porta justo. Fusce leo neque, tincidunt nec justo in, egestas
                mollis arcu. Aliquam erat volutpat.
            </p>
            </td>
            <td class="resultTableLink">
            <!-- Link to park's individual page -->
            <a href="./individual_sample.html">Detailed info</a>
            </td>
        </tr>

        <!-- Result 3 -->
        <tr>
            <th colspan="3">Park 3</th>
        </tr>
        <tr class="parkData">
            <!-- Main image of the park -->
            <td class="resultTableMap">
            <div id="map3" class="map"></div>
            </td>
            <!-- Basic information of the park -->
            <td class="resultTableInfo">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                nec orci augue. In at quam lacus. Proin in erat a neque tempus
                pharetra. In ante nibh, luctus quis risus vitae, molestie
                porta justo. Fusce leo neque, tincidunt nec justo in, egestas
                mollis arcu. Aliquam erat volutpat. In pharetra commodo augue
                non commodo. Nullam ultrices, tortor ac imperdiet tempor, quam
                mi placerat enim, viverra porta erat urna nec arcu. Maecenas
                auctor nulla nec maximus convallis. Nunc lacinia risus in diam
                interdum feugiat. Vivamus vehicula nisi ut ornare semper.
                <br />
                Sed eget elit congue, tincidunt sem eget, viverra ipsum. In
                lacus turpis, consectetur non odio ut, hendrerit mattis dolor.
                Nam viverra orci non enim rhoncus, non commodo lacus feugiat.
                Curabitur eu sollicitudin urna. Duis semper turpis at
                hendrerit pellentesque. Class aptent taciti sociosqu ad litora
                torquent per conubia nostra, per inceptos himenaeos. Nulla non
                porttitor nisi. Duis consectetur ante nunc, quis euismod erat
                facilisis at. Nam diam nisl, porta sit amet magna at,
                fermentum consequat nunc. Pellentesque ultricies laoreet massa
                ultrices feugiat. Donec pharetra purus vel purus vulputate
                maximus. Aliquam id mi a ligula placerat ultrices.
            </p>
            </td>
            <td class="resultTableLink">
            <!-- Link to park's individual page -->
            <a href="./individual_sample.html">Detailed info</a>
            </td>
        </tr>

        <!-- Result 4 -->
        <tr>
            <th colspan="3">Park 4</th>
        </tr>
        <tr class="parkData">
            <!-- Main image of the park -->
            <td class="resultTableMap">
            <div id="map4" class="map"></div>
            </td>
            <!-- Basic information of the park -->
            <td class="resultTableInfo">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                nec orci augue. In at quam lacus. Proin in erat a neque tempus
                pharetra. In ante nibh, luctus quis risus vitae, molestie
                porta justo. Fusce leo neque, tincidunt nec justo in, egestas
                mollis arcu. Aliquam erat volutpat. In pharetra commodo augue
                non commodo. Nullam ultrices, tortor ac imperdiet tempor, quam
                mi placerat enim, viverra porta erat urna nec arcu. Maecenas
                auctor nulla nec maximus convallis. Nunc lacinia risus in diam
                interdum feugiat. Vivamus vehicula nisi ut ornare semper.
            </p>
            </td>
            <td class="resultTableLink">
            <!-- Link to park's individual page -->
            <a href="./individual_sample.html">Detailed info</a>
            </td>
        </tr>
        </table>
    </div>

    <!-- Map Results -->
    <div
        class="tab-pane fade"
        id="mapResults"
        role="tabpanel"
        aria-labelledby="map-results-tab"
    >
        <div id="mapResultsMap" class="map"></div>
    </div>
    </div>
</main>

<?php
    require "footer.php";
?>