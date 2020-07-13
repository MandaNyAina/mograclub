<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a.animating-link {
            position: relative;
            text-decoration: none;
        }
        a.animating-link:hover {
            cursor: pointer;
        }
        a.animating-link:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #000;
            visibility: hidden;
            -webkit-transform: scaleX(0);
            transform: scaleX(0);
            -webkit-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
        }
        a.animating-link:hover:before {
            visibility: visible;
            -webkit-transform: scaleX(1);
            transform: scaleX(1);
        }
    </style>
</head>
<body ng-controller="appCtrl">
    <h2 class="text-center">Agate groups</h2> 
    <div>
        <button ng-click="changeColor('A','success','AC')" data-toggle="modal" data-target="#joinGreen" class="xblock timeControl" style="display: inline-block;width: 32.5%;height: 100px; background-color: green;"></button>
        <button ng-click="changeColor('B','secondary','BC')" data-toggle="modal" data-target="#joinTIN" class="xblock timeControl TIN" style="display: inline-block;width: 32.5%;height: 100px;"></button>
        <button ng-click="changeColor('C','warning','CC')" data-toggle="modal" data-target="#joinOrange" class="xblock timeControl" style="display: inline-block;width: 32.5%;height: 100px; background-color: Orange;"></button>
    </div>
    
    <!-- Green modal -->
    <div class="modal fade" id="joinGreen" tabindex="-1" role="dialog" aria-labelledby="joinGreenTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header GREEN">
            
            <h5 class="modal-title" id="joinGreenTitle">JOIN Green</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Contract :
                <div class="text-center mt-3 mb-3">
                    <div ng-click="selectContract('A10','success')" class="btn btn-success btn-sm" id="A10" style="display: inline-block;width: 20%;">10</div>
                    <div ng-click="selectContract('A100','success')"  class="btn btn-outline-success btn-sm" id="A100" style="display: inline-block;width: 20%;">100</div>
                    <div ng-click="selectContract('A1000','success')"  class="btn btn-outline-success btn-sm" id="A1000" style="display: inline-block;width: 20%;">1000</div>
                    <div ng-click="selectContract('A10000','success')"  class="btn btn-outline-success btn-sm" id="A10000" style="display: inline-block;width: 20%;">10000</div>
                </div>
                Number :
                <div class="text-center mt-3 mb-4">
                    <div ng-click="selectNumber('A',3,'success')" class="btn btn-outline-success btn-sm" id="A3b" style="display: inline-block;width: 27%;">3</div>
                    <div ng-click="selectNumber('A',5,'success')" class="btn btn-outline-success btn-sm" id="A5b" style="display: inline-block;width: 27%;">5</div>
                    <div ng-click="selectNumber('A',10,'success')" class="btn btn-outline-success btn-sm" id="A10b" style="display: inline-block;width: 27%;">10</div>
                </div>
                <div class="input-group blockNumber" style="margin-left: 8.5%;">
                    <div class="input-group-prepend">
                        <button ng-click="setValue('A','moins','success')" ng-disabled="!bet || bet == 1" class="btn btn-outline-success"> - </button>
                    </div>
                    <input type="number"
                    class="form-control text-center"
                    name="" id="numberContract" aria-describedby="helpId"
                    ng-model="bet"
                    ng-change="selectNumber('A',bet,'success')"
                    ng-blur="selectNumberA(bet)"
                    >
                    <div class="input-group-append">
                        <button ng-click="setValue('A','plus','success')" ng-disabled="!bet || bet > 98" class="btn btn-outline-success">+</button>
                    </div>
                </div>
            </div>
            <table class="table table-borderless" style="margin-left: 8.5%;">
                <tr>
                    <td><label for="AC"><input ng-model="confirmCondition" type="checkbox" class="checkbox checkbox-success checkbox-inline" name="AC" id="AC"> I agree</label>
                        <a data-toggle="modal" data-target="#condition" class="animating-link text-success">the Presale management rule</a>
                    </td>
                </tr>
            </table>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button 
                ng-click="play({
                        id: '<?php echo $_SESSION['user_loggeg']['id']; ?>',
                        groups:'AGATE',
                        amount: balanceValue,
                        selected: 'GREEN',
                        branch: 'C',
                        contract: contract,
                        bet,
                        attr: 'A',
                        nav: 'plus',
                        colorNav:'success'
                })"
                ng-disabled="!confirmCondition" id="btnGo" data-dismiss="modal" type="button" class="btn btn-primary">Go</button>
            </div>
        </div>
        </div>
    </div>
    <!-- TIN MODAL-->
    <div class="modal fade" id="joinTIN" tabindex="-1" role="dialog" aria-labelledby="joinTINTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header TIN">
            <h5 class="modal-title text-light" id="joinTINTitle">JOIN TIN</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Contract :
                <div class="text-center mt-3 mb-3">
                    <div ng-click="selectContract('B10','secondary')" class="btn btn-secondary btn-sm" id="B10" style="display: inline-block;width: 20%;">10</div>
                    <div ng-click="selectContract('B100','secondary')"  class="btn btn-outline-secondary btn-sm" id="B100" style="display: inline-block;width: 20%;">100</div>
                    <div ng-click="selectContract('B1000','secondary')"  class="btn btn-outline-secondary btn-sm" id="B1000" style="display: inline-block;width: 20%;">1000</div>
                    <div ng-click="selectContract('B10000','secondary')"  class="btn btn-outline-secondary btn-sm" id="B10000" style="display: inline-block;width: 20%;">10000</div>
                </div>
                Number :
                <div class="text-center mt-3 mb-4">
                    <div ng-click="selectNumber('B',3,'secondary')" class="btn btn-outline-secondary btn-sm" id="B3b" style="display: inline-block;width: 27%;">3</div>
                    <div ng-click="selectNumber('B',5,'secondary')" class="btn btn-outline-secondary btn-sm" id="B5b" style="display: inline-block;width: 27%;">5</div>
                    <div ng-click="selectNumber('B',10,'secondary')" class="btn btn-outline-secondary btn-sm" id="B10b" style="display: inline-block;width: 27%;">10</div>
                </div>
                <div class="input-group  blockNumber" style="margin-left: 8.5%;">
                    <div class="input-group-prepend">
                        <button ng-click="setValue('B','moins','secondary')" ng-disabled="!bet || bet == 1" class="btn btn-outline-secondary"> - </button>
                    </div>
                    <input type="number"
                    class="form-control text-center"
                    name="" id="numberContract" aria-describedby="helpId"
                    ng-model="bet"
                    ng-change="selectNumber('B',bet,'secondary')"
                    ng-blur="selectNumberA(bet)"
                    >
                    <div class="input-group-append">
                        <button ng-click="setValue('B','plus','secondary')" ng-disabled="!bet || bet > 98" class="btn btn-outline-secondary">+</button>
                    </div>
                </div>
            </div>
            <table class="table table-borderless" style="margin-left: 8.5%;">
                <tr>
                    <td><label for="BC"><input ng-model="confirmCondition" type="checkbox" class="checkbox checkbox-secondary checkbox-inline" name="BC" id="BC"> I agree</label>
                        <a data-toggle="modal" data-target="#condition" class="animating-link text-secondary">the Presale management rule</a>
                    </td>
                </tr>
            </table>
            <div class="modal-footer">
            <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button ng-click="play({
                    id: '<?php echo $_SESSION['user_loggeg']['id']; ?>',
                    groups:'AGATE',
                    amount: balanceValue,
                    selected: 'TIN',
                    branch: 'C',
                    contract,
                    bet
                })" ng-disabled="!confirmCondition" id="btnGo" data-dismiss="modal" type="button" class="btn btn-primary">Go</button>
            </div>
        </div>
        </div>
    </div>
    <!-- ORANGE MODAL-->
    <div class="modal fade" id="joinOrange" tabindex="-1" role="dialog" aria-labelledby="joinOrangeTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ORANGE">
            <h5 class="modal-title" id="joinOrangeTitle">JOIN Orange</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Contract :
                <div class="text-center mt-3 mb-3">
                    <div ng-click="selectContract('C10','warning')" class="btn btn-warning btn-sm" id="C10" style="display: inline-block;width: 20%;">10</div>
                    <div ng-click="selectContract('C100','warning')"  class="btn btn-outline-warning btn-sm" id="C100" style="display: inline-block;width: 20%;">100</div>
                    <div ng-click="selectContract('C1000','warning')"  class="btn btn-outline-warning btn-sm" id="C1000" style="display: inline-block;width: 20%;">1000</div>
                    <div ng-click="selectContract('C10000','warning')"  class="btn btn-outline-warning btn-sm" id="C10000" style="display: inline-block;width: 20%;">10000</div>
                </div>
                Number :
                <div class="text-center mt-3 mb-4">
                    <div ng-click="selectNumber('C',3,'warning')" class="btn btn-outline-warning btn-sm" id="C3b" style="display: inline-block;width: 27%;">3</div>
                    <div ng-click="selectNumber('C',5,'warning')" class="btn btn-outline-warning btn-sm" id="C5b" style="display: inline-block;width: 27%;">5</div>
                    <div ng-click="selectNumber('C',10,'warning')" class="btn btn-outline-warning btn-sm" id="C10b" style="display: inline-block;width: 27%;">10</div>
                </div>
                <div class="input-group blockNumber" style="margin-left: 8.5%;">
                    <div class="input-group-prepend">
                        <button ng-click="setValue('C','moins','warning')" ng-disabled="!bet || bet == 1" class="btn btn-outline-warning"> - </button>
                    </div>
                    <input type="number"
                    class="form-control text-center"
                    name="" id="numberContract" aria-describedby="helpId"
                    ng-model="bet"
                    ng-change="selectNumber('C',bet,'warning')"
                    ng-blur="selectNumberA(bet)"
                    >
                    <div class="input-group-append">
                        <button ng-click="setValue('C','plus','warning')" ng-disabled="!bet || bet > 98" class="btn btn-outline-warning">+</button>
                    </div>
                </div>
            </div>
            <table class="table table-borderless" style="margin-left: 8.5%;">
                <tr>
                    <td><label for="CC"><input ng-model="confirmCondition" type="checkbox" class="checkbox checkbox-warning checkbox-inline" name="CC" id="CC"> I agree</label>
                        <a data-toggle="modal" data-target="#condition" class="animating-link text-warning">the Presale management rule</a>
                    </td>
                </tr>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button ng-click="play({
                    id: '<?php echo $_SESSION['user_loggeg']['id']; ?>',
                    groups:'AGATE',
                    amount: balanceValue,
                    selected: 'ORANGE',
                    branch: 'C',
                    contract,
                    bet
                })" ng-disabled="!confirmCondition" id="btnGo" data-dismiss="modal" type="button" class="btn btn-primary">Go</button>
            </div>
        </div>
        </div>
    </div>

    <div>
    <?php
        function createForm($i) {
            $id = $_SESSION['user_loggeg']['id'];
            $idChar = ["D","E","F","G","H","I","J","K","L","M"];
            $form = '
                <button ng-click="changeColor(\''.$idChar[$i].'\',\'primary\',\''.$idChar[$i].'C\')" data-toggle="modal" data-target="#number'.$i.'" class="xblock timeControl bg-primary text-center" style="display: inline-block;width: 19%;height: 25px;margin-top:5px;border:0px">
                    '.$i.'
                </button>
                <div class="modal fade" id="number'.$i.'" tabindex="-1" role="dialog" aria-labelledby="number'.$i.'Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="number'.$i.'Title">Select '.$i.'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Contract :
                            <div class="text-center mt-3 mb-3">
                                <div ng-click="selectContract(\''.$idChar[$i].'10\',\'primary\')" class="btn btn-primary btn-sm" id="'.$idChar[$i].'10" style="display: inline-block;width: 20%;">10</div>
                                <div ng-click="selectContract(\''.$idChar[$i].'100\',\'primary\')"  class="btn btn-outline-primary btn-sm" id="'.$idChar[$i].'100" style="display: inline-block;width: 20%;">100</div>
                                <div ng-click="selectContract(\''.$idChar[$i].'1000\',\'primary\')"  class="btn btn-outline-primary btn-sm" id="'.$idChar[$i].'1000" style="display: inline-block;width: 20%;">1000</div>
                                <div ng-click="selectContract(\''.$idChar[$i].'10000\',\'primary\')"  class="btn btn-outline-primary btn-sm" id="'.$idChar[$i].'10000" style="display: inline-block;width: 20%;">10000</div>
                            </div>
                            Number :
                            <div class="text-center mt-3 mb-4">
                                <div ng-click="selectNumber(\''.$idChar[$i].'\',3,\'primary\')" class="btn btn-outline-primary btn-sm" id="'.$idChar[$i].'3b" style="display: inline-block;width: 27%;">3</div>
                                <div ng-click="selectNumber(\''.$idChar[$i].'\',5,\'primary\')" class="btn btn-outline-primary btn-sm" id="'.$idChar[$i].'5b" style="display: inline-block;width: 27%;">5</div>
                                <div ng-click="selectNumber(\''.$idChar[$i].'\',10,\'primary\')" class="btn btn-outline-primary btn-sm" id="'.$idChar[$i].'10b" style="display: inline-block;width: 27%;">10</div>
                            </div>
                            <div class="input-group blockNumber" style="margin-left: 8.5%;">
                                <div class="input-group-prepend">
                                    <button ng-click="setValue(\''.$idChar[$i].'\',\'moins\',\'primary\')" ng-disabled="!bet || bet == 1" class="btn btn-outline-primary"> - </button>
                                </div>
                                <input type="number"
                                class="form-control text-center"
                                name="" id="numberContract" aria-describedby="helpId"
                                ng-model="bet"
                                ng-change="selectNumber(\''.$idChar[$i].'\',bet,\'primary\')"
                                ng-blur="selectNumberA(bet)"
                                >
                                <div class="input-group-append">
                                    <button ng-click="setValue(\''.$idChar[$i].'\',\'plus\',\'primary\')" ng-disabled="!bet || bet > 98" class="btn btn-outline-primary">+</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-borderless" style="margin-left: 8.5%;">
                            <tr>
                                <td><label for="'.$idChar[$i].'C"><input ng-model="confirmCondition" type="checkbox" class="checkbox checkbox-primary checkbox-inline" name="'.$idChar[$i].'C" id="'.$idChar[$i].'C"> I agree</label>
                                    <a data-toggle="modal" data-target="#condition" class="animating-link text-primary">the Presale management rule</a>
                                </td>
                            </tr>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button ng-click="play({
                                id: \''.$id.'\',
                                groups:\'AGATE\',
                                amount: balanceValue,
                                selected: '.$i.',
                                branch: \'N\',
                                contract,
                                bet
                            })" data-dismiss="modal" ng-disabled="!confirmCondition" id="btnGo" type="button" class="btn btn-primary">Go</button>
                        </div>
                    </div>
                    </div>
                </div>
            ';
            return $form;
        }
        for ($i=0;$i<10;$i++) {
            echo createForm($i);
        }
    ?>
    </div>
    <div class="mt-2 bg-light text-dark"><b>Current period : </b> {{period_A}}</div>
    <table class="table table-bordered mt-2 mimtable">
        <thead class="bg-light">
            <th>Period</th>
            <th>Price</th>
            <th>Number</th>
            <th>Result</th>
        </thead>
        <tbody>
            <tr ng-repeat="item in agatePart track by item.period">
                <td>{{item.period}}</td>
                <td>{{item.price}}</td>
                <td>{{item.number}}</td>
                <td>
                <div ng-repeat="i in item.result.split(',') track by $index" class="{{i}} mr-2" style="width: 15px; height: 15px; border-radius: 50%;display: inline-block;">

                </div>
                </td>    
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center" ng-click="goTo('more/agate')" colspan="4">
                    <p class="btn btn-link">View more <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></p>
                </td>
            </tr>
        </tfoot>
    </table>
    <table class="table table-bordered w-100 text-center">
        <tr>
            <td ng-click="navigateOrderList(0)" id="coNav" class="bg-secondary">Current Order</td>
            <td ng-click="navigateOrderList(1)" id="hoNav">History Order</td>
        </tr>
    </table>

    <table class="table table-bordered mimtable" ng-show="navigateOrder == 0">
        <thead>
            <tr>
                <th colspan="4" class="text-center bg-light">Current Order</th>
            </tr>
            <tr>
                <th style="width: 35%;">
                    Order ID
                </th>
                <th>
                    Selected
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Groups
                </th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="item in currentOrderA track by $index">
                <td>
                    {{item.numOrder}}
                </td>
                <td>
                    {{item.selected}}
                </td>
                <td>
                    {{item.amount}}
                </td>
                <td>
                    {{item.groups}}
                </td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-bordered mimtable" ng-show="navigateOrder == 1">
        <thead>
            <tr>
                <th colspan="5" class="w-25 text-center bg-light">History Order</th>
            </tr>
            <tr>
                <th>
                    Order ID
                </th>
                <th>
                    Selected
                </th>
                <th style="width: 3%;">
                    Amount
                </th>
                <th>
                    Groups
                </th>
                <th class="bg-light">
                    Reward
                </th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="item in historyOrderA track by $index">
                <td>
                    {{item.numOrder}}
                </td>
                <td>
                    {{item.selected}}
                </td>
                <td>
                    {{item.amount}}
                </td>
                <td>
                    {{item.groups}}
                </td>
                <td class="{{item.is_win==1?'bg-success':bg-light}}">
                    {{item.is_win | isWin}} 
                    
                </td>
            </tr>
        </tbody>
    </table>
        <!-- regle-->
        <div class="modal fade" id="condition" tabindex="-1" role="dialog" aria-labelledby="joinVIOLETTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body" style="height: 50vh; overflow: auto;">
            <div style="white-space:pre-wrap;font-size: 14px;">
