import {app} from '../js/app.module.js';

app.config(function($httpProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
});

app.config($routeProvider => {
    $routeProvider
    .when("/",{
        templateUrl: "../home/home.php"
    })
    .when("/promotion/invite",{
        templateUrl: "../home/promotion.php"
    })
    .when("/complaint",{
        templateUrl: "../home/complaintBase.php"
    })
    .when("/complaint/new",{
        templateUrl: "../home/complaint.php"
    })
    .when("/complaint/response",{
        templateUrl: "../home/complaintResponse.php"
    })
    .when("/more/:group",{
        templateUrl: "../home/more.php"
    })
    .when("/task",{
        templateUrl: "../home/task.php"
    })
    .when("/redenvelop",{
        templateUrl: "../home/redenvelop.php"
    })
    .when("/promotion",{
        templateUrl: "../home/promotionBase.php"
    })
    .when("/wallet",{
        templateUrl: "../home/wallet.php"
    })
    .when("/bank",{
        templateUrl: "../home/bank.php"
    })
    .when("/address",{
        templateUrl: "../home/address.php"
    })
    .when("/agate",{
        templateUrl: "../home/agate.php"
    })
    .when("/security", {
        templateUrl: "../home/security.php"
    })
    .when("/account",{
        templateUrl: "../home/account.php"
    })
    .when("/recharge",{
        templateUrl: "../home/recharge.php"
    })
    .when("/beryl", {
        templateUrl: "../home/beryl.php"
    })
    .when("/celestine", {
        templateUrl: "../home/celestine.php"
    })
    .when("/diamond", {
        templateUrl: "../home/diamond.php"
    })
    .when("/emarald", {
        templateUrl: "../home/emerald.php"
    })
    .when("/flint", {
        templateUrl: "../home/flint.php"
    })
})