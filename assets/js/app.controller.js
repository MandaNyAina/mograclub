import {app} from '../js/app.module.js';
import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@9/src/sweetalert2.js';

function generateCode (length) {
    let result = '',
    characters = '0123456789',
    charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function time_out () {
    let date = new Date();

    let h = date.getHours(),
        m = date.getMinutes(),
        s = date.getSeconds();
    
    let init_m = 2,
        init_s = 46

    let now = (h * 60 * 60) + (m * 60) + (s);
    let i = 0;
    while(i <= now) {
        init_s --;
        if (i == 165) {
            init_m = 2;
            init_s = 45;
        } else if (init_m > 0 && init_s == 0) {
            init_s = 60;
            init_m --;
        } else if (init_m == 0 && init_s == 0) {
            init_s = 45;
            init_m = 2;
        }
        i++;
    }
    return {
        min: init_m,
        sec: init_s
    }
}

app.filter('isWin', function () {
    return function (x) {
        if (x == 0) {
            return "Lose"
        } else {
            return "Win"
        }
    }
})

app.filter('solving', function () {
    return function (x) {
        if (x != 0) {
            return "Solved"
        } else {
            return "Pending"
        }
    }
})

app.controller('registreCtrl', ($scope, registerService) => {
    $scope.invalid = true;
    $scope.errorPassLength = false;
    $scope.errorNotMatch = false;
    $scope.PassclassPass = "";
    $scope.PassConfclassPass = "";
    $scope.indicatif = "";
    $scope.indicatifList = [];
    $scope.verified = false;
    let code = generateCode(6);
    registerService.getAllIndicatif().then(
        (res) => {
            $scope.indicatifList = res.data;
        },
        (err) => {
            console.log(err);
        }
    )
    $scope.sendCode = (email) => {
        registerService.sendVerificator(code,email).then(
            (res) => {
                console.log(res)
            }
        )
    }
    $scope.resend = (mail) => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: 'New code is sent ',
            showConfirmButton: false,
            timer: 1500
        })
        code = generateCode(6);
        registerService.sendVerificator(code,mail).then(
            (res) => {
                console.log(res)
            }
        )
    }
    $scope.changeMail = () => {
        document.getElementById("btnVerify").innerText = "Verify";
        document.getElementById("btnVerify").className = "btn btn-warning";
    }
    $scope.verifyCode = (number) => {
        if (number == code) {
            $scope.verified = true;
            document.getElementById("btnVerify").innerText = "Verified !";
            document.getElementById("btnVerify").className = "btn btn-success";
        } else {
            $scope.verified = false;
            document.getElementById("btnVerify").innerText = "Not verified !";
            document.getElementById("btnVerify").className = "btn btn-danger";
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                text: 'The key is incorrect',
                showConfirmButton: false,
                timer: 1500
            })
        }
    }
    $scope.passwordChange = () => {
        $scope.invalid = true;
        if ($scope.password.length < 8) {
            $scope.errorPassLength = true;
            $scope.PassclassPass = "is-invalid";
        } else {
            $scope.errorPassLength = false;
            $scope.PassclassPass = "is-valid";
        }
    }
    $scope.passwordAbort = () => {
        if ($scope.password != $scope.confirm) {
            $scope.errorNotMatch = true;
            $scope.PassConfclassPass = "is-invalid";
        } else {
            $scope.invalid = false;
            $scope.errorNotMatch = false;
            $scope.PassConfclassPass = "is-valid";
        }
    }
    $scope.teste = (e) => {
        console.log(e);
    }
})
  