<h3 class="text-center mt-3">Please confirm you are not from one of below states:</h3>

Andhra Pradesh, Bihar, Chhattisgarh, Gujarat, Haryana, Himachal Pradesh, Jammu and Kashmir, Jharkhand, Karnataka, Odisha, Rajasthan, Tamil Nadu, Tripura, Telangana, Uttar Pradesh, Uttarakhand



Presale management rule

In order to protect the legitimate rights and interests of users participating in the presale and maintain the normal operation order of the presale, the rules are formulated in accordance with relevant agreements and rules of national laws and regulations.

<h3 class="text-danger">Chapter 1 Definition</h3>

1.1                Presale definition: refers to a sales model in which a merchant provides a product or service plan, gathers consumer orders through presale product tools, and provides goods and / or services to consumers according to prior agreement.

1.2                The presale model is a "deposit" model. "Deposit" refers to a fixed amount of presale commodity price pre-delivered. “The deposit” can participate in small games and have the opportunity to win more deposits. The deposit can be directly exchanged for commodities. The deposit is not redeemable.

1.3                Presale products: refers to the products released by merchants using presale product tools. Only the presale words are marked on the product title or product details page, and the products that do not use the presale product tools are not presale products.

1.4                Presale system: Refers to the system product tools provided to support merchants for presale model sales.

