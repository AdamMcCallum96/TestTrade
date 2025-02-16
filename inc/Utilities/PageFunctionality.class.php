<?php

class PageFunctionality {
    


    static function nav() { ?>

<html>


<link rel='stylesheet' type='text/css' href='styles/landing.css'>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu%20Condensed">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
<body id="body">

    <div>


        <img class="navImage" src=images/TestTrade.svg>
        <div class="menuContainer">
            
            
            
            <div class="menuButton">
                <a href="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/trade.php";?>" class="menuText">Trade</a>
                <!-- <div class="menuTab"></div> -->

            </div>
            <div class="menuButton">
                <a href="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/summary.php";?>" class="menuText">Summary</a>
                <!-- <div class="menuTab"></div> -->

            </div>
            <div class="menuButton">
                <a href=""class="menuText">Analytics</a>
                <!-- <div class="menuTab"></div> -->

            </div>
            <div class="menuButton">
                <a href="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/charts.php";?>" class="menuText">Charts</a>
                <!-- <div class="menuTab"></div> -->

            </div>
            <div class="menuButton">
                <p class="menuText">Account</p>
                <!-- <div class="menuTab"></div> -->

            </div>
            <div class="menuButton">
                <p class="menuText">Settings</p>
                <!-- <div class="menuTab"></div> -->

            </div>

        </div>
        <div class="divider">

        </div>
        

    <?php }

    static function footer() { ?>
                    </div>
                </body>
            </html>

    <?php }

    static function includeJavascript(){?>
        <script
            src="https://code.jquery.com/jquery-3.7.0.js"
           
            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>
            
            
    <?php }


    static function manageCurrency() {?>
        <input type="search" placeholder="search currency" id="searchCurrency">
        <div id="resultCurrency"></div>
        <script type="text/javascript">
    
        $(document).ready(function(){
            $("#searchCurrency").on('keyup', function(){

                var searched = $("#searchCurrency").val();
                $.post("inc/Utilities/APISearchCurrency.php",{
                    currencySearch:searched
                }, function(data, status){
                    $("#resultCurrency").html(data);
                });
            });
        });
        </script>
    


    <?php }

    static function summaryCurrency() { ?>
        <div class="summaryGridCurrency">
            <div class="summaryGridRows">Name</div>
            <div class="summaryGridRows">Code</div>
            <div class="summaryGridRows">Contributions</div>
            <div class="summaryGridRows">Stock Value</div>
            <div class="summaryGridRows">Total Value</div>
            <div class="summaryGridRows">Net Gain</div>
            <div class="summaryGridRows">Investable Currency</div>
        </div>

        <div class="summaryGridCurrency">
            <div class="summaryGridRows">Canadian Dollar</div>
            <div class="summaryGridRows">CAD</div>
            <div class="summaryGridRows">$15,000</div>
            <div class="summaryGridRows">$13,000</div>
            <div class="summaryGridRows">$16.500</div>
            <div class="summaryGridRows">$1,500</div>
            <div class="summaryGridRows">$3,500</div>
        </div>
    <?php }

