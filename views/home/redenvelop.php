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
    <h2 class="text-center">Red envelop <i class="fas fa-mail-bulk"></i></h2> 
    <div class="bg-success p-3" style="overflow: auto; height: 300px;border-radius: 15px;">
    Open the red envelope function user use agreement <br><br>
    1. Before using this function, please read and understand this statement carefully. You can choose not to use this function, but if you use this function, your behavior will be deemed to fully recognize the use of this function.
    <br>
    2. Before using this function, please make sure that the login password and payment password you set are different.
    <br>
    3. Please take good care of your login password, payment password and other important information. The platform will not bear any legal responsibility for the losses caused to you by the information leakage.
    <br>
    4. Red envelope sending function ：After the operation is successful, the other party receives the red envelope successfully. The money will enter the other party's red envelope account and cannot be cancelled. It is recommended that you confirm the other party's information before using the function; if the other party has not received the red envelope, the money will be returned to the account automatically within 48 hours. 5. For operation errors, wrong senders, or disputes between the two parties, the records of successful operations cannot be withdrawn. It is recommended that you try to contact the other party to negotiate.
    <br>
    6. If the other party is involved in fraud, you need to report it. But your operation has been successful and the money cannot be intercepted. Please try to contact the superior agent to appeal and try to recover the money.
    <br>
    7. If the user uses this function in violation of national laws and regulations or infringes the legal rights and interests of any third party, the platform has the right to suspend or terminate the provision of services to the user.
    <br>
    8. If the user uses this function to engage in any illegal or infringing behavior, the user bears all responsibility, and the platform does not assume any legal and joint liability, so the platform or any third party causes any loss, and the user should bear all losses.
    </div>
    <div style="word-wrap: break-word;" class="text-center">
        <input type="checkbox" ng-model="submitRed" name="" id="redenvelop" class="mt-3"> <label for="redenvelop">Please read and sign the agreement carefully</label>
    </div>
    <div class="text-center">
        <button ng-click="goTo('/redenvelop/start')" type="submit" ng-disabled="!submitRed" class="btn btn-success mb-2">Submit</button>
    </div>
</body>
</html>