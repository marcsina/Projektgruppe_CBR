<?php
header('Content-Type: text/html; charset=utf-8');

include_once 'conn.php';
include_once 'functions_login.php';

sec_session_start();

//Insert Activity into the Histoy_Checker table
//$result can link to a future result table
function insert_Activity_Checker($mysqli, $user_ID, $Page, $result = null, $case_id = null)
{
    if($stmt = $mysqli->prepare("INSERT INTO History_Checker(User_ID, Percentage, Page, Time, Case_ID) VALUES (?,?,?, CURRENT_TIMESTAMP,?)"))
	{
		$stmt->bind_param('idss', $user_ID, $result, $Page, $case_id);
		$stmt->execute();
	}
	else
	{
		//DB FEHLER
		return false;
	}

}

//Insert a Activity into the History_Article
//$ArticleID is the link to a future Article Table
function insert_Activity_Article($mysqli, $user_ID, $ArticleID)
{

    if($stmt = $mysqli->prepare("INSERT INTO History_Article(User_ID, Article_ID, Time) VALUES (?,?, CURRENT_TIMESTAMP)"))
	{
		$stmt->bind_param('ii', $user_ID, $ArticleID);
		$stmt->execute();
		$stmt->store_result();
	}
	else
	{
		//DB FEHLER
		return false;
	}

}

//get the checker history
//result can link to a future checkerResult Page
function getHistory_Checker($mysqli, $user_ID)
{
    $data = array();
    if($stmt = $mysqli->prepare("SELECT Page, Time, Percentage, Case_ID FROM History_Checker WHERE User_ID = ?"))
    {
        $stmt->bind_param('i',$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($page, $time, $result, $case_ID);
        while($stmt->fetch())
        {
            array_push($data,array("page"=>$page, "time"=>$time, "result"=>$case_ID, "percentage"=>$result));
        }

        return $data;
    }
}

//get the Article History
//Article ID can link to a future Classroom page
function getHistory_Article($mysqli, $user_ID)
{
    $data = array();
    if($stmt = $mysqli->prepare("SELECT Time, ArticleID FROM History_Article WHERE User_ID = ?"))
    {
        $stmt->bind_param('i',$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($time, $article);
        while($stmt->fetch())
        {
            array_push($data,array("time"=>$time, "article"=>$article));
        }

        return $data;
    }
}

//get the Forum History
//Topic id links to the Forum_topic table
function getHistory_Forum($mysqli, $user_ID)
{
    $data = array();
    if($stmt = $mysqli->prepare("SELECT datum, topic FROM Forum_Beitrag WHERE user = ?"))
    {
        $stmt->bind_param('i',$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($time, $topicID);
        while($stmt->fetch())
        {
            array_push($data,array("time"=>$time, "topic_id"=>$topicID));
        }

        return $data;
    }
}

//get the MP Quiz history
//quizId links to the MP_Quiz Table
function getHistory_MP_Quiz($mysqli, $user_ID)
{
    $data = array();
    if($stmt = $mysqli->prepare("SELECT IF(User_ID_1 = ?, enddatum_user_1, enddatum_user_2) AS enddatum, ID FROM `MP_QUIZ` WHERE User_ID_1 = ? OR User_ID_2 = ?"))
    {
        $stmt->bind_param('iii',$user_ID,$user_ID,$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($time, $quiz_id);
        while($stmt->fetch())
        {
            if($time != 0)
            {
                array_push($data,array("time"=>$time, "quiz_id"=>$quiz_id));
            }

        }

        return $data;
    }
}

//get the SP Quiz history
//quizId links to the SP_Quiz Table
function getHistory_SP_Quiz($mysqli, $user_ID)
{
    $data = array();
    if($stmt = $mysqli->prepare("SELECT enddatum, ID FROM `SP_QUIZ` WHERE User_ID = ? AND enddatum IS NOT NULL"))
    {
        $stmt->bind_param('i',$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($time, $quiz_id);
        while($stmt->fetch())
        {
            array_push($data,array("time"=>$time, "quiz_id"=>$quiz_id));
        }

        return $data;
    }
}

//input all history arrays and combine them to one sorted history array
function combine_Historys($checker, $article, $forum, $mpquiz, $spquiz)
{
    $time = 0;
    $page = "";
    $type = "";
    $fk_id = 0;

    $result = array();

    if(count($checker) > 0)
    {
        foreach($checker as &$item)
        {
            array_push($result, array("time"=>$item['time'], "page" => $item['page'], "fk_id" => $item['result'], "type" => 'Checker',"percentage" => $item['percentage'] ));
        }
    }

    if(count($article) > 0)
    {
        foreach($article as &$item)
        {
            array_push($result, array("time"=>$item['time'], "page" => null, "fk_id" => $item['article'], "type" => 'Article'));
        }
    }

    if(count($forum) > 0)
    {
        foreach($forum as &$item)
        {
            array_push($result, array("time"=>$item['time'], "page" => null, "fk_id" => $item['topic_id'], "type" => 'Forum'));
        }
    }

    if(count($mpquiz) > 0)
    {
        foreach($mpquiz as &$item)
        {
            array_push($result, array("time"=>$item['time'], "page" => null, "fk_id" => $item['quiz_id'], "type" => 'MP'));
        }
    }

    if(count($spquiz) > 0)
    {
        foreach($spquiz as &$item)
        {
            array_push($result, array("time"=>$item['time'], "page" => null, "fk_id" => $item['quiz_id'], "type" => 'SP'));
        }
    }

    //Show history data
    //foreach($result as &$item)
    //{
    //    debug_to_console("Time:".$item['time']."Type ".$item['type']);
    //}

    //Coole SortierAction
    usort($result,function($first, $second)
    {
        $time1 = strtotime($first['time']);
        $time2 = strtotime($second['time']);
        return $time2-$time1;
    });

    return $result;
}



if(isset($_POST['name'],$_POST['type'],$_POST['value']))
{
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

    insert_Activity_Checker($mysqli, $_SESSION['user_id'], $type, $_POST['value'], $name);

}

//Show variable in console
function debug_to_console( $data )
{
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "
<script>console.log('Debug Objects: " . $output . "');</script>";
}

?>