app.controller('appCtrl', (userService, appService, $scope, $location, $routeParams) => {
    $scope.list = [];
    $scope.agateList = [];
    $scope.berylList = [];
    $scope.celestineList = [];
    $scope.diamondList = [];
    $scope.emeraldList = [];
    $scope.flintList = [];
    $scope.agatePart = [];
    $scope.berylPart = [];
    $scope.celestinePart = [];
    $scope.diamondPart = [];
    $scope.emeraldPart = [];
    $scope.flintPart = [];
    $scope.moreData = [];
    $scope.currentOrder = [];
    $scope.historyOrder = [];
    $scope.pages = 0;
    $scope.contract = 10;
    $scope.bet = 1;
    $scope.confirmCondition = false;
    $scope.navigateOrder = 0;
    $scope.changeColor = (attr,color,cond) => {
        $scope.contract = 10;
        $scope.bet = 1;
        $scope.confirmCondition = false;
        unSelectContractAll(attr,color,cond);
        document.getElementById(`${attr}10`).className = `btn btn-${color} btn-sm`;
        unSelectNumberAll(attr,color,cond);
        document.getElementById(cond).checked = false;
    }
    $scope.play = (data) => {
        let amount = (data.bet * data.contract)
        // console.log(amount)
        if ($scope.balanceValue > amount) {
            // the service fee here
            if (amount < 50) {
                amount = amount - 1;
                appService.sendServiceFee(1);
            } else {
                amount = amount - 2;
                appService.sendServiceFee(2);
            }
            data.amount = amount;
            appService.sendOrdering(data.id, data).then(
                (res) => {
                    console.log(res);
                    if (res.data == "Send Done") {
                        loadUserInfo();
                    }
                }
            )
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                text: 'Your balance is low',
                showConfirmButton: false,
                timer: 1500
            })
        }
    }
    function unSelectContractAll (attr,color) {
        $scope.contract = 10;
        document.getElementById(`${attr}10`).className = `btn btn-outline-${color} btn-sm`
        document.getElementById(`${attr}100`).className = `btn btn-outline-${color} btn-sm`
        document.getElementById(`${attr}1000`).className = `btn btn-outline-${color} btn-sm`
        document.getElementById(`${attr}10000`).className = `btn btn-outline-${color} btn-sm`
    }
    function unSelectNumberAll (attr,color) {
        document.getElementById(`${attr}3b`).className = `btn btn-outline-${color} btn-sm`
        document.getElementById(`${attr}5b`).className = `btn btn-outline-${color} btn-sm`
        document.getElementById(`${attr}10b`).className = `btn btn-outline-${color} btn-sm`
    }
    $scope.selectContract = (e,color) => {
        unSelectContractAll(e.charAt(0),color)
        document.getElementById(`${e}`).className = `btn btn-${color} btn-sm`
        $scope.contract = e.slice(1);
    }
    $scope.selectNumber = (attr, e,color) => {
        unSelectNumberAll(attr,color);
        let el = e+"b";
        if (e == null) {
            $scope.bet = 1;
        } else if (e == 0) {
            $scope.bet = 1;
        } else if (e == 10) {
            el = "10b";
        } 
        $scope.bet = e;
        if (document.getElementById(`${attr}${el}`) != undefined) {
            document.getElementById(`${attr}${el}`).className = `btn btn-${color} btn-sm`;
        }
    }
    $scope.setValue = (attr,params,color) => {
        if ($scope.bet != null && $scope.bet != 0) {
            switch (params) {
                case "moins":
                    $scope.bet --
                    break;
                
                case "plus":
                    if ($scope.bet < 99) {
                        $scope.bet ++
                    }
                    break;
            }
        }
        $scope.selectNumber(attr,$scope.bet,color)
    }
    $scope.selectNumberA = (e) => {
        if (e == null) {
            $scope.bet = 1;
            document.getElementById("numberContract").value = 1;
        } else if (e == 0) {
            $scope.bet = 1;
        } else if (e > 99 ) {
            document.getElementById("numberContract").value = 99;
            $scope.bet = 99;
        }
    }
    $scope.confirmConditionBtn = () => {
        $scope.confirmCondition = true;
    }
    const resetAll = () => {
        appService.resetAll();
    }
    const getAll = () => {
        $scope.agatePart = [];
        $scope.berylPart = [];
        $scope.celestinePart = [];
        $scope.diamondPart = [];
        $scope.emeraldPart = [];
        $scope.flintPart = [];
        appService.getAll("AGATE",$scope.pages).then(
            (res) => {
                $scope.agateList = res.data;
                $scope.agateList.reverse();
                for (let i = 0; i < 10;i++) {
                    if ($scope.agateList[i] != undefined) {
                        $scope.agatePart.push($scope.agateList[i]);
                    }
                }
                moreCharge();
            },
            (err) => {
                console.log(err)
            }
        )
        appService.getAll("BERYL",$scope.pages).then(
            (res) => {
                $scope.berylList = res.data;
                $scope.berylList.reverse();
                for (let i = 0; i < 10;i++) {
                    if ($scope.berylList[i] != undefined) {
                        $scope.berylPart.push($scope.berylList[i]);
                    }
                }
                moreCharge();
            },
            (err) => {
                console.log(err)
            }
        )
        appService.getAll("CELESTINE",$scope.pages).then(
            (res) => {
                $scope.celestineList = res.data;
                $scope.celestineList.reverse();
                for (let i = 0; i < 10;i++) {
                    if ($scope.celestineList[i] != undefined) {
                        $scope.celestinePart.push($scope.celestineList[i]);
                    }
                }
                moreCharge();
            },
            (err) => {
                console.log(err)
            }
        )
        appService.getAll("DIAMOND",$scope.pages).then(
            (res) => {
                $scope.diamondList = res.data;
                $scope.diamondList.reverse();
                for (let i = 0; i < 10;i++) {
                    if ($scope.diamondList[i] != undefined) {
                        $scope.diamondPart.push($scope.diamondList[i]);
                    }
                }
                moreCharge();
            },
            (err) => {
                console.log(err)
            }
        )
        appService.getAll("EMERALD",$scope.pages).then(
            (res) => {
                $scope.emeraldList = res.data;
                $scope.emeraldList.reverse();
                for (let i = 0; i < 10;i++) {
                    if ($scope.emeraldList[i] != undefined) {
                        $scope.emeraldPart.push($scope.emeraldList[i]);
                    }
                }
                moreCharge();
            },
            (err) => {
                console.log(err)
            }
        )
        appService.getAll("FLINT",$scope.pages).then(
            (res) => {
                $scope.flintList = res.data;
                $scope.flintList.reverse();
                for (let i = 0; i < 10;i++) {
                    if ($scope.flintList[i] != undefined) {
                        $scope.flintPart.push($scope.flintList[i]);
                    }
                }
                moreCharge();
            },
            (err) => {
                console.log(err)
            }
        )
    }
    getAll($scope.agateList)
    $scope.goBackMore = () => {
        $location.path(`${$routeParams.group}`);
    }
    $scope.navigateOrderList = (e) => {
        $scope.navigateOrder = e;
        if (e) {
            document.getElementById("coNav").className = ""
            document.getElementById("hoNav").className = "bg-secondary"
        } else {
            document.getElementById("hoNav").className = ""
            document.getElementById("coNav").className = "bg-secondary"
        }
    }
    function moreCharge () {
        if ($location.$$path.includes("/more")) {
            switch ($routeParams.group) {
                case "agate":
                    $scope.moreData = $scope.agateList;
                    break;
                
                case "beryl":
                    $scope.moreData = $scope.berylList;
                    break;
                
                case "celestine":
                    $scope.moreData = $scope.celestineList;
                    break;
            
                case "diamond":
                    $scope.moreData = $scope.diamondList;
                    break;

                case "emerald":
                    $scope.moreData = $scope.emeraldList;
                    break;
                
                case "flint":
                    $scope.moreData = $scope.flintList;
                    break;

            }
        }
    }
    const setAll = () => {
        appService.randomize("AGATE").then(
            (res) => {
                // console.log(res)
                let service;
                appService.adjust("AGATE",res.data.period, res.data.result, res.data.number).then(
                    (result) => {
                        service = {
                            "period": result.data.period,
                            "number":result.data.number,
                            "color": result.data.result,
                            "groups": result.data.groups
                        }
                        userService.getIdLogged().then(
                            (res) => {
                                appService.validateOrdering(res.data,service).then(
                                    (res) => {
                                        console.log(res)
                                        if (res.data.includes("win")) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                text: `Congratulations, you win with period Id: ${service.period}! In AGATE groups`,
                                                showConfirmButton: false,
                                                timer: 3000
                                            })
                                        }
                                        loadUserInfo();
                                    }
                                )
                            }
                        )
                    }
                )
            },
            (err) => {
                console.log(err)
            }
        )
        appService.randomize("BERYL").then(
            (res) => {
                // console.log(res)
                let service;
                appService.adjust("BERYL",res.data.period, res.data.result, res.data.number).then(
                    (result) => {
                        service = {
                            "period": result.data.period,
                            "number":result.data.number,
                            "color": result.data.result,
                            "groups": result.data.groups
                        }
                        userService.getIdLogged().then(
                            (res) => {
                                appService.validateOrdering(res.data,service).then(
                                    (res) => {
                                        console.log(res);
                                        if (res.data.includes("win")) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                text: `Congratulations, you win with period Id: ${service.period}! In BERYL groups`,
                                                showConfirmButton: false,
                                                timer: 3000
                                            })
                                        }
                                        loadUserInfo();
                                    }   
                                )
                            }
                        )
                    }
                )
            },
            (err) => {
                console.log(err)
            }
        )
        appService.randomize("CELESTINE").then(
            (res) => {
                // console.log(res)
                let service;
                appService.adjust("CELESTINE",res.data.period, res.data.result, res.data.number).then(
                    (result) => {
                        service = {
                            "period": result.data.period,
                            "number":result.data.number,
                            "color": result.data.result,
                            "groups": result.data.groups
                        }
                        userService.getIdLogged().then(
                            (res) => {
                                appService.validateOrdering(res.data,service).then(
                                    (res) => {
                                        console.log(res);
                                        if (res.data.includes("win")) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                text: `Congratulations, you win with period Id: ${service.period}! In CELESTINE groups`,
                                                showConfirmButton: false,
                                                timer: 3000
                                            })
                                        }
                                        loadUserInfo();
                                    }
                                )
                            }
                        )
                    }
                )
            },
            (err) => {
                console.log(err)
            }
        )
        appService.randomize("DIAMOND").then(
            (res) => {
                // console.log(res)
                let service;
                appService.adjust("DIAMOND",res.data.period, res.data.result, res.data.number).then(
                    (result) => {
                        service = {
                            "period": result.data.period,
                            "number":result.data.number,
                            "color": result.data.result,
                            "groups": result.data.groups
                        }
                        userService.getIdLogged().then(
                            (res) => {
                                appService.validateOrdering(res.data,service).then(
                                    (res) => {
                                        console.log(res);
                                        if (res.data.includes("win")) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                text: `Congratulations, you win with period Id: ${service.period}! In DIAMOND groups`,
                                                showConfirmButton: false,
                                                timer: 3000
                                            })
                                        }
                                        loadUserInfo();
                                    }
                                )
                            }
                        )
                    }
                )
            },
            (err) => {
                console.log(err)
            }
        )
        appService.randomize("EMERALD").then(
            (res) => {
                // console.log(res)
                let service;
                appService.adjust("EMERALD",res.data.period, res.data.result, res.data.number).then(
                    (result) => {
                        service = {
                            "period": result.data.period,
                            "number":result.data.number,
                            "color": result.data.result,
                            "groups": result.data.groups
                        }
                        userService.getIdLogged().then(
                            (res) => {
                                appService.validateOrdering(res.data,service).then(
                                    (res) => {
                                        // console.log(res);
                                        if (res.data.includes("win")) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                text: `Congratulations, you win with period Id: ${service.period}! In EMERALD groups`,
                                                showConfirmButton: false,
                                                timer: 3000
                                            })
                                        }
                                        loadUserInfo();
                                    }
                                )
                            }
                        )
                    }
                )
            },
            (err) => {
                console.log(err)
            }
        )
        appService.randomize("FLINT").then(
            (res) => {
                // console.log(res)
                let service;
                appService.adjust("FLINT",res.data.period, res.data.result, res.data.number).then(
                    (result) => {
                        service = {
                            "period": result.data.period,
                            "number":result.data.number,
                            "color": result.data.result,
                            "groups": result.data.groups
                        }
                        userService.getIdLogged().then(
                            (res) => {
                                appService.validateOrdering(res.data,service).then(
                                    (res) => {
                                        // console.log(res);
                                        if (res.data.includes("win")) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                text: `Congratulations, you win with period Id: ${service.period}! In FLINT groups`,
                                                showConfirmButton: false,
                                                timer: 3000
                                            })
                                        }
                                        loadUserInfo();
                                    }
                                )
                            }
                        )
                    }
                )
            },
            (err) => {
                console.log(err)
            }
        )
    }
    $scope.goTo = (url) => {
        $location.path(url);
    }
    $scope.redirectTo = (url) => {
        window.location = url;
    }
    appService.getAll().then(
        (res) => {
            // console.log(res)
        },
        (err) => {
            console.log(err)
        }
    )
    const loadUserInfo = () => {
        userService.getIdLogged().then(
            (res) => {
                appService.getCurrentOrder(res.data).then(
                    (res) => {
                        $scope.currentOrder = res.data;
                        // console.log($scope.currentOrder)
                    },
                    (err) => {  
                        console.log(err);
                    }
                )
                appService.getHistoryOrder(res.data).then(
                    (res) => {
                        $scope.historyOrder = res.data;
                        // console.log($scope.historyOrder)
                    },
                    (err) => {  
                        console.log(err);
                    }
                )
                userService.getBalance(res.data).then(
                    (res) => {
                        $scope.balanceValue = res.data.balance==undefined?0:res.data.balance;
                    },
                    (err) => {  
                        console.log(err);
                    }
                ) 
                userService.getUserInfo(res.data).then(
                    (res) => {
                        $scope.fname = res.data.first_name;
                        $scope.lname = res.data.last_name;
                        $scope.phone = res.data.phone;
                        $scope.mail = res.data.mail;
                        console.log();
                    },
                    (err) => {
                        console.log(err);
                    }
                )
            }
        )
    }
    loadUserInfo();
    let block;

    setInterval(async() => {
        block = document.getElementsByClassName("timeControl");
        if ($scope.min == 0 && $scope.sec <= 30) {
            for(let i=0;i<block.length;i++) {
                block[i].disabled = true;
            }
        } else {
            for(let i=0;i<block.length;i++) {
                block[i].disabled = false;
            }
        }
    }, 10)

    switch ($location.$$path) {
        case "/agate":
            $scope.menu = "AGATE"
            break;
        case "/beryl":
            $scope.menu = "BERYL"
            break;
        case "/celestine":
            $scope.menu = "CELES"
            break
        case "/diamond":
            $scope.menu = "DIAMO"
            break
        case "/emerald":
            $scope.menu = "EMERA"
            break
        case "/flint":
            $scope.menu = "FLIRI"
            break
    }
    $scope.choiceMenu = (e) => {
        $scope.menu = e;
    }

    let time = time_out();
    $scope.min = time.min;
    $scope.sec = time.sec;
    setInterval(async() => {
        block = document.getElementsByClassName("timeControl");
        if ($scope.min > 0 && $scope.sec == 0) {
            $scope.min -= 1;
            $scope.sec = 59;
        } else if ($scope.min == 0 && $scope.sec ==0) {
            $scope.min = 2;
            $scope.sec = 45;
            resetAll();
            document.getElementById("timerCounter").classList["value"] = "p-2 bg-light text-dark";
            if (block.length > 0) {
                for(let i=0;i<block.length;i++) {
                    block[i].disabled = true;
                }
            }
        } else if ($scope.min == 0 && $scope.sec == 40) {
            document.getElementById("timerCounter").classList["value"] = "p-2 bg-warning text-dark";
        } else if ($scope.min == 0 && $scope.sec == 30) {
            if (block.length > 0) {
                for(let i=0;i<block.length;i++) {
                    block[i].disabled = false;
                }
            }
        } else if ($scope.min == 0 && $scope.sec == 25) {
            setAll();
        } else if ($scope.min == 0 && $scope.sec == 15) {
            getAll();
        } 
        if ($scope.min == 0 && $scope.sec <= 30) {
            document.getElementById("timerCounter").classList["value"] = "p-2 bg-danger text-dark";
        }
        $scope.sec--;
        document.getElementById("timerCounter").innerHTML = `${$scope.min<10?"0"+$scope.min:$scope.min}:${$scope.sec<10?"0"+$scope.sec:$scope.sec}`;
    }, 1000)
})


