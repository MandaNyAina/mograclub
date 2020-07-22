<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
	<table class="table table-sm table-bordered table-hover">
        <tr ng-click="goTo('task')">
            <td>
                My task
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('redenvelop')">
            <td>
                Red envelope
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('promotion')">
            <td>
                My promotion
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('wallet')">
            <td>
                My wallet
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('complaint')">
            <td>
                Complaints
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('bank')">
            <td>
                My bank
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('address')">
            <td>
                My address
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('security')">
            <td>
                Account security
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('account')">
            <td>
                My Account settings
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="goTo('about')">
            <td>
                About Us
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
        <tr ng-click="redirectTo('../../controller/delog/delog.controller.php')">
            <td>
                Sign out    
                <i class="fa fa-arrow-right float-right" aria-hidden="true"></i>
            </td>
        </tr>
    </table>
</div>
    
</body>
</html>