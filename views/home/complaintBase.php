<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">Complaints or suggestion <i class="fa fa-sellsy" aria-hidden="true"></i></h2> 
    <div>
        <table class="table table-bordered table-hover table-sm w-50 text-center mx-auto">
            <tr>
                <td ng-click="goTo('complaint/new')">
                    New <i class="float-right fa fa-plus-square" aria-hidden="true"></i>
                </td>
            </tr>
            <tr>
                <td ng-click="goTo('complaint/response')">
                    Response <i class="float-right fa fa-reply" aria-hidden="true"></i></i>
                </td>
            </tr>
        </table>
    </div>
    <footer class="bg-light w-100 p-3 text-center" style="border-radius:15px;">
        Our Service <br><br>

        10:00-17:00, Monday - Friday<br>
        about 1-5 business days.
    </footer>
</body>
</html>