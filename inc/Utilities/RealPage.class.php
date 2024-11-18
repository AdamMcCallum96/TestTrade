<?php

Class RealPage {




    static function stockSearchBarAndResult(){ ?>
        <script
        src="https://code.jquery.com/jquery-3.7.0.js"
       
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#searchBar").keyup(function() {
                // $(document).alert("lol");
                var search = $("#searchBar").val();
                console.log(search);
                
                 const url = window.location.href.split('?')[0];
                 console.log(url);
                $.post("inc/Utilities/Search.php", {
                    search_Bar:search
                    // previous_URL:url
                }, function(data, status){
                    $("#result_box").html(data);
                });
                // $("#result_box").load('inc/Utilities/Search.php');
            });
        });

        <input id='searchBar' name='searchBar' type="text" placeholder="Search..">


        <?php


    }
}


?>