    static function summaryPortfolio($stocks) { 
        /*

            'stockID' => string 'LOAR' (length=4)
      'userID' => string 'adammccallum96@gmail.com' (length=24)
      'boughtPriceAvg' => float 30
      'soldPriceAvg' => float 35
      'boughtPriceTotal' => float 900
      'soldPriceTotal' => float 700
      'ID' => string 'LOAR' (length=4)
      'stockName' => string 'Loar Holdings Inc' (length=17)
      'stockRegion' => string 'United States' (length=13)
      'stockMarketOpen' => string '09:30:00' (length=8)
      'stockMarketClose' => string '16:00:00' (length=8)
      'stockTimezone' => string 'UTC-04' (length=6)
      'stockCurrency' => string 'USD' (length=3)

        */
        
        ?>
    <div class="summaryGrid">
        <div class="summaryGridRows">Stock Name</div>
        <div class="summaryGridRows">Unrealized</div>
        <div class="summaryGridRows">Realized</div>
        <div class="summaryGridRows">Shares</div>
        <div class="summaryGridRows">Avg Price</div>
        <div class="summaryGridRows">Initial Value</div>
        <div class="summaryGridRows">Current Valuation</div>
        <div class="summaryGridRows">Percent Change</div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
           
           integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
           crossorigin="anonymous"></script>
    
        
     </script> 
     <script type="text/javascript">
         src="https://code.jquery.com/jquery-3.7.0.js"
           
           integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
           crossorigin="anonymous"
        console.log("shit broken");
        //const locale =  new Intl.Locale("en-Latn-US", { language: "es" });
        //console.log(locale.language);
        
        // $(document).ready(function(){
            

        //     let currency = <?php //echo json_encode($stock['stockCurrency']);?>;
        //     let testNum = new Intl.NumberFormat(Locale.getDefault(), { style: 'currency', currency: '<?php //echo json_encode($stock['stockCurrency']);?>'}).format(number
        //     );
        //     alert(testNum)
        // });
            // $(".currency").on('load', function(){
            //     alert("lol");
            // });
        
           // let number = 53.33;
            //alert('lol');
            //console.log(Locale.getDefault())
            //let number = 55.33
            // let testNum = new Intl.NumberFormat(Locale.getDefault(), { style: 'currency', currency: '<?php //echo json_decode($stock['stockCurrency']);?>'}).format(number,
            // );
            // $(".currency").text(testnum);
            
        
        
    </script>
    <script type="text/javascript">
        userLocale = Intl.NumberFormat().resolvedOptions().locale;
        
        let stocksJS = <?php echo json_encode($stocks); ?>;
        console.log(stocksJS)
        var iteration = 0;
        $(document).ready(function(){
            $('.currency').each(function(){
                let price = $(this).text();
                let currencyUsed = $(this).attr("sc")
                let currencyNumber = new Intl.NumberFormat(userLocale, { style: 'currency', currency: currencyUsed}).format(price,
                );
                $(this).text(currencyNumber);
           

                iteration += 1;

              //  alert(this.text());
            });

        });
    </script>

    <?php
    
    foreach($stocks as $stock){
        $sc = $stock['stockCurrency']?>
    ?>
    <script type="text/javascript">
    $(document).ready(function(){
            //console.log(Intl.NumberFormat().resolvedOptions().locale)
            userLocale = Intl.NumberFormat().resolvedOptions().locale;
            let number = 26.07;
            let currency = <?php echo json_encode($stock['stockCurrency']);?>;
            let testNum = new Intl.NumberFormat(userLocale, { style: 'currency', currency: <?php echo json_encode($stock['stockCurrency']);?>}).format(number
            );
            $('.currency').on("load", function(){
                // console.log("lol");
                // alert($(this).text());
                // alert($(this).text());
                //result = $('.currency').text()
                //alert(result);
                //let realnum = new Intl.NumberFormat(userLocale, { style: 'currency', currency: <?php echo json_encode($stock['stockCurrency']);?>}).format(result);
                //$('.currency').text(realnum);

            });
            //alert(testNum)
        });
    </script>
    <?php

    $boughtPrice = $stock['boughtPriceTotal'];
    $soldPrice = $stock['soldPriceTotal'];
    $SQ = $stock['soldQuantity'];
    $BQ = $stock['boughtQuantity'];
    $CQ = $BQ - $SQ;
    $currentValue = $stock['stockValue'];
    $realizedGains = $soldPrice - ($SQ * $stock['boughtPriceAvg']);
    $unrealizedGains = ($CQ * $currentValue) - ($CQ * $stock['boughtPriceAvg']);


    ?>
    
    <div class="summaryGrid">
        <div class="summaryGridRows"><?php echo $stock['stockName']?></div>
        <div class="summaryGridRows currency" sc="<?php echo $sc?>"><?php echo $unrealizedGains ?></div>
        <div class="summaryGridRows currency" sc="<?php echo $sc?>"><?php echo $realizedGains ?></div>
        <div class="summaryGridRows">
        
            
            <?php 
       $bought = $stock['boughtQuantity'];
       $sold = $stock['soldQuantity'];
       $current = $bought - $sold;
       echo $current ."/" . $bought ; ?></div>
        <div class="summaryGridRows">
            <table class="summaryPriceTable">
                <tr class="priceTableRows">
                    <td>Bought</td>
                    <td>Current</td>
                    <td>Sold
                </tr>
                <tr class="priceTableRows">
                    <td><?php echo $stock['boughtPriceAvg'];?></td>
                    <td><?php echo $stock['stockValue'];?></td>
                    <td><?php echo $stock['soldPriceAvg'];?></td>
                </tr>
                

            </table>
    
        </div>
        <div class="summaryGridRows"><?php echo $stock['boughtPriceTotal']?></div>
        <div class="summaryGridRows">
        
        
        <?php 
        $valuation = $stock['soldPriceTotal'] + ($current * $stock['stockValue']);
        
        echo $valuation;?></div>
        <div class="summaryGridRows"><?php echo round((100 * ($valuation - $stock['boughtPriceTotal'])/$stock['boughtPriceTotal']), 2)."%";?></div>
        
    </div>

    <?php
    }
    ?>
    <div class="summaryGrid">
        <div class="summaryGridRows">Cineplex</div>
        <div class="summaryGridRows currency">3000</div>
        <div class="summaryGridRows currency">1000</div>
        <div class="summaryGridRows">100/250</div>
        <div class="summaryGridRows">
            <table class="summaryPriceTable">
                <tr class="priceTableRows">
                    <td>Bought</td>
                    <td>Current</td>
                    <td>Sold
                </tr>
                <tr class="priceTableRows">
                    <td>$22.25</td>
                    <td>$25.50</td>
                    <td>$26.50</td>
                </tr>
                

            </table>
    
        </div>
        <div class="summaryGridRows">$15,000</div>
        <div class="summaryGridRows">$19,000</div>
        <div class="summaryGridRows">+23%</div>
        
    </div>

    <?php }

