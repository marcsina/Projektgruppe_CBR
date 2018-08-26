<?php

$function = $_POST['function'];
$isStarted = $_POST['started'];
$log = array();

switch($function) {

    case('getState'):
        if(file_exists('chat.txt')){
            $lines = file('chat.txt');
        }
        $log['state'] = count($lines);
        break;

    case ('getAll'):
        $state = $_POST['state'];
        if(file_exists('chat.txt')){
            $lines = file('chat.txt');
        }
        $count =  count($lines);
        $text= array();
        $log['state'] = $state + count($lines) - $state;
        foreach ($lines as $line_num => $line)
        {
                $text[] =  $line = str_replace("\n", "", $line);
        }
        $log['text'] = $text;
        break;

    case('update'):

        $state = $_POST['state'];
        if(file_exists('chat.txt')){
            $lines = file('chat.txt');
        }
        $count =  count($lines);

        if($isStarted == 0)
        {
            $text= array();
            $log['state'] = $state + count($lines) - $state;
            foreach ($lines as $line_num => $line)
            {
                $text[] =  $line = str_replace("\n", "", $line);
            }


            $res = array();
            if(count($text)>10)
            {
                for( $i = 10; $i > 0; $i--)
                {
                    $res[] = $text[count($text)-$i];
                }
            }else{
                for( $i = count($text); $i > 0; $i--)
                {
                    $res[] = $text[count($text)-$i];
                }
            }
            $text = $res;

            $log['state'] = $state;
            $log['text'] = $text;
        }
        else if($state == $count){
            $log['state'] = $state;
            $log['text'] = false;

        }
        else{
            $text= array();
            $log['state'] = $state + count($lines) - $state;
            foreach ($lines as $line_num => $line)
            {
                if($line_num >= $state){
                    $text[] =  $line = str_replace("\n", "", $line);
                }

            }
            $log['text'] = $text;
        }

        break;

    case('send'):
        $nickname = htmlentities(strip_tags($_POST['nickname']));
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        $message = htmlentities(strip_tags($_POST['message']));
        if(($message) != "\n"){

            if(preg_match($reg_exUrl, $message, $url)) {
                $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
            }

            //get the current time
            $date = date('h:i', time());
            //replace break with space
            $message = str_replace("\n", " ", $message);

            fwrite(fopen('chat.txt', 'a'), "<span> <a href='http://141.99.248.92/Projektgruppe/php/profil.php?username=".$nickname."'>". $nickname . "</a>  um ".$date."<br></span>" . $message . "\n");
        }
        break;

}

echo json_encode($log);


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