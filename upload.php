<?php
$file = $_FILES["file"];
$haszowanie = array(1, 2, 3, 4, 5,);
$filename = "nazwa";
$litery = "qwertyuiopasdfghjklzxcvbnm";
$rozszerzenie = $file["name"][-3] . $file["name"][-2] . $file["name"][-1];
if(is_file('obrazy/' . $filename . "." . $rozszerzenie))
{
    $haszowanie[0] += 1;
    $haszowanie[1] = crc32($haszowanie[0]);
    $haszowanie[2] = md5($haszowanie[1]);
    $haszowanie[3] = sha1($haszowanie[2]);
    $haszowanie[4] = md5($haszowanie[3]);
    $haszowanie[5] = crc32($haszowanie[4]);

    for($i = 1; $i < strlen($haszowanie[4]); $i ++)
    {
        if(is_numeric($haszowanie[4][$i]))
        {
            $haszowanie[4][$i] = rand(1, 100);
        }
        else
        {
            $haszowanie[4][$i] = $litery[rand(0, strlen($litery))];
        }
    }

    $filename = $haszowanie[4];
}
move_uploaded_file($file["tmp_name"], "obrazy/" . $filename . "." . $rozszerzenie);
echo "pomyślnie przesłano obraz, znajdziesz go pod linkiem localhost/obrazy/" . $filename . "." . $rozszerzenie;
?>