    static function summary() {?>
     <!-- <div class="summaryMenu">
        <div class="summaryMenuButton"><a class="summaryLink" href="randlink">Portfolio</a></div>
        <div class="summaryMenuButton"><a class="summaryLink" href="randlink">Currency Distribution</a></div>

    </div> -->

    <div class="summaryMenu">
        <a class="summaryMenuButton" href="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/summary.php?UI=portfolio";?>">Portfolio</a>
        <a class="summaryMenuButton" href="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/summary.php?UI=currency";?>">Currency Distribution</a>
    </div>
    <!-- <div class="summaryGrid">
        <div class="summaryGridRows">Stock Name</div>
        <div class="summaryGridRows">Unrealized</div>
        <div class="summaryGridRows">Realized</div>
        <div class="summaryGridRows">Shares</div>
        <div class="summaryGridRows">Avg Price</div>
        <div class="summaryGridRows">Initial Value</div>
        <div class="summaryGridRows">Current Valuation</div>
        <div class="summaryGridRows">Percent Change</div>
        
    </div> -->
    <!-- <div class="summaryGrid">
        <div class="summaryGridRows">Cineplex</div>
        <div class="summaryGridRows">$3000</div>
        <div class="summaryGridRows">$1000</div>
        <div class="summaryGridRows">100/250</div>
        <div class="summaryGridRows">
            <table class="summaryPriceTable">
             
                <tr class="priceTableRows">
                    <td>Bought</td>
                    <td>Current</td>
                    <td>Sold
                </tr>
                <tr class="priceTableRows">
                    <td>$22.25</td>
                    <td>$25.50</td>
                    <td>$26.50</td>
                </tr>
                

            </table>
    
        </div>
        <div class="summaryGridRows">$15,000</div>
        <div class="summaryGridRows">$19,000</div>
        <div class="summaryGridRows">+23%</div>
        
    </div> -->
    <!-- <div class="summaryGrid">
        <div class="summaryGridRows">Cineplex</div>
        <div class="summaryGridRows">$3000</div>
        <div class="summaryGridRows">$1000</div>
        <div class="summaryGridRows">100/250</div>
        <div class="summaryGridRows">
            <table class="summaryPriceTable">
               
                <tr class="priceTableRows">
                    <td></td>
                    <td>Bought</td>
                    <td>$22.25</td>
                </tr>
                <tr class="priceTableRows">
                    <td>AVG</td>
                    <td>Current</td>
                    <td>$25.50</td>
                </tr>
                <tr class="priceTableRows">
                    <td></td>
                    <td>Sold</td>
                    <td>$26.50</td>
                </tr>

            </table>
    
        </div>
        <div class="summaryGridRows">$15,000</div>
        <div class="summaryGridRows">$19,000</div>
        <div class="summaryGridRows">+23%</div>
        
    </div> -->
    <!-- <div class="summaryGrid">
        <div class="summaryGridRows">Cineplex</div>
        <div class="summaryGridRows">$3000</div>
        <div class="summaryGridRows">$1000</div>
        <div class="summaryGridRows">100/250</div>
        <div class="summaryGridRows">
            <table class="summaryPriceTable">
                
                <tr class="priceTableRows">
                    <td></td>
                    <td>Bought</td>
                    <td>$22.25</td>
                </tr>
                <tr class="priceTableRows">
                    <td>AVG</td>
                    <td>Current</td>
                    <td>$25.50</td>
                </tr>
                <tr class="priceTableRows">
                    <td></td>
                    <td>Sold</td>
                    <td>$26.50</td>
                </tr>

            </table>
    
        </div>
        <div class="summaryGridRows">$15,000</div>
        <div class="summaryGridRows">$19,000</div>
        <div class="summaryGridRows">+23%</div>
        
    </div> -->

    <!-- <div class="summaryGridCurrency">
        <div class="summaryGridRows">Name</div>
        <div class="summaryGridRows">Code</div>
        <div class="summaryGridRows">Contributions</div>
        <div class="summaryGridRows">Stock Value</div>
        <div class="summaryGridRows">Total Value</div>
        <div class="summaryGridRows">Net Gain</div>
        <div class="summaryGridRows">Investable Currency</div>
    </div>

    <div class="summaryGridCurrency">
        <div class="summaryGridRows">Canadian Dollar</div>
        <div class="summaryGridRows">CAD</div>
        <div class="summaryGridRows">$15,000</div>
        <div class="summaryGridRows">$13,000</div>
        <div class="summaryGridRows">$16.500</div>
        <div class="summaryGridRows">$1,500</div>
        <div class="summaryGridRows">$3,500</div>
    </div> -->
    <?php }
    

    static function tradeSearchBar() { ?>

<div class="mainContent">
            <script
            src="https://code.jquery.com/jquery-3.7.0.js"
           
            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>
            <div class="searchContainer">
            <!-- <p>Search</p> -->
            <input id='searchBar' name='searchBar' type="text" placeholder="Stock Search">
            </div>
            <script type="text/javascript">
            $(".searchItemText").on('click', function(){
                $("#result_box").hide()
            })


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
            </script>   
            <div class="divider"></div>

        <?php }