1.5                Presale commodity price: refers to the selling price of presale commodity. The price of presale goods is composed of two parts: deposit and final payment.

1.6                Presale deposit: Refers to a certain amount of money that consumers pay in advance when purchasing presale goods, which is mainly used as a guarantee to purchase presale goods and determine the purchase quota.

1.7                Presale final payment: refers to the amount of money that the consumer still has to pay after the presale commodity price minus the deposit.

 

<h3 class="text-danger">Chapter 2 Presale management specifications</h3>

2.1 	Commodity management

2.1.1 		Presale deposit time: up to 7 days can be set.

2.1.2 		Presale final payment time: The start time of the final payment is within 7 days.

2.1.3 		During the presale of commodities, the system does not support merchants to modify the price of pre-sold commodities (including deposits and balances), but the amount of remaining commodity inventory can be modified according to the actual situation of inventory.

2.1.4 		To avoid unnecessary disputes, If the presale product is a customized product, the merchant should clearly inform the consumer on the product page of the production cycle and delivery time of the product, and contact the consumer to confirm the delivery standard, delivery time, etc.

2.1.5 		For customized products, the merchant has not agreed with the consumer on the delivery time and delivery standard, the delivery standard proposed by the consumer is unclear or conflicts and after the merchant places an order, he(she) starts production and delivery without confirming with the consumer, if the consumer initiates a dispute as a result, the platform will treat it as a normal delivery time limit order fulfillment.

