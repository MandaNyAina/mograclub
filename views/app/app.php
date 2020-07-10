<?php
    require '../../index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">
    <script type="module" src="../../assets/js/script.js"></script>
    <title>MoGRaClubs</title>
    <style>
        .loader {
            display: inline-block;
            margin-left: 10px;
            color: #ffffff;
            font-size: 10px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%; 
            position: relative;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            }
            @-webkit-keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            }
            @keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            }
            @-webkit-keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }
            @keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body ng-controller="appCtrl">
    <div class="w-100 bg-light" style="height: 27vh;background-image: url(../../assets/images/bannier.jpg);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <span style="border-radius: 0px 0px 10px 0px;opacity: 0.9;" class="bg-light pl-3 pr-3 pt-2 pb-2 text-dark">{{fname}}</span>
        <a class="btn btn-primary btn-sm" ng-click="choiceMenu('')" href="#!/"><i class="fa fa-user-circle" aria-hidden="true"></i></i></a>
        <div class="text-light wrapper">
            <span style="border-radius: 10px;opacity: 0.9;" class="bg-light pl-3 pr-3 pt-2 pb-2 text-dark"><i class="fas fa-award text-success"></i> Balance : {{balanceValue}}</span>
            <a ng-click="choiceMenu('')" class="btn btn-warning btn-sm" href="#!/recharge">Recharge</a>
            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#exampleModalCenter">Rules</button>
            <div class="float-right mt-4">
                <span id="timerCounter" class="p-2 bg-light text-dark" style="border-radius: 15px;">Loading ...</span>
            </div>
            <div class="" style="width: 80px;border-radius: 50px;">
                
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center xtable" style="position: sticky;top: 0;background-color: white;opacity: 0.95;z-index: 10;">
        <tr>
            <td ng-click="choiceMenu('AGATE');goTo('agate')" style="width:15.5%" class="menuChoice {{menu=='AGATE'?'selectedValue':''}}"><a href="#!/agate"><span class="menuMaxLength">Agate<br></span><i class="fa fa-align-center" aria-hidden="true"></i></a></td>
            <td ng-click="choiceMenu('BERYL');goTo('beryl')" style="width:15.5%" class="menuChoice {{menu=='BERYL'?'selectedValue':''}}"><a href="#!/beryl"><span class="menuMaxLength">Beryl<br></span><i class="fa fa-certificate" aria-hidden="true"></i></a></td>
            <td ng-click="choiceMenu('CELES');goTo('celestine')" style="width:15.5%" class="menuChoice {{menu=='CELES'?'selectedValue':''}}"><a href="#!/celestine"><span class="menuMaxLength">Celestine<br></span><i class="fas fa-dice" aria-hidden="true"></i></a></td>
            <td ng-click="choiceMenu('DIAMO');goTo('diamond')" style="width:15.5%" class="menuChoice {{menu=='DIAMO'?'selectedValue':''}}"><a href="#!/diamond"><span class="menuMaxLength">Diamond<br></span><i class="fas fa-gem"></i></a></td>
            <td ng-click="choiceMenu('EMERA');goTo('emarald')" style="width:15.5%" class="menuChoice {{menu=='EMERA'?'selectedValue':''}}"><a href="#!/emarald"><span class="menuMaxLength">Emerald<br></span><i class="fas fa-burn"></i></a></td>
            <td ng-click="choiceMenu('FLIRI');goTo('flint')" style="width:15.5%" class="menuChoice {{menu=='FLIRI'?'selectedValue':''}}"><a href="#!/flint"><span class="menuMaxLength">Flint<br></span><i class="fas fa-chess"></i></a></td>
        </tr>
    </table>
    <div ng-view class="container position-position-absolute"></div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="opacity: 0.9;">
      <div class="modal-body bg-light">
        <div class="text-center text-primary">
            Rules
        </div>
        <hr>
        <ol>
            <li>
                There are only three (3) colours. They are Green, Orange and Violet.
            </li>
            <li>
                The total contract time is two minutes and forty five seconde (2:45), in last thirthy 
                seconde you can't order the contract
            </li>
            <li>
                For contract, 
                <ul>
                    <li>
                        If you spend 100 <i class="fas fa-rupee-sign"></i> or more, after 
                        deducting 2 <i class="fas fa-rupee-sign"></i> as service fee and your contract amount is
                        98 <i class="fas fa-rupee-sign"></i>. (Eg: 100-98, 200-198, ...)
                    </li>
                    <li>
                        If you spend below the 100 <i class="fas fa-rupee-sign"></i>, after deducting 1 
                        <i class="fas fa-rupee-sign"></i> as service fee and your contract amount is 49
                        <i class="fas fa-rupee-sign"></i>. (Eg: 10-9, 20-19, ...)
                    </li>
                    There are totally six (6) groups and you can play whatever you want
                </ul>
                
            </li>
            <li>
                Joing Green - (3, 5, 7, 9), show in result, you get (98 x 2 = 196), (9 x 1.8 = 16.2)
            </li>
            <li>
                Joing Orange - (2, 4, 6, 8), show in result, you get (98 x 2 = 196), (9 x 1.8 = 16.2)
            </li>
            <li>
                Violet colour comes only with green or orange
            </li>
            <li>
                When violet colour comes with green or orange, the profit change as respective
                <ul>
                    <li>
                        If a person select green when it comes with violet, <br>
                        [less than 100 = 98 x 1.25 = 122,5] - [more than 100, 200 = 196 x 1.4 = 274,4]
                    </li>
                    <li>
                        If a person select orange when it comes with violet, <br>
                        [less than 100 = 98 x 1.25 = 122,5] - [more than 100, 200 = 196 x 1.4 = 274,4]
                    </li>
                </ul>
            </li>
            <li>
                When a person select violet directely when it comes either with orange/green, he/she get the
                highest profit <br>
                (Less than 100 <i class="fa fa-caret-right" aria-hidden="true"></i> 49 x 2.8 = 137.2) <br>
                (More than 100 <i class="fa fa-caret-right" aria-hidden="true"></i> 196 x 4.5 = 882)
            </li>
            <li>
                There are 0 - 9 number and separetly also we can bet. <br>
                So if they bets on a number and it came with means. (If it is 10 <i class="fas fa-rupee-sign"></i>,
                profit is 10 x 5 = 50), so the profit is 5 times
            </li>
            <li>
                At last player can select either one colour (green/ orange), he can also select violet simultanious
                per contract. <br>
                A player can select 3 numbers per contract.
            </li>
        </ol>
        <hr>
        <div class="text-center">
            <button class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>