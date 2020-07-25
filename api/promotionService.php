<?php

    class Promotion {
        
        private $database;

        public function __construct($database) { 
            $this->database = $database;
        }

        public function createPromotion($id) {
            $data = [
                "id_para" => date("Y").time(),
                "nbr_pers" => 0,
                "id_user" => $id,
                "active" => 0,
                "contribution" => 0
            ];
            $this->database->insert("t_reward",$data);
        }

        public function exist ($key) {
            $row = $this->database->select("t_reward","*","id_para='$key'")['id_user'];
            if ($row) {
                return $row;
            } else {
                return false;
            }
        }

        public function profit_daily ($id) {
            $rows = $this->database->selectMore("t_rel_promotion","*","t_user_property='$id'");
            $user = $this->database->select("t_user_info","*","id='$id'");
            $user_login = $this->database->select("t_user","*","id='".$user['id_login']."'");
            $type_user = $user_login['type'];
            $active_number = 0;
            $contribution = 0;
            foreach ($rows as $value) {
                $id_refer = $value['t_user_rel'];
                $amountCurrentOrderReferalUser = $this->database->select("t_order","*","id_user='$id_refer' and status='current'")['amount'];
                $id_login_refer = $this->database->select("t_user_info","id_login","id='$id_refer'")['id_login'];
                $is_active = $this->database->select("t_user","active","id='$id_login_refer'")['active'];
                if ($is_active) {
                    $contribution += $amountCurrentOrderReferalUser;
                    $active_number++;
                }
            }
            if ($active_number > 0) {
                $this->database->update("t_reward",["active" => $active_number,
                                                    "contribution" => $contribution],"id_user='$id'");
                if ($type_user == "ADMIN") {
                    $getSystWallet = $this->database->select("t_params","*","id=1")['wallet'];
                    $newSystWallet = $getSystWallet + 2;
                    $this->database->update("t_params",["wallet" => $newSystWallet],"id=1");
                } else {
                    $getBalance = $this->database->select("t_user_params","*","id='$id'")['balance'];
                    $newBalance = $getBalance + 2;
                    $this->database->update("t_user_params",["balance" => $newBalance],"id='$id'");
                }
            }
        }

        public function addReferTo ($sender, $referal) {
            $current_number = $this->database->select("t_reward","*","id_user='$sender'")['nbr_pers'];
            $number = $current_number + 1;
            $this->database->update("t_reward",["nbr_pers" => $number],"id_user='$sender'");
            $data = [
                "t_user_property" => $sender,
                "t_user_rel" => $referal
            ];
            $this->database->insert("t_rel_promotion", $data);
        }

        public function profit_now ($id) {
            $user = $this->database->select("t_user_info","*","id='$id'");
            $user_login = $this->database->select("t_user","*","id='".$user['id_login']."'");
            $type_user = $user_login['type'];
            if ($type_user == "ADMIN") {
                $getSystWallet = $this->database->select("t_params","*","id=1")['wallet'];
                $newSystWallet = $getSystWallet + 15;
                $this->database->update("t_params",["wallet" => $newSystWallet],"id=1");
            } else {
                $getBalance = $this->database->select("t_user_params","*","id_user='$id'")['balance'];
                $newBalance = $getBalance + 15;
                $this->database->update("t_user_params",["balance" => $newBalance],"id_user='$id'");
            }
        }
    }
?>