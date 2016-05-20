<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Explorer</title>


<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setCookieDomain", "*.80.191.27.102"]);
  _paq.push(["setDomains", ["*.80.191.27.102","*.127.0.0.1"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//80.191.27.102/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//80.191.27.102/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->




  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="include/bootstrap.min.css">
  <script src="include/jquery.js"></script>
  <script src="include/bootstrap.min.js"></script>
  <script type="text/javascript">
	$(document).ready(function(e) {
		$('#ja_text').html('');
		var resulttext = $('input[name="resulte"]').val();
		var text = $('input[name="text"]').val();
		
		if(resulttext != ''){
			
				var arrayres = resulttext.split(' ');
				var array    = text.split(' ');
			
				for(i=1 ; i < arrayres.length ; i++){
					
					if(array.indexOf(arrayres[i]) != -1){
							$('#ja_text').append('<button style="margin:5px;" type="button" class="btn btn-success">'+arrayres[i]+'</button>');
						}
						
				}
			}
			
    });  
  </script>
</head>

<body>

<div class="container">

  <h2>Explorer</h2>
  <form action="" method="post" role="form">
    <div class="form-group">
      <label for="usr">Enter a word ( Max lenght 8 ) :</label>
      <input type="text" class="form-control" name="word" placeholder="You must enter at least one character">
    </div>
    
    <div class="form-group">
    <button type="submit" class="btn btn-default">Create</button>
    </div>
  </form>
  
</div>

<?php 


$row = 1;
$blackpowder='';
if (($handle = fopen("./include/wordlist.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            $blackpowder .= ' '.$data[$c];
        }
    }
}

echo '<input type="hidden" value="'.$blackpowder.'" class="form-control" name="text">';


if(@$_POST['word'] != ''){ 
?>
<div class="container">
<br/>
<?php 
$word   = $_POST['word'];

$length = strlen($word);

if($length < 9){

$array  = str_split($word);

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

$array_creat_char = '';
$i=0;
foreach (permutations($array) as $permutation){
	$array_creat_char[$i] = implode($permutation) . PHP_EOL;
	$i++;
}


echo '<div class="well">Word  : '.$word.'</div>';

echo '<div class="well">Word lenght : '.$length.'</div>';

echo '<div class="well">Number of states : '.(count($array_creat_char)).'</div>';

echo '<hr/>';

echo '<label>Words in dictionary</label>';

echo '<div id="ja_text"></div>';

echo '<hr/>';

echo '<label>All possible combinations</label>';

echo '<br/>';

$strinresulte = '';
for($i=0; $i < count($array_creat_char); $i++){
	
	$char =  $array_creat_char[$i];
	$strinresulte .= ' '.$char;
	
	echo '<button style="margin:5px;" type="button" id="'.$char.'" class="btn btn-info">'.$char.'</button>';
	
	}
	
echo '<input style="display:none;" name="resulte" type="text" value="'.$strinresulte.'" class="form-control">';	


}else{
	echo '<div class="alert alert-danger">Word lenght : '.$length.'</div>';
	}
?>
</div>&nbsp;
<br/>
<?php 
}else{ 
	 	echo '<div style="text-align:center;" class="alert alert-danger">You must enter at least one character</div>'; 
	}
?>

</body>
</html>