        static function saveGraphButton($stocks) { ?>
            
            <div id="searchConfirmationContainer">
                
            </div>
            <div id="saveGraphPopUp">
                <form id="popUpForm"  method = "post">
                <t class="popUpText">Graph Name</t>
                <br>
                <input class="popUptext" type="text" name="graphName">
                <input type="hidden" value='<?php echo $stocks;?>' name="stocks">
                <input id="saveGraphStartDate" type="hidden" value="" name="startDate">
                <input id="saveGraphEndDate" type="hidden" value="" name="endDate">
                <!-- <t>Keep</t> -->
                <!-- <input type="checkbox"> -->
                </form>
            </div>

            <script type="text/javascript">
                let searchConfirmation = document.getElementById("searchConfirmationContainer")

                let generateGraphButton = document.createElement("button")
                generateGraphButton.classList.add("searchConfirmationButton")
                generateGraphButton.textContent = "Save Graph";

                let popup = document.createElement("div");
                popup.classList.add("saveGraphPopUp");


                generateGraphButton.addEventListener("click", function(){

                    //document.getElementById("saveGraphPopUp");
                    let body = document.getElementById("body")
                    let pop = document.getElementById("saveGraphPopUp")
                    // = document.getElementById("popUpForm")
                    body.insertAdjacentElement('afterend',pop)
                    pop.style.visibility = "visible"
                    body.style.cssText = `mask-image: linear-gradient(black, transparent);`
                    let graph = gm.getLastGraph();

                    let startDate = graph.getDateFromIndex(graph.startSlider.value)
                    let endDate = graph.getDateFromIndex(graph.endSlider.value)

                    let hiddenStart = document.getElementById("saveGraphStartDate")
                    let hiddenEnd = document.getElementById("saveGraphEndDate")
                    // console.log("HIDDEN END");
                    // console.log(hiddenEnd);

                    hiddenStart.value = startDate
                    hiddenEnd.value = endDate

                    console.log(graph);
                    // alert("wtf");
                    // debugger;
                   

                });
                searchConfirmation.insertAdjacentElement("beforeend", generateGraphButton)
                // searchConfirmation.insertAdjacentElement("beforeend", popup)

                let popUpContainer = document.getElementById("popUpForm");
                let flexBoxDiv = document.createElement("div");
                flexBoxDiv.classList.add("popUpButtonDiv");

                popUpContainer.insertAdjacentElement("beforeend",flexBoxDiv);

                // popupContainer = flexBoxDiv

                generateGraphButton = document.createElement("button")
                generateGraphButton.classList.add("searchConfirmationButton")
                generateGraphButton.classList.add("popUpButton")
                generateGraphButton.textContent = "Back";
                generateGraphButton.type = "button";
                //generateGraphButton.setAttribute("type","button")
                flexBoxDiv.insertAdjacentElement("beforeend", generateGraphButton)

                generateGraphButton.addEventListener("click", function(){
                    let popUp = document.getElementById("saveGraphPopUp");
                    popUp.style.visibility = "hidden";

                    let body = document.getElementById("body")
                    body.style.cssText = "";

                });
                
                generateGraphButton = document.createElement("button")
                generateGraphButton.classList.add("searchConfirmationButton")
                generateGraphButton.classList.add("popUpButton")
                generateGraphButton.textContent = "Confirm";
                flexBoxDiv.insertAdjacentElement("beforeend", generateGraphButton)
           </script>
        <?php }

        static function quickGraphDescription() { ?>
            <div class="quickDivContainer">
            <div class="quickDiv">
            <p class="quickTitle">QUICK GRAPH</p>
            <p class="quickSubTitle">Using quick graph:</p>
            <ul class="quickList">
                <li class="quickText">Search the stocks you want.</li>
                <li class="quickText">Generate the graph.</li>
                <li class="quickText">Use the graph to your liking.</li>
                <li class="quickText">View your previous graphs.</li>
            </ul>
            <!-- <p class="quickText">Pick the stocks you want</p>
            <p class="quickText">Generate the graph</p> -->
            </div>
        </div>
        <div class="divider"></div>
        <?php }

        static function quickGraphHistory($historyLines, $savedHistoryLines){ ?>
        <div class="divider"></div>
        <div class="quickGraphHistoryContainer">

        
        <div class="flexQuickGraphHistory">
        <p class="quickSubTitle flexRecentSearch">Recent Searches</p>
        <?php
        $urlStart = "";
        
         foreach($historyLines as $line){
            // var_dump($line->getHistoryText());

            $formattedLine = $line->getHistoryText();
            $formattedLine = trim($formattedLine, "[]");
            $formattedLine = str_replace('"', "", $formattedLine);
            $formattedLine = str_replace(",", "   ", $formattedLine);
            //explode(" ", $line)
            $urlStart = $_SERVER['PHP_SELF'];
            $urlEnd = '?generateGraph=True&graphParams='.$line->getHistoryText();
            $url = $urlStart . $urlEnd;
            echo '<div class="flexQuickGraphHistoryItem">';
            echo "<a class=".'"quickGraphHistoryLink"'." href='".$url."'>";
            echo $formattedLine;
            echo '</a></div>';
         }
         ?>


        </div>
        <div class="flexQuickGraphHistory">
        <p class="quickSubTitle flexRecentSearch">Saved Graphs</p>
        <?php

        foreach($savedHistoryLines as $graphItem){
            // $formattedLine = $graphItem->getGraphTickers();
            // $formattedLine = trim($formattedLine, "[]");
            // $formattedLine = str_replace('"', "", $formattedLine);
            // $formattedLine = str_replace(",", "   ", $formattedLine);

            $urlStart = $_SERVER['PHP_SELF'];
            $urlEnd = '?generateGraph=True&graphParams='.$graphItem->getGraphTickers();
            $url = $urlStart . $urlEnd;
            echo '<div class="flexQuickGraphHistoryItem">';
            echo "<a class=".'"quickGraphHistoryLink"'." href='".$url."'>";
            echo $graphItem->getGraphName();
            echo '</a></div>';
        }

        ?>
        <!-- <div class="flexQuickGraphHistoryItem">
            <a class="quickGraphHistoryLink" href='".$url."'>TECH STOCKS</a>
        </div> -->
        <!-- <div class="flexQuickGraphHistoryItem">
            <a class="quickGraphHistoryLink" href='".$url."'>TELECOM</a>
        </div> -->
        <!-- <div class="flexQuickGraphHistoryItem">
            <a class="quickGraphHistoryLink" href='".$url."'>OIL AND GAS</a>
        </div> -->
        </div>
        </div> 
            
        <?php }

