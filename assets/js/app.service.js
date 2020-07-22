import {app} from '../js/app.module.js';

const key = "SFkqSL99qLk9SSeYL9kqeS9L3eS99q39"
const host_protocole = "http://"
const host_server = "localhost:8000"

app.service('userService', function ($http) {
    this.activeProme = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/activePromotion.php?id=${id}&key=${key}`);
    }
    this.getBalance = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/user.php?id=${id}&key=${key}`);
    }
    this.getIdLogged = () => {
        return $http.get(`${host_protocole}${host_server}/api/login.php?key=${key}`);
    }
    this.getUserInfo = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/users.php?id=${id}&key=${key}`);
    }
    this.updateUser = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/update.php?id=${id}&key=${key}`,data);
    }
    this.updateBalance = (id, addNum) => {
        return $http.post(`${host_protocole}${host_server}/api/addBalance.php?id=${id}&key=${key}`,addNum);
    }
    this.updateAddress = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/updateAddress.php?id=${id}&key=${key}`,data);
    }
    this.getBank = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/bank.php?id=${id}&key=${key}`);
    }
    this.setBank = (id,data) => {
        return $http.post(`${host_protocole}${host_server}/api/bank.php?id=${id}&key=${key}`,data);
    }
})

app.service('appService', function ($http) {
    this.convertBonus = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/convertBonus.php?key=${key}&id=${id}`,data);
    }
    this.checkPlaying = (id, groups) => {
        return $http.get(`${host_protocole}${host_server}/api/checkPlay.php?key=${key}&groups=${groups}&id=${id}`);
    }
    this.sendMail = (data) => {
        return $http.post(`${host_protocole}${host_server}/api/mailing.php?key=${key}`,data);
    }
    this.getHost = () => {
        return `${host_protocole}${host_server}`;
    }
    this.getPromotion = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/promotion.php?key=${key}&id=${id}`);
    }
    this.resetAll = () => {
        return $http.get(`${host_protocole}${host_server}/api/reOrder.php?key=${key}`);
    }
    this.sendServiceFee = (data) => {
        return $http.post(`${host_protocole}${host_server}/api/sendProfit.php?key=${key}`,data);
    }
    this.adjust = (groups, period, win, num) => {
        return $http.get(`${host_protocole}${host_server}/api/micmac.php?key=${key}&groups=${groups}&period=${period}&winC=${win}&winN=${num}`);
    }
    this.prepare = (groups) => {
        return $http.post(`${host_protocole}${host_server}/api/prepare.php?key=${key}&groups=${groups}`);
    }
    this.getAllPrepare = (groups) => {
        return $http.get(`${host_protocole}${host_server}/api/getalldone.php?key=${key}&groups=${groups}&choice=prepare`);
    }
    this.getAllPrime = (groups) => {
        return $http.get(`${host_protocole}${host_server}/api/getalldone.php?key=${key}&groups=${groups}&choice=prime`);
    }
    this.getAllFinal = (groups) => {
        return $http.get(`${host_protocole}${host_server}/api/getalldone.php?key=${key}&groups=${groups}&choice=final`);
    }
    this.randomize = (groups, period) => {
        return $http.post(`${host_protocole}${host_server}/api/generate.php?key=${key}&groups=${groups}&period=${period}`);
    }
    this.sendOrdering = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/ordering.php?id=${id}&key=${key}&service=ordering`,data);
    }
    this.validateOrdering = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/ordering.php?id=${id}&key=${key}&service=validate`,data);
    }
    this.getCurrentOrder = (id,group) => {
        return $http.get(`${host_protocole}${host_server}/api/order.php?id=${id}&key=${key}&options=current&groups=${group}`);
    }
    this.getHistoryOrder = (id,group) => {
        return $http.get(`${host_protocole}${host_server}/api/order.php?id=${id}&key=${key}&options=history&groups=${group}`);
    }
})

app.service('convertService', function ($http) {
    this.withdrawal = (id,data) => {
        return $http.post(`${host_protocole}${host_server}/api/convert.php?key=${key}&id=${id}`,data);
    }
})

app.service('adminService', function ($http) {
    this.transfertAdmin = () => {
        return $http.get(`${host_protocole}${host_server}/api/transfertAdmin.php?key=${key}`);
    }
    this.getDataOrder = () => {
        return $http.get(`${host_protocole}${host_server}/api/order.php?key=${key}`);
    }
    this.getParams = () => {
        return $http.get(`${host_protocole}${host_server}/api/params.php?key=${key}`);
    }
    this.getAllUser = () => {
        return $http.get(`${host_protocole}${host_server}/api/allUser.php?key=${key}`);
    }
})

app.service('passwordService', function ($http) {
    this.setPassword = (id,data) => {
        return $http.post(`${host_protocole}${host_server}/api/updatePass.php?id=${id}&key=${key}`,data);
    }
    this.recoverPassword = (mail) => {
        return $http.get(`${host_protocole}${host_server}/api/recoverPassword.php?mail=${mail}&key=${key}`);
    }
})

app.service('registerService', function ($http) {
    this.getAllIndicatif = () => {
        return $http.get(`${host_protocole}${host_server}/api/indicatifMobile.php?country=All`);
    }
    this.sendVerificator = (code, email) => {
        let message = `Hello, welcome to MoGraClub, your verification code is ${code}. Use this to complete your registration and we look forward to getting to know you!`
        let data = {
            message,
            email
        }
        return $http.post(`${host_protocole}${host_server}/api/otpSend.php?key=${key}`,data);
    }
})

app.service("complaintService", function ($http) {
    this.sendNew = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/sendComplaint.php?id=${id}&key=${key}&type=new`,data);
    }
    this.sendResponse = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/sendComplaint.php?id=${id}&key=${key}&type=response`,data);
    }
    this.getAll = () => {
        return $http.get(`${host_protocole}${host_server}/api/getComplaint.php?key=${key}`);
    }
    this.getAllById = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/getComplaint.php?key=${key}&id=${id}`);
    }
    this.solved = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/getComplaint.php?key=${key}&id_complaint=${id}`);
    }
})

app.service("taskService", function ($http) {
    this.getAllTask = () => {
        return $http.get(`${host_protocole}${host_server}/api/getTask.php?key=${key}`);
    }
    this.getAllTaskById = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/getTask.php?key=${key}&id=${id}`);
    }
    this.getAll= (id) => {
        return $http.get(`${host_protocole}${host_server}/api/taskApi.php?key=${key}&id=${id}&type=all`);
    }
    this.getTask = (id, idTask) => {
        return $http.get(`${host_protocole}${host_server}/api/taskApi.php?key=${key}&id=${id}&idTask=${idTask}&type=get`);
    }
    this.validityTask = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/taskApi.php?key=${key}&id=${id}&type=active`);
    }
})

app.service("redService", function ($http) {
    this.getAllSend = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/getRed.php?key=${key}&id=${id}&type=send`);
    }
    this.getAllReceive = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/getRed.php?key=${key}&id=${id}&type=receive`);
    }
    this.sendRed = (data) => {
        return $http.post(`${host_protocole}${host_server}/api/redenvelop.php?key=${key}`,data);
    }
    this.checkRed = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/checkRed.php?key=${key}&id_value=${id}`);
    }
    this.getRed = (id, idU) => {
        return $http.get(`${host_protocole}${host_server}/api/setRed.php?key=${key}&idU=${idU}&v=${id}`);
    }
})