app.controller('accountCtrl', ($scope,userService) => {
    $scope.save = (data) => {
        userService.updateUser(data.id,data).then(
            (res) => {
                if (res.data == "ok") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Your password is changed',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $scope.password = "";
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'Something is wrong, check password',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            (err) => {
                console.log(err);
            }
        )
        
    }
})

app.controller('rechargeCtrl', ($scope, userService) => {
    $scope.canAdd = true;
    $scope.valueAdd = (e) => {
        if (e >= 60) {
            $scope.canAdd = false;
        } else {
            $scope.canAdd = true;
        }
    }
    $scope.addBalance = (e,num) => {
        userService.updateBalance(e, num).then(
            (res) => {
                console.log(res.data)
            },
            (err) => {
                console.log(err)
            }
        )
    }
})

app.controller('adminCtrl', (adminService, $scope, complaintService) => {
    $scope.results = [];
    $scope.responseAll = [];
    $scope.nbrComplaint = 0;
    const charge = () => {
        complaintService.getAll().then(
            (res) => {
                $scope.responseAll = res.data;
            }
        )
    }
    charge()
    $scope.solved = (id) => {
        complaintService.solved(id).then(
            (res) => {
                console.log(res)
                if (res.data == "ok") {
                    charge()
                }
            }
        )
    }
    $scope.response = (id,data) => {
        complaintService.sendResponse(id,data).then(
            (res) => {
                charge()
            }
        )
    }
    const getNewComplaint = () => {
        complaintService.getAll().then(
            (res) => {
                $scope.nbrComplaint = 0;
                res.data.map(el => {
                    if (el.parent.is_read == 0){
                        $scope.nbrComplaint++;
                    }
                })
            }
        )
    }
    setInterval(() => {
        getNewComplaint()
        adminService.getDataOrder().then(
            (res) => {
                $scope.nbrOfPlayer = res.data.nbrOfPlayer
                $scope.amount = res.data.amount
                $scope.agate = res.data.agate
                $scope.beryl = res.data.beryl
                $scope.celestine = res.data.celestine
                $scope.diamond = res.data.diamond
                $scope.emerald = res.data.emerald
                $scope.flint = res.data.flint
            }
        )
        adminService.getParams().then(
            (res) => {
                $scope.winner = res.data.nbr_winner
                $scope.wallet = res.data.wallet
                $scope.profit = res.data.wallet_profit
                $scope.mailPay = res.data.adminAccount
                $scope.passPay = res.data.passwordAccount
                $scope.w_agate = res.data.w_agate
                $scope.w_beryl= res.data.w_beryl
                $scope.w_celestine = res.data.w_celestine
                $scope.w_diamond = res.data.w_diamond
                $scope.w_emerald = res.data.w_emerald
                $scope.w_flint = res.data.w_flint
            }
        )
        adminService.getAllUser().then(
            (infos) => {
                $scope.users = infos.data;
            },
            (err) => {
                console.log(err);
            }
        )
        
    }, 1000)
    $scope.onSearch = (value) => {
        $scope.results = [];
        $scope.users.map(user => {
            if (value != "") {
                if(user.first_name.toLowerCase().includes(value) || user.last_name.toLowerCase().includes(value) || user.phone == value || user.mail.toLowerCase() == value) {
                    $scope.results.push(user);
                }
            } else {
                results = [];
            }
        })
    }
})

app.controller('pswController', ($scope, passwordService) => {
    $scope.cantPost = true;
    $scope.loader = false;
    $scope.valideTrue = false;
    $scope.recover = (e) => {
        $scope.loader = true;
        passwordService.recoverPassword(e).then(
            (res) => {
                if (res.data != "unkown") {
                    $scope.loader = false;
                    $scope.valideTrue = true;
                    $scope.results = res.data;
                    console.log(res.data)
                } else {
                    $scope.loader = false;
                    $scope.valideTrue = false;
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: `The phone number ${e} is not match with an user`,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        )
    }
    $scope.passwordChange = () => {
        $scope.cantPost = true;
        if ($scope.password.length < 8) {
            $scope.errorPassLength = true;
            $scope.PassclassPass = "is-invalid";
        } else {
            $scope.errorPassLength = false;
            $scope.PassclassPass = "is-valid";
        }
    }
    $scope.passwordAbort = () => {
        if ($scope.password != $scope.confirm) {
            $scope.errorNotMatch = true;
            $scope.PassConfclassPass = "is-invalid";
        } else {
            $scope.cantPost = false;
            $scope.errorNotMatch = false;
            $scope.PassConfclassPass = "is-valid";
        }
    }
    $scope.send = (id, older,n) => {
        let data = {
            "older": older,
            "new": n
        }
        passwordService.setPassword(id, data).then(
            (res) => {
                console.log(res);
                if (res.data == "ok") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Your password is changed',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $scope.older = "";
                    $scope.password = "";
                    $scope.confirm = "";
                    $scope.errorNotMatch = false;
                    $scope.errorPassLength = false;
                    $scope.PassConfclassPass = "";
                    $scope.PassclassPass = "";
                    $scope.cantPost = true;
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'The older password is wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            (err) => {
                console.log(err)
            }
        )
    }
    
})

app.controller('addressCtrl', (userService, $scope) => {
    let id, data;
    $scope.address = "";
    const recharge = () => {
        userService.getIdLogged().then(
            (res) => {
                userService.getUserInfo(res.data).then(
                    (res) => {
                        id = res.data.id;
                        $scope.address = res.data.address;
                    },
                    (err) => {
                        console.log(err);
                    }
                )
            }
        )
    }
    recharge();
    $scope.setAddress = (address) => {
        data = {
            "address": address
        }
        userService.updateAddress(id, data).then(
            (res) => {
                if (res.data == "Ok") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Your password is changed',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    recharge();
                    $scope.change = ""
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'Error when saving',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            (err) => {
                console.log(err);
            }
        )
    }
})

app.controller("bankCtrl", (userService, $scope) => {
    $scope.typeValue = "";
    userService.getIdLogged().then(
        (res) => {
            userService.getBank(res.data).then(
                (res) => {
                    if (res.data.type == "PayPal") {
                        $scope.typeBank = res.data.type,
                        $scope.mailBank = res.data.mail,
                        $scope.expBank = res.data.exp
                    }
                }
            )
        }
    )
    $scope.saveBankPaypal = (e) => {
        console.log(e)
    }
    $scope.saveBankMaster = (e) => {
        console.log(e)
    }
})

app.controller("walletCtrl", ($scope, convertService, userService) => {
    $scope.selected = "c";
    const recharge = () => {
        userService.getIdLogged().then(
            (res) => {
                userService.getBalance(res.data).then(
                    (res) => {
                        $scope.balanceValue = res.data.balance==undefined?0:res.data.balance;
                    },
                    (err) => {  
                        console.log(err);
                    }
                ) 
            }
        )
    }
    $scope.walletNav = (e) => {
        if (e == "c") {
            $scope.selected = "c";
            document.getElementById("c_wallet").className = "btn btn-secondary"
            document.getElementById("h_wallet").className = "btn btn-outline-secondary"
        } else if (e == "h") {
            $scope.selected = "h";
            document.getElementById("h_wallet").className = "btn btn-secondary"
            document.getElementById("c_wallet").className = "btn btn-outline-secondary"
        }
    }
    $scope.withdrawal = (id,e) => {
        convertService.withdrawal(id,e).then(
            (res) => {
                console.log(res)
                if (res.data == "Ok") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Your request is done with success',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $scope.change = ""
                    window.location.href = "../../index.php"
                    recharge()
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'Error when sending, the balance is low after deducting service charge',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        )
    }
})

app.controller("complaintCtrl", ($scope, complaintService, userService, $location) => {
    $scope.responseById = [];
    $scope.messageResponse = "aina"
    const charge = () => {
        userService.getIdLogged().then(
            (res) => {
                complaintService.getAllById(res.data).then(
                    (res) => {
                        $scope.responseById = res.data;
                    }
                )
            }
        )
    }
    charge()
    $scope.solved = (id) => {
        complaintService.solved(id).then(
            (res) => {
                console.log(res)
                if (res.data == "ok") {
                    charge()
                }
            }
        )
    }
    $scope.send = (id, data) => {
        complaintService.sendNew(id, data).then(
            (res) => {
                if (res.data == "ok") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Your message is sent with success',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $location.path("complaint")
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        text: 'Not sent, error in server',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                $scope.detail = ""
                $scope.orderId = ""
                $scope.type = ""
            }
        )
    }
    $scope.response = (id,data) => {
        complaintService.sendResponse(id,data).then(
            (res) => {
                charge()
            }
        )
    }
})

app.controller("promotionCtrl", ($scope, appService, userService) => {
    $scope.loader = false;
    let link = appService.getHost();
    userService.getIdLogged().then(
        (res) => {
            appService.getPromotion(res.data).then(
                (res) => {
                    $scope.key = res.data.id_para
                    $scope.links = `${link}/views/registration/registre.php?key=${res.data.id_para}`;
                    console.log($scope.links)
                }
            )
        }
    )
    $scope.sendMail = (address) => {
        let data = {
            object: "Invitation code",
            to: address,
            message: `
            Hello, we invite you to join <b>MograClub</b> <br><br> You can register in :<br><br>${$scope.links}
            <div align="center" style="padding:15px">
                Scan this to go in invitation registration <br>
                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${$scope.links}&choe=UTF-8" title="Link to invitation code" />
            </div>
            `
        }
        $scope.loader = true;
        appService.sendMail(data).then(
            (res) => {
                $scope.mailAddress = '';
                $scope.loader = false;
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Send !',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        )
    }
})