<?php

class PageFunctionality {
    


    static function nav() { ?>

<html>


<link rel='stylesheet' type='text/css' href='styles/landing.css'>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu%20Condensed">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
<body>

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
                <a href="" class="menuText">Charts</a>
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

        static function tradeSearchResult() { ?>
            <div id='result_box'></div>
        <?php }

        static function tradeContent($MG , $stockPrice, $stock) { ?>
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
                <div class="contentHeaderItem"><?php echo $stock->getStockName();?></div>
                <div class="contentHeaderItem">|</div>
                <div class="contentHeaderItem"><?php echo $stock->getID(); ?></div>
            </div>

            <div class="contentDivider">
                <div class="leftPane"><?php $MG->displayGraph();?>
                </div>
                <div class="rightPane">


                
                <!-- <p class="ptest">lol</p> -->
                <form method="POST" action="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/trade.php";?>">
                <table class="tradeTable">
                    <tr>
                        <td class="columnLeftAlign"><?php echo $stock->getID(); ?></td>
                        <td></td>
                        <td class="columnLeftAlign">Account</td>
                        <td></td>
                    </tr>
                    <tr class="columnAlign">
                        <td class="columnLeftAlign">Quantity</td>
                        <!-- <input type="textbox" placeholder="Amount"> -->
                        <td><input name="stockQuantity" class="stockQuantity" type="textbox"></td>
                        <td></td>
                        <td><input name="stockID" type="hidden" value="<?php echo $stock->getID(); ?>"></td>
                        
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Share Price</td>
                        <td id="stockPrice" class="columnRightAlign " value="<?php echo $stockPrice;?>">$<?php echo $stockPrice;?></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="columnLeftAlign">Subtotal</td>
                        <td class="columnRightAlign subTotal">0</td>
                        <td class="columnLeftAlign">Available Funds</td>
                        <td class="columnRightAlign currentBalance" value="25000.00">$25000.00</td>
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Brockerage Fee</td>
                        <td class="columnRightAlign brockerageFee">0</td>
                        <td></td>
                        <td class="columnRightAlign balanceFee">0</td>
                    </tr>
                    <tr>
                        <td class="columnLeftAlign">Total</td>
                        <td class="columnRightAlign total">0</td>
                        <td class="columnLeftAlign">Future Balance</td>
                        <td class="columnRightAlign futureBalance">$25000.00</td>
                    </tr>
                    <tr>
                        <td class="columnLeftAlign"></td>
                        <td class="columnRightAlign"><input type="submit" value="confirm"></td>
                        <td class="columnLeftAlign"></td>
                        <td class="columnRightAlign balanceText">Manage Balance</td>
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