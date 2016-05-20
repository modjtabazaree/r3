<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Explorer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="include/bootstrap.min.css">
  <script src="include/bootstrap.min.js"></script>
</head>

<body>

<div class="container">

  <h2>Explorer</h2>
  <form action="" method="post" role="form">
    <div class="form-group">
      <label for="usr">Enter a word:</label>
      <input type="text" class="form-control" name="word">
    </div>
    
    <div class="form-group">
    <button type="submit" class="btn btn-default">Creat</button>
    </div>
  </form>
  
</div>

<?php if(@$_POST['word'] != ''){ ?>
<div class="container">
<br/>
<?php 
$word   = $_POST['word'];

$length = strlen($word);

$array  = str_split($word);

$fact1  = gmp_fact($length);

$states = gmp_strval($fact1) . "\n";

echo '<div class="well">Word  : '.$word.'</div>';

echo '<div class="well">Word lenght : '.$length.'</div>';

echo '<div class="well">Number of states : '.$states.'</div>';

function factorial($n)
{
    if(! is_int($n) || $n < 1)
        throw new Exception('Input must be a positive integer.');
    if($n==1)
        return $n;

    return $n * factorial($n-1);
}

function op_code_no_repeats($a){

    $_a  = str_split($a);

    if(array_unique($_a) !== $_a)
        throw new Exception('Does not work for strings with repeated characters.');

    $num = count($_a);
    $perms_count = factorial($num);

    $output = array();
    while(count($output) < $perms_count){
        shuffle($_a);
        $justnumber = implode('', $_a);
        if(!in_array($justnumber , $output))
            $output[] = $justnumber;
    }
    sort($output);

    return $output;
}

$output = op_code_no_repeats($word);

$filtered = array();
foreach($output as $permutation) {
    $filtered[] = str_replace('3', '2', $permutation);
}
$filtered = array_unique($filtered);

for($i=0 ; $i< $states ; $i++){
	echo '<button style="margin:5px;" type="button" class="btn btn-info">'.$filtered[$i].'</button>';
	}
	echo '<hr/>';
for($i=0 ; $i< $states ; $i++){
	echo '&nbsp;'.($i+1).'_'.$filtered[$i].'&nbsp; &nbsp;';
	}	
?>
</div>&nbsp;
<br/>
<?php } ?>

</body>
</html>