        static function addSearchQuery($passedQuery) { 
            // $_SESSION['searchQuery'] = "lol";
            // $_SESSION['searchQuery'][] = $passedQuery;
            // if(gettype($_SESSION['searchQuery']) != "array"){
                
            //     settype($_SESSION['searchQuery'],"array");
            // }
            // if(count($_SESSION) <= 5){
            //     array_push($_SESSION['searchQuery'], $passedQuery);
            // }
            
            // var_dump($_SESSION);
            
            ?>

        <div id="searchQueryContainer"> </div>
        <!-- <div id="searchDescription">Generate the graph once you've picked all your stocks.</div> -->
        <div id="searchConfirmationContainer"></div>
        <script type="text/javascript">
        let passedQuery = <?php echo json_encode($passedQuery);?>;
        
        
        // window.localStorage.searchQuery = "undefined";
        // alert(window.localStorage.searchQuery)
        // alert(window.localStorage.searchQuery == undefined);
        console.log("STRINGIFY TESTS");
        console.log(JSON.stringify("CGX.TRT"));
        console.log(JSON.stringify(passedQuery));
        // console.log(JSON.stringify(CGX.TRT));
        if(window.localStorage.searchQuery == undefined || window.localStorage.searchQuery == "undefined"){
            //ensures all outputs are arrays
            let testQuery = [];
            testQuery[0] = passedQuery;
            window.localStorage.searchQuery = JSON.stringify(testQuery);
            // window.localStorage.searchQuery = JSON.stringify("lol")

            // console.log("STRINGIFY");
            // console.log(JSON.stringify("lol"));
        } else if(JSON.parse(window.localStorage.searchQuery).length >= 5 && Array.isArray(JSON.parse(window.localStorage.searchQuery))){
            console.log("is not undefined")

            // let lStorage = JSON.parse(window.localStorage.searchQuery)
            // let length =
            // for(let i = 0; i <= lStorage.length; i ++){
                
            // }
            
            let searchContainer = document.getElementById("searchQueryContainer");
            //insert above the search container
            //letting know that the maximum number of stocks has been reached
            alert("TO big to add another line")
        } else  {
            // alert(window.localStorage.searchQuery)
            //var localStorageResult = [];
            var localStorageResult = JSON.parse(window.localStorage.searchQuery)
            console.log(localStorageResult)
            console.log("WTF")
            var localStorageArray = [];
            if(!Array.isArray(localStorageResult)){
                
                
                localStorageArray[0] = localStorageResult
            } else {
                localStorageArray = localStorageResult
            }
        
            localStorageArray.push(passedQuery);
            window.localStorage.setItem("searchQuery", JSON.stringify(localStorageArray));
        }

        let queryButtons = JSON.parse(window.localStorage.searchQuery)
        console.log(queryButtons);
        //generateIDS

        // for(let i = 0; i < queryButtons.length; i++){
        //     queryButtons[i] = queryButtons[i]+i
        // }

        // let queryButtons = <?php //echo json_encode($_SESSION['searchQuery']);?>
    
        let searchConfirmation = document.getElementById("searchConfirmationContainer")

        let generateGraphButton = document.createElement("button")
        generateGraphButton.classList.add("searchConfirmationButton")
        generateGraphButton.textContent = "Generate Graph";

        generateGraphButton.addEventListener("click", function(){
            let currentLink= location.protocol + '//' + location.host + location.pathname
            //link without any attributes at all
            
            console.log("QUERY BUTTONS")
            console.log(queryButtons);
            let param1 = "?generateGraph=True"
            let param2 = "&graphParams="+ JSON.stringify(queryButtons);
            let param3 = "&searchHistory=True"

            console.log(param2);
            currentLink = currentLink + param1 + param2 + param3;

            alert(currentLink)
            window.localStorage.searchQuery = undefined
            window.location = currentLink
            // debugger;

            
            
        })
        searchConfirmation.insertAdjacentElement("beforeend", generateGraphButton)
        
        let searchContainer = document.getElementById("searchQueryContainer")
        let queryIDs = [];

        let queryButtonsLength = 0;
        if(Array.isArray(queryButtons)){
            queryButtonsLength = queryButtons.length
        } else {
            //new Fix
            // queryButtons[0] = queryButtons;

            //end of new fix
            queryButtonsLength = 1;
        }


        for(let i = 0; i < queryButtonsLength; i++){
            
            
            let newDiv = document.createElement("div")
            newDiv.classList.add("searchQueryButtonDiv")
            // newDiv.textContent = queryButtons[i];
            searchContainer.insertAdjacentElement("beforeend",newDiv)
            
            let newText = document.createElement("p")
            newText.classList.add("searchQueryButtonText")
            newText.textContent = queryButtons[i];
            newDiv.insertAdjacentElement("beforeend",newText)
            

            //Making ids
            // alert(queryButtons[i]);
            // alert(i);
            queryIDs[i] = queryButtons[i]+i.toString()
            // alert(queryButtons[i])
            //searchContainer.insertAdjacentElement("beforeend",newDiv)
            let newButton = document.createElement("button")
            newButton.classList.add("searchQueryButton")
            newButton.setAttribute("arrayID", queryIDs[i])
            newButton.style.backgroundImage = "url('images/delete.svg')"
            newButton.addEventListener("click", function(){
                // let name = queryButtons[i];
                // alert(this.getAttribute("arrayID"))
                // console.log("NODES");
                // console.log(this.parentNode);
                // console.log(this.parentNode.parentNode);
                // console.log(queryButtons);
                // console.log(queryIDs);
                for(let n = 0; n < queryButtonsLength; n++){

                    if(!Array.isArray(queryButtons)){
                        queryButtons[0] = queryButtons;
                    }

                    console.log(queryButtons.length)
                    // debugger;
                    if(!queryButtons.length){
                        queryButtons[0] = false;
                    }

                    if(queryIDs[n] == this.getAttribute("arrayID")){
                        queryButtons.splice(n,1)
                        queryIDs.splice(n,1)
                        // console.log("NODES");
                        // console.log(this.parentNode);
                        // console.log(this.parentNode.parentNode);
                        this.parentNode.parentNode.removeChild(this.parentNode);
                        window.localStorage.setItem("searchQuery", JSON.stringify(queryButtons))
                    }
                }

                
                
            })
            newDiv.insertAdjacentElement("beforeend",newButton)

            


        }
        console.log(queryButtons);
        // alert(queryButtons);
        </script>
            

        <?php }
        static function tradeSearchResult() { ?>
            <div id='result_box'></div>
        <?php }

