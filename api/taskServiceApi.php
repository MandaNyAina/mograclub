<?php
    $GLOBALS['database'] = $database;
    class Task {

        public function __construct() {
            
        }

        function chargeTask () {
            $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
            $today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
            $nextMonth = 31;
            $currentMonth = intval(date("m"));
            if ($currentMonth == 2) {
                $nextMonth = 28;
            } else if ($currentMonth %2 == 0) {
                $nextMonth = 30;
            }
            $nextMonth = date('Y').date('m').($nextMonth);
            $data = [
                "start_date" => $today,
                "stop_date" => $tomorrow,
                "get_date" => $today
            ];
            $GLOBALS['database']->update("t_task",$data,"number_ref != 500");
            $data = [
                "start_date" => $today,
                "stop_date" => $nextMonth,
                "get_date" => $today
            ];
            $GLOBALS['database']->update("t_task",$data,"number_ref = 500");
        }

        function exist ($taskKey) {
            $task = $GLOBALS['database']->select("t_task_user","*","key_task='$taskKey' and is_finish = 0");
            $id_task = $task['id_task'];
            $finish = $task['finish'];

            $taskRow = $GLOBALS['database']->select("t_task","*","id='$id_task'");

            $obj = $taskRow['number_ref'];

            if ($obj > $finish && $obj != $finish) {
                return true;
            } else {
                return false;
            }
        }
        
        function valide_1 ($taskKey, $idUser) {
            $task = $GLOBALS['database']->select("t_task_user","*","key_task='$taskKey'");
            $user_associate = $task['id_associate'];
            $id_associate = "";
            $id_task = $task['id_task'];
            $finish = $task['finish'];

            $taskRow = $GLOBALS['database']->select("t_task","*","id='$id_task'");

            $obj = $taskRow['number_ref'];

            if ($obj > $finish && $obj != $finish) {
                if ($user_associate == NULL || $obj == 1) {
                    $id_associate = $idUser;
                } else {
                    $id_associate = $user_associate.",".$idUser;
                }
                $data = [
                    "id_associate" => $id_associate
                ];
                $GLOBALS['database']->update("t_task_user",$data,"key_task='$taskKey'");
            } else {
                return false;
            }
        }

        function valide_2 ($idUser) {
            $task = $GLOBALS['database']->selectMore("t_task_user","*","is_finish = 0");
            $allUser = [];
            foreach ($task as $t) {
                $allUser = explode(",",$t['id_associate']);
                if (in_array($idUser, $allUser)) {
                    $id_task = $t['id_task'];
                    $finish = $t['finish'];
                    $id = $t['id'];
                    $id_property = $t['id_user'];
                    $taskRow = $GLOBALS['database']->select("t_task","*","id='$id_task'");

                    $obj = $taskRow['number_ref'];

                    if ($obj > $finish && $obj != $finish) {
                        $finish = $finish + 1;
                        $is_finish = 0;
                        if ($finish == $obj) {
                            $is_finish = 1;
                            $getCurrentBalance = $GLOBALS['database']->select("t_user_params","*","id_user='$id_property'")['balance'];
                            $taskPrice = $taskRow['price'];
                            $data = [
                                "balance" => $getCurrentBalance + $taskPrice
                            ];
                            $GLOBALS['database']->update("t_user_params",$data,"id_user='$id_property'");
                            $data = [
                                "type" => "Reward by task",
                                "id_user" => $id_property,
                                "price" => $taskPrice
                            ];
                            $GLOBALS['database']->insert("t_recharge",$data);
                        }
                        $data = [
                            "finish" => $finish,
                            "is_finish" => $is_finish
                        ];
                        $GLOBALS['database']->update("t_task_user",$data,"id='$id'");
                    }
                }
            }
        }

        function createTask ($idUser, $idTask) {
            $date_finish = date("Y-m-d");
            $nextMonth = 31;
            $currentMonth = intval(date("m"));
            if ($currentMonth == 2) {
                $nextMonth = 28;
            } else if ($currentMonth %2 == 0) {
                $nextMonth = 30;
            }
            if ($idTask == 8) {
                $date_finish = date('Y')."-".date('m')."-".($nextMonth);
            }
            $data = [
                "id_user" => $idUser,
                "id_task" => $idTask,
                "finish" => 0,
                "date_finish" => $date_finish,
                "is_finish" => 0,
                "key_task" => date("Y").time()
            ];
            $GLOBALS['database']->insert("t_task_user",$data);
        }

        function getTaskById ($idUser) {
            $rows = $GLOBALS['database']->selectMore("t_task_user","*","id_user='$idUser'");
            if (count($rows) > 0) {
                $result = [];
                $all = [];
                $finish = [];
                foreach ($rows as $value) {
                    $status = "open";
                    $idTask = $value['id_task'];
                    $key = $value['key_task'];
                    $task = $GLOBALS['database']->select("t_task","*","id='$idTask'");
                    $date = $task['stop_date'];
                    if ($date < $value['date_finish']  || $value['is_finish'] == 1) {
                        $status = "close";
                    }
                    $taskName = $task['name'];
                    $price = $task['price'];
                    $completed = $value['finish']."/".$task['number_ref'];
                    $date_finish = $task['stop_date'];
                    $data = [
                        "name" => $taskName,
                        "price" => $price,
                        "completed" => $completed,
                        "date_finish" => $date_finish,
                        "status" => $status,
                        "key" => $key,
                        "etat" => $value['is_finish']
                    ];
                    if ($value['is_finish'] == 1) {
                        array_push($finish, $data);
                    }
                    array_push($all, $data);
                }
                $result = [
                    "finish" => $finish,
                    "all" => $all
                ];
                return $result;
            } else {
                return [];
            }
        }

        function getTaskActiveById ($idUser, $date) {
            $rows = $GLOBALS['database']->selectMore("t_task_user","*","id_user='$idUser' and date_finish='$date' and is_finish=0");
            if ($rows > 0) {
                return $rows;
            } else {
                return [];
            }
        }
    }
?>