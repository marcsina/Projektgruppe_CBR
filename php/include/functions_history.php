<?php
header('Content-Type: text/html; charset=utf-8');

include_once 'conn.php';
include_once 'functions_login.php';
//ini_set ("display_errors", "1");
//error_reporting(E_ALL);

sec_session_start();

//----------------------------------------------HISTORY----------------------------------------------

//Insert Activity into the Histoy_Checker table
//$result can link to a future result table
function insert_Activity_Checker($mysqli, $user_ID, $Page, $result = null, $case_id = null)
{
    if($stmt = $mysqli->prepare("INSERT INTO History_Checker(User_ID, Percentage, Page, Time, Case_ID) VALUES (?,?,?, CURRENT_TIMESTAMP,?)"))
	{
		$stmt->bind_param('idsi', $user_ID, $result, $Page, $case_id);
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
    if($stmt = $mysqli->prepare("SELECT Page, Time, Percentage, Case_ID, name FROM History_Checker, Cases WHERE User_ID = ? AND History_Checker.Case_ID = Cases.id"))
    {
        $stmt->bind_param('i',$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($page, $time, $result, $case_ID, $case_name);
        while($stmt->fetch())
        {
            array_push($data,array("page"=>$page, "time"=>$time, "result"=>$case_ID, "percentage"=>$result,"case_name"=>$case_name));
        }

        return $data;
    }
}

//get the Article History
//Article ID can link to a future Classroom page
function getHistory_Article($mysqli, $user_ID)
{
    $data = array();
    if($stmt = $mysqli->prepare("SELECT Time, Article_ID, Artikel.Titel FROM History_Article, Artikel WHERE History_Article.Article_ID = Artikel.id AND User_ID = ?"))
    {
        $stmt->bind_param('i',$user_ID);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($time, $article,$title);
        while($stmt->fetch())
        {
            array_push($data,array("time"=>$time, "article"=>$article, "title" => $title));
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
            array_push($result, array("time"=>$item['time'], "page" => $item['page'], "fk_id" => $item['result'], "type" => 'Checker',"percentage" => $item['percentage'], "case_name" => $item['case_name'] ));
        }
    }

    if(count($article) > 0)
    {
        foreach($article as &$item)
        {
            array_push($result, array("time"=>$item['time'], "page" => null, "fk_id" => $item['article'], "type" => 'Article', "title" => $item['title']));
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

//Get the newest Forum Post, Limit by input value
function get_Recent_Forum($mysqli, $limit)
{
    $Recent_Forum = array();
    if($stmt = $mysqli->prepare(" SELECT Cases.name, Forum_Beitrag.topic, Max(Forum_Beitrag.datum) AS date1
                                    FROM Forum_Beitrag, Cases
                                    Where Forum_Beitrag.topic = Cases.id
                                    Group By Forum_Beitrag.topic
                                    Order By date1 desc LIMIT ?"))
    {
        $stmt->bind_param('i',$limit);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($topic_title,$topic_id, $date);
        while($stmt->fetch())
        {
            array_push($Recent_Forum,array("topic_title"=>$topic_title,"topic_id"=>$topic_id, "date"=>$date));
        }

        return $Recent_Forum;
    }
}

//Get the newest Article Post, Limit by input value
function get_Recent_Article($mysqli, $limit)
{

    $Recent_Article = array();
    if($stmt = $mysqli->prepare("SELECT Artikel.id, Datum, Titel, username FROM Artikel, members Where members.id = Artikel.UserID Order By datum desc LIMIT ?"))
    {
        $stmt->bind_param('i',$limit);
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($article_id, $date, $title, $username);
        while($stmt->fetch())
        {
            array_push($Recent_Article,array("article_id"=>$article_id, "date"=>$date, "username"=>$username, "title"=>$title));
        }

        return $Recent_Article;
    }
}


//Main Method. Checks which function to call
if(isset($_POST['function']))
{
    $funtion = filter_input(INPUT_POST, 'function', FILTER_SANITIZE_STRING);
    switch($funtion)
    {
        case "Insert_Activity_Checker":
        {
            if(isset($_POST['id'],$_POST['type'],$_POST['value']))
            {
                $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

                insert_Activity_Checker($mysqli, $_SESSION['user_id'], $type, $_POST['value'], $_POST['id']);

            }
            break;
        }
        case "Insert_Activity_Article":
        {
            if(isset($_POST['user_id'],$_POST['article_id']))
            {
                insert_Activity_Article($mysqli, $_POST['user_id'], $_POST['article_id']);
            }
            break;
        }
    }
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