        static function tradeContent($graphPage , $stockPrice, $stock) { ?>
            <script
            src="https://code.jquery.com/jquery-3.7.0.js"
           
            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>
            
            <script type="text/javascript">

            function convertMValue(value){
                // alert("MV working")
               let result = parseFloat(value)
               if(isNaN(result)){
                   result = 0.00;
               }

               //let startString = "$";
               //result = startString.concat('',result);
               result = result.toLocaleString('en-US', {style: 'currency', currency: 'USD'})
               return result;

            }
            $(document).ready(function(){
                $(".stockQuantity").on('keyup', function(){
                    // alert("LOL");
                    //Inputs go by val
                    let quantityAmount = parseInt($(".stockQuantity").val());
                    // convertMValue(quantityAmount);
                    // alert(quantityAmount)
                    //Text <x>text</x>
                    let sp = parseFloat($("#stockPrice").attr("value"));
                    // alert($("#stockPrice").attr("value"));
                    let subTotal = sp * quantityAmount;
                    // alert(stockPrice);
                    $(".subTotal").text(convertMValue(subTotal));

                    let brockerageFee = 1 + (subTotal * 0.005);
                    brockerageFee = Number(brockerageFee).toFixed(2);
                    brockerageFee = parseFloat(brockerageFee);
                    //parseFloat(brockerageFee).toFixed(2);
                    let total = brockerageFee + subTotal;
                    console.log("SUB: "+ subTotal + typeof subTotal);
                    console.log("BF: "+ brockerageFee+ typeof brockerageFee);
                    console.log("Total: "+ total+ typeof total);

                    let currentBalance = parseFloat($(".currentBalance").attr("value"));
                    let futureBalance = currentBalance - total;
                    
                    $(".brockerageFee").text(convertMValue(brockerageFee));
                    $(".balanceFee").text(convertMValue(-total));
                    $(".futureBalance").text(convertMValue(futureBalance));
                    $(".total").text(convertMValue(total));
                });
            });
            

            </script>

            
            
            <div class="contentHeader">
                <!-- <div class="contentHeaderItem"><?php// echo $stock->getStockName();?></div>
                <div class="contentHeaderItem">|</div>
                <div class="contentHeaderItem"><?php //echo $stock->getID(); ?></div> -->
                <!-- <div class="contentHeaderItem">Trade History</div>
                <div class="contentHeaderItem">Stock Details</div>
                <div class="contentHeaderItem">Stock Order</div> -->

                <div id="btnTradeHistory" class="contentHeaderItem">Trade History</div>
                <div id="btnStockDetails" class="contentHeaderItem">Stock Details</div>
                <div id="btnStockOrder" class="contentHeaderItem">Stock Order</div>
            </div>

            <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                let buttonHistory = document.getElementById("btnTradeHistory");
                let buttonDetails = document.getElementById("btnStockDetails");
                let buttonOrder = document.getElementById("btnStockOrder");

                let contentGraph = document.getElementById("tradeGraph");
                let contentOrder = document.getElementById("tradeOrder")
                let contentDetails = document.getElementById("stockDetails")
                let contentSHistory = document.getElementById("tradeSpecificHistory")
                let contentGHistory = document.getElementById("tradeGeneralHistory")
                let paneDivider = document.getElementById("cdiv")

                debugger;
                buttonHistory.addEventListener('click', function(){
                    contentSHistory.style.display = "block";
                    contentGHistory.style.display = "block";
                    
                    contentGraph.style.display = "none";
                    contentOrder.style.display = "none";
                    contentDetails.style.display = "none";
                    paneDivider.style.gridTemplateColumns = "1fr 1fr";
                });

                buttonDetails.addEventListener('click', function(){
                    paneDivider.style.gridTemplateColumns = "3fr 2fr";
                    contentGraph.style.display = "block";
                    contentDetails.style.display = "block";
                    
                    contentOrder.style.display = "none";
                    
                    contentSHistory.style.display = "none";
                    contentGHistory.style.display = "none";
                    

                });

                buttonOrder.addEventListener('click', function(){
                    paneDivider.style.gridTemplateColumns = "3fr 2fr";
                    contentGraph.style.display = "block";
                    contentOrder.style.display = "block";

                    contentSHistory.style.display = "none";
                    contentGHistory.style.display = "none";
                    contentDetails.style.display = "none";
                    
                });
            }, false);
            </script>

            <div class="contentDivider" id="cdiv">
                <div class="leftPane" id="leftPane">
                    <div id="tradeGeneralHistory">
                    <table class="tradeTable">
                    <tr class="tableHeader">
                        <td class="columnLeftAlign tableHeader">General History</td>
                        <td></td>
                        <td class="columnRightAlign tableHeader">Date</td>
                        <td class="columnRightAlign tableHeader">Action</td>
                        <td class="columnRightAlign tableHeader">Quantity</td>
                        <td class="columnRightAlign tableHeader">Share Price</td>
                        <td class="columnRightAlign tableHeader">Total Price</td>
                        
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Cineplex</td>
                        <td></td>
                        <td class="columnRightAlign">Feb-02-2024</td>
                        <td class="columnRightAlign">Bought</td>
                        <td class="columnRightAlign">100</td>
                        <td class="columnRightAlign">12.50</td>
                        <td class="columnRightAlign">12,500</td>
                    </tr>
                    </table>
                    </div>
                </div>
                    
                <div class="rightPane">
                    <div id="tradeSpecificHistory">
                    <!-- <table class="tradeTable notBottomTable">
                    <tr class="tableHeader">
                        <td class="columnLeftAlign tableHeader">Stock Summary</td>
                        <td></td>
                        <td class="columnRightAlign tableHeader">Avg Buy</td>
                        <td class="columnRightAlign tableHeader">Avg Sell</td>
                        <td class="columnRightAlign tableHeader">% Dif</td>
                        
                        
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Cineplex</td>
                        <td></td>
                        <td class="columnRightAlign">12.25</td>
                        <td class="columnRightAlign">15.13</td>
                        <td class="columnRightAlign"></td>
                       
                    </tr>
        </table> -->
        <table class="tradeTable">
                    <tr class="tableHeader">
                    <td class="columnLeftAlign tableHeader">Stock History</td>
                        <td class="columnRightAlign tableHeader">Date</td>
                        <td class="columnRightAlign tableHeader">Action</td>
                        <td class="columnRightAlign tableHeader">Quantity</td>
                        <td class="columnRightAlign tableHeader">Share Price</td>
                        <td class="columnRightAlign tableHeader">Total Price</td> 
                    </tr>

                    <tr>
                    <td class="columnLeftAlign">CGX.TRT</td>
                        <td class="columnRightAlign">Feb-02-2024</td>
                        <td class="columnRightAlign">Bought</td>
                        <td class="columnRightAlign">100</td>
                        <td class="columnRightAlign">12.50</td>
                        <td class="columnRightAlign">12,500</td>


                    </tr>
                    <td class="columnLeftAlign">CGX.TRT</td>
                        <td class="columnRightAlign">Feb-02-2024</td>
                        <td class="columnRightAlign">Bought</td>
                        <td class="columnRightAlign">100</td>
                        <td class="columnRightAlign">12.50</td>
                        <td class="columnRightAlign">12,500</td>


                    </tr>
                    <td class="columnLeftAlign">CGX.TRT</td>
                        <td class="columnRightAlign">Feb-02-2024</td>
                        <td class="columnRightAlign">Bought</td>
                        <td class="columnRightAlign">100</td>
                        <td class="columnRightAlign">12.50</td>
                        <td class="columnRightAlign">12,500</td>


                    </tr>
                    
                    </table>

                    </div>
                    <div id="stockDetails">
                    <table class="tradeTable notBottomTable">
                    <tr class="tableHeader">
                        <td class="columnLeftAlign tableHeader">Your Summary</td>
                        <td></td>
                        <td class="columnRightAlign tableHeader">Avg Buy</td>
                        <td class="columnRightAlign tableHeader">Avg Sell</td>
                        <td class="columnRightAlign tableHeader">% Dif</td>
                        
                        
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Cineplex</td>
                        <td></td>
                        <td class="columnRightAlign">12.25</td>
                        <td class="columnRightAlign">15.13</td>
                        <td class="columnRightAlign"></td>
                        <!-- <td class="columnRightAlign">12.50</td>
                        <td class="columnRightAlign">12,500</td> -->
                    </tr>
        </table>
                    </div>

                
                <!-- <p class="ptest">lol</p> -->
                <form id="tradeOrder" method="POST" action="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/trade.php";?>">
                    <input name="stockID" type="hidden" value="<?php echo $stock->getID(); ?>">
                    <table class="tradeTable">
                    <tr class="tableHeader">
                        <td class="columnLeftAlign tableHeader"><?php echo $stock->getID(); ?></td>
                        <td></td>
                        <td class="columnLeftAlign tableHeader">Order</td>
                        <td></td>
                    </tr>
                    <tr class="columnAlign">
                    <td class="columnLeftAlign">Share Price</td>
                    <td id="stockPrice" class="columnRightAlign columnCenter" value="<?php echo $stockPrice;?>">$<?php echo $stockPrice;?></td>
  <td class="columnLeftAlign">Action</td>
                        <!-- <input type="textbox" placeholder="Amount"> -->
                        <td class="columnRightAlign orderTableBox columnCenter"><select class="orderTableSelectBox orderTableBox"><option class="tradeOrderOption" value="buy">Buy</option>
  <option class="tradeOrderOption" value="sell">Sell</option>
  <option class="tradeOrderOption" value="test">test</option></select></td>
                        
                    </tr>

                    <tr class="columnAlign">
                        <td class="columnLeftAlign">Quantity</td>
                        <!-- <input type="textbox" placeholder="Amount"> -->
                        <td class="columnRightAlign columnCenter"><input name="stockQuantity" class="stockQuantity orderTableBox" type="textbox"></td>
                        <td class="columnLeftAlign">Type</td>
                        <td class="columnRightAlign"><select class="orderTableSelectBox orderTableBox"><option class="tradeOrderOption" value="market">Market</option>
  
  <option class="tradeOrderOption" value="limit">Limit</option></select></td>
                        
                    </tr>
                    <tr class="tableHeader">
                        <td class="columnLeftAlign">Order Summary</td>
                        <td id="stockPrice" class="columnRightAlign columnCenter" value="<?php echo $stockPrice;?>">$<?php echo $stockPrice;?></td>
                        <td class="columnLeftAlign">Account Info</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="columnLeftAlign">Subtotal</td>
                        <td class="columnRightAlign columnCenter subTotal">0</td>
                        <td class="columnLeftAlign">Available Funds</td>
                        <td class="columnRightAlign currentBalance" value="25000.00">$25000.00</td>
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Brockerage Fee</td>
                        <td class="columnRightAlign columnCenter brockerageFee">0</td>
                        <td></td>
                        <td class="columnRightAlign balanceFee">0</td>
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Total</td>
                        <td class="columnRightAlign columnCenter total">0</td>
                        <td class="columnLeftAlign">Future Balance</td>
                        <td class="columnRightAlign futureBalance">$25000.00</td>
                    </tr>
                    <tr class="tableHeader">
                    <td class="columnLeftAlign"><input class="tradeButton graphDateButton" type="submit" value="Stock Info"></td>
                        <td class="columnRightAlign columnCenter"><input class="tradeButton graphDateButton" type="submit" value="Complete Order"></td>
                        <td class="columnLeftAlign"></td>
                        <td class="columnRightAlign"><input class="tradeButton graphDateButton" type="submit" value="Manage Balance"></td>
                    </tr>

                
                </table>
        </form>
                
                <!-- <input type="submit" value="Confirm"> -->
                <!-- <form class="tradeTableForm" method="post">
                </form> -->
                </div>
            </div>
            
    
           
            <!-- <input type="text" placeholder="Search"> -->
        </div>
        </div>

    



