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

function permutations(array $elements)
{
    if (count($elements) <= 1) {
        yield $elements;
    } else {
        foreach (permutations(array_slice($elements, 1)) as $permutation) {
            foreach (range(0, count($elements) - 1) as $i) {
                yield array_merge(
                    array_slice($permutation, 0, $i),
                    [$elements[0]],
                    array_slice($permutation, $i)
                );
            }
        }
    }
}


foreach (permutations($array) as $permutation) {
    echo '<button style="margin:5px;" type="button" class="btn btn-info">'. implode($permutation) . PHP_EOL .'</button>';
}

?>
</div>&nbsp;
<br/>
<?php } ?>

</body>
</html>