2.2 	Transaction management

2.2.1 		Consumers who use the pre-sale system will lock in the pre-sale quota after placing an order for goods. If the pre-sale order is overtime, the system will automatically cancel it.

2.2.2 		During the presale period, the merchant shall not cancel the presale activities without reason. For presale activities that have generated orders, the merchant must not cancel the order without the consumer ’s consent. If the consumer agrees, the merchant should double return the deposit paid by the consumer; if the consumer does not agree to cancel the order, the merchant should perform the contract according to the order.

2.2.3 		If the final payment of the presale order is not completed due to consumer reasons, the merchant can deduct the deposit paid by the consumer; if the merchant actively negotiates with the consumer to terminate the order before paying the final payment, the merchant shall double Return the deposit paid by the consumer.

2.3 	Delivery Management

2.3.1 		Delivery time limit setting

If the merchant sets the delivery time limit through the presale system, it should be shipped within the set time limit.

2.3.2 		Shipping way

The third-party delivery the orders.

Customers need to provide your name, address and phone number to facilitate third-party delivery orders.

2.4 After-sales management

Presale products shall provide after-sales service in accordance with the "Regulations for After-sales Service of Platform Merchants".

 

<h3 class="text-warning">Explanation</h3>

Mall transaction mode

There are two ways to buy in the mall, one is full purchase, and the other is deposit purchase.