</body>




</html>
        

    <?php }
    static function currencyExchange(){ ?>
    <div>
        <div>Converting:        CAD to USD</div>

        <div>CAD Balance                $2105         </div>
        <div>    Exchanged              $100 </div>
        <div>    Remaining              $2005</div> 

        <div>Exchange Rate:     1   to 0.74    </div>
        <div>Value              $100 to $74</div>
        <div>Fee 1.5%                   $(1.25)</div>
        <div>Total (USD)                $72.75</div>


    </div>

    <table id="currencyMenu">
        <tr class="currencyMenuItem">>
            <td></td>
            <td>Initial Currency</td>
            <td></td>
            <td>Converted Currency</td>

        </tr>
        <tr class="currencyMenuItem">
            <td class="bigColumn">Converting</td>
            <td class="textAlignRight">CAD</td>
            <td class="currencyColumnTitle">to</td>
            <td>USD</td>
        </tr>
        <tr class="currencyMenuItem">
            <td class="bigColumn">Exchange Rate</td>
            <td class="textAlignRight">1.00</td>
            <td>to</td>
            <td class="textAlignRight">0.74</td>
        </tr>
        <tr class="currencyMenuItem">
            <td>Inital Balance</td>
            <td class="textAlignRight">$12500</td>
            <td></td>
            <td class="textAlignRight">$3000</td>
        </tr>

        <tr class="currencyMenuItem">
            <td>Value</td>
            <td class="textAlignRight underline">($10000)</td>
            <td>to</td>
            <td class="textAlignRight underline">$7400</td>
        </tr>
        
        <!-- <tr class="currencyMenuItem">
            <td>Exchanged</td>
            <td class="textAlignRight">$100</td>
            <td></td>
            <td class="textAlignRight">$100</td>
        </tr> -->
        <tr class="currencyMenuItem">
            <td>New Balance</td>
            <td class="textAlignRight">$2500</td>
            <td></td>
            <td class="textAlignRight">$10400</td>
        </tr class="currencyMenuItem">
        <tr class="currencyMenuItem">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="currencyMenuItem">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="currencyMenuItem">
            <td>Sub-total</td>
            <td></td>
            <td></td>
            <td class="textAlignRight">$7400</td>
        </tr>

        
       
        <tr class="currencyMenuItem">
            <td>Conversion Fee 1.5%</td>
            <td></td>
            <td></td>
            <td class="textAlignRight underline">($125)</td>
        </tr>
        <tr class="currencyMenuItem">
            <td>Total (USD)</td>
            <td></td>
            <td></td>
            <td class="textAlignRight">$7275</td>
        </tr>
        <tr class="currencyMenuItem">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    
    </table>
        
    <?php }

    static function manageCurrencyOptions(){ ?>

        <script type="text/javascript">
        $(Document).ready(function(){
            $(".currencyOption").click(function(){
                let attr = $(this).attr('link')
                window.open(attr, "_self");
            })

        });
    </script>
        <div class="currencyOptionsContainer">
            <div class="currencyOption" link="<?php echo $_SERVER['PHP_SELF']."?action=deposit";?>">
                <div class="currencyTitle">Deposit</div>
                <div class="currencyDescription">Increase the contributions of your account with any currency.</div>
            </div>
            <div class="currencyOption" link="<?php echo $_SERVER['PHP_SELF']."?action=convert";?>">
                <div class="currencyTitle">Convert</div>
                <div class="currencyDescription">Exchange your prefered currencies.</div>
            </div>
            <div class="currencyOption" link="<?php echo $_SERVER['PHP_SELF']."?action=withdrawl";?>">
                <div class="currencyTitle">Withdraw</div>
                <div class="currencyDescription"> Transfer the desired quantity of currency out of your account.</div>
            </div>
        </div>

    <?php }

    static function convertMenu(){

    }

    static function addBalance(){
        
    }


}



?>