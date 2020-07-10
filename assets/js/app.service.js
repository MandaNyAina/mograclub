import {app} from '../js/app.module.js';

const key = "SFkqSL99qLk9SSeYL9kqeS9L3eS99q39"
const host_protocole = "http://"
const host_server = "mogra.club"

app.service('userService', function ($http) {
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
    this.getAll = (groups,pages) => {
        return $http.get(`${host_protocole}${host_server}/api/getalldone.php?key=${key}&groups=${groups}`);
    }
    this.randomize = (groups) => {
        return $http.post(`${host_protocole}${host_server}/api/generate.php?key=${key}&groups=${groups}`);
    }
    this.sendOrdering = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/ordering.php?id=${id}&key=${key}&service=ordering`,data);
    }
    this.validateOrdering = (id, data) => {
        return $http.post(`${host_protocole}${host_server}/api/ordering.php?id=${id}&key=${key}&service=validate`,data);
    }
    this.getCurrentOrder = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/order.php?id=${id}&key=${key}&options=current`);
    }
    this.getHistoryOrder = (id) => {
        return $http.get(`${host_protocole}${host_server}/api/order.php?id=${id}&key=${key}&options=history`);
    }
})

app.service('convertService', function ($http) {
    this.withdrawal = (id,data) => {
        return $http.post(`${host_protocole}${host_server}/api/convert.php?key=${key}&id=${id}`,data);
    }
})

app.service('adminService', function ($http) {
    this.getDataOrder = () => {
        return $http.get(`${host_protocole}${host_server}/api/order.php?key=${key}`);
    }
    this.getParams = () => {
        return $http.get(`${host_protocole}${host_server}/api/params.php?key=${key}`);
    }
    this.getAllUser = () => {
        return $http.get(`${host_protocole}${host_server}/api/allUser.php?key=${key}`);
    }
    this.sendMoney = () => {

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