In the mode of full purchase, you can place an order directly and purchase goods in full payment.

The deposit purchase mode will freeze the customer's deposit, and the customer will take delivery after completing the final payment within 7 days. Users who have paid a deposit will be given an extra point quiz game. According to the analysis of market fluctuations, they have the opportunity to win more points to deduct the payment or send red envelopes to friends.

 

The pre-order model has many benefits for customers. The deposit not only generates an order for the customer, but also gives the customer an equal amount of red envelopes, which can be withdrawn immediately. Although the deposit is not refundable, the red envelope converted from the deposit can be withdrawn without any loss to the customer.

 

1. After the customer pays the deposit and orders, a merchandise order is generated, and the mall began to prepare this order. This deposit cannot be returned. After the customer needs to make up the balance, the mall will ship the goods. If the customer does not make up the balance, the product order will always exist.

2. After paying the deposit, the customer will be given a red envelope account with the same amount of deposit.

1. The red envelope can be withdrawn directly, so that instead of losing money, the customer has added a commodity order generated by a deposit. And red envelopes can also be given to friends.

2. If the customer uses the red envelope account to participate in the game, you can earn more red envelopes, but if the game loses, the red envelope will be gone, but his merchandise order is still there.
</div>
            </div>
            <div class="modal-footer text-center" style="font-size: 14px;">
                Note: I have carefully read all contents of this presale management rule, Risk Disclosure Agreement and Risk Agreement and I am agreed to continue with my own risk.
                <button ng-click="confirmConditionBtn()" class="btn btn-success btn-sm text-center" data-dismiss="modal">Confirm</button>
            </div>
        </div>
        </div>
    </div>
</body>
</html>