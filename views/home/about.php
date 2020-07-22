<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">About Us</i></h2>
    <div class="mt-2">
        <table class="table table-bordered table-sm table-hover">
            <tr ng-click="goTo('about/privacy')">
                <td>Privacy Policy<i class="fa fa-arrow-right float-right" aria-hidden="true"></i></td>
            </tr>
            <tr ng-click="goTo('about/refund')">
                <td>Refund / Cancellation Policy<i class="fa fa-arrow-right float-right" aria-hidden="true"></i></td>
            </tr>
            <tr ng-click="goTo('about/risk')">
                <td>Risk Disclosure Agreement & Pricing<i class="fa fa-arrow-right float-right" aria-hidden="true"></i></td>
            </tr>
            <tr ng-click="goTo('about/about')">
                <td>About Us<i class="fa fa-arrow-right float-right" aria-hidden="true"></i></td>
            </tr>
            <tr ng-click="goTo('about/contact')">
                <td>Contact Us<i class="fa fa-arrow-right float-right" aria-hidden="true"></i></td>
            </tr>
        </table>
    </div>
</body>
</html>