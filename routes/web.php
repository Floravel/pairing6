<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/aaa', function() {

    $string = 'unicomp6.unicomp.net - - [01/Jul/1995:00:00:06 -0400] "GET /shuttle/countdown/ HTTP/1.0" 200 3985
            burger.letters.com - - [01/Jul/1995:00:00:11 -0400] "GET /shuttle/countdown/liftoff.html HTTP/1.0" 304 0
            burger.letters.com - - [01/Jul/1995:00:00:12 -0400] "GET /images/NASA-logosmall.gif HTTP/1.0" 304 0
            burger.letters.com - - [01/Jul/1995:00:00:12 -0400] "GET /shuttle/countdown/video/livevideo.GIF HTTP/1.0" 200 0
            d104.aa.net - - [01/Jul/1995:00:00:13 -0400] "GET /shuttle/countdown/ HTTP/1.0" 200 3985
            unicomp6.unicomp.net - - [01/Jul/1995:00:00:14 -0400] "GET /shuttle/countdown/count.gif HTTP/1.0" 200 40310
            unicomp6.unicomp.net - - [01/Jul/1995:00:00:14 -0400] "GET /images/NASA-logosmall.gif HTTP/1.0" 200 786
            unicomp6.unicomp.net - - [01/Jul/1995:00:00:14 -0400] "GET /images/KSC-logosmall.gif HTTP/1.0" 200 1204
            d104.aa.net - - [01/Jul/1995:00:00:15 -0400] "GET /shuttle/countdown/count.gif HTTP/1.0" 200 40310
            d104.aa.net - - [01/Jul/1995:00:00:15 -0400] "GET /images/NASA-logosmall.gif HTTP/1.0" 200 786';

    $lineArray = explode("\n", $string);

    $outputArray = [];

    $pattern = '/.+"(GET)\s(\/\w+)+\/([\w-]+\.gif)/i';

    $gifArray = [];
    foreach ($lineArray as $line) {
        $regArray = preg_match($pattern, $line, $matches);
        if ($regArray == 1) {
            $gifArray[] = $matches[3];
            $i = 0;
        }
    }

    $gifArray = array_unique($gifArray);

    $file = fopen('gifs_test.txt', 'w');

    foreach ($gifArray as $string) {
        fwrite($file, $string."\n") or die('catatrophic failure');
    }

    array_splice();

    fclose($file);

  //  file_put_contents('gifs_test.txt', var_export($gifArray, true));

    return "aaa";
});


/*function calcPairs($n, $array) {
    $arraySocks = [];

    for ($i=0;$i <= $n-1;$i++)
    {
        if (! isset($arraySocks[$array[$i]])) {
            $arraySocks[$array[$i]] = 1;
        }
        $arraySocks[$array[$i]]++;
    }

    $countPairs = 0;
    foreach ($arraySocks as $arraySock) {
        $countPairs += ($arraySock-$arraySock%2)/2;
    }
    echo "34324";
    return $countPairs;
}

Route::get('/bbb', function() {
    $n = 9;
    $array = [10, 20, 20, 10, 10, 30, 50, 10, 20];
    calcPairs($n, $array);
});

Route::get('/aaa', function() {
        $readings = [
            '250',
            '1/3/2012 16:00:00   Missing_1',
            '1/3/2012 16:00:00	26.96',
            '1/4/2012 16:00:00	27.47',
            '1/3/2012 16:00:00   Missing_2',
        ];

    $numberOfRows = $readings[0];
    unset($readings[0]);

    $results = [];
    foreach ($readings as $reading) {
        {
            $results[] = explode('\t', $reading);
        }
    };

    for ($i = 0; ($i <= $numberOfRows-1); $i++) {
        if ($readings[$i][0] = 'M') {
            $results[$i] = 0;
            $average = 0;
            for ($l = 0; ($l <= $i); $l++) {
                $average = $average + $results[$l];
            }
            $results[$i] = $average/$l;
        }
    }

    return $results;
});

*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{any}', [\App\Http\Controllers\AppController::class, 'index'])->where('any', '.*')->middleware('auth')